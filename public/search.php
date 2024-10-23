<?php
// Conexión a la base de datos
require 'db.php';

// Obtener el término de búsqueda
$query = isset($_GET['query']) ? trim($_GET['query']) : '';

// Inicializar las variables
$productos = [];
$publicaciones = [];

// Realizar la búsqueda de productos
if (!empty($query)) {
    $queryEscaped = $conn->real_escape_string($query);
    
    // Buscar productos
    $sqlProductos = "SELECT id_producto, nombre_producto, precio 
                     FROM productos 
                     WHERE nombre_producto LIKE '%$queryEscaped%' OR descripcion LIKE '%$queryEscaped%'";
    $resultProductos = $conn->query($sqlProductos);
    
    if ($resultProductos->num_rows > 0) {
        while ($row = $resultProductos->fetch_assoc()) {
            $productos[] = $row;
        }
    }

    // Buscar publicaciones
    $sqlPublicaciones = "SELECT id_publicacion, titulo 
                         FROM publicaciones 
                         WHERE titulo LIKE '%$queryEscaped%' OR contenido LIKE '%$queryEscaped%'";
    $resultPublicaciones = $conn->query($sqlPublicaciones);
    
    if ($resultPublicaciones->num_rows > 0) {
        while ($row = $resultPublicaciones->fetch_assoc()) {
            $publicaciones[] = $row;
        }
    }
}

// Devolver resultados en formato JSON
header('Content-Type: application/json');
echo json_encode(['productos' => $productos, 'publicaciones' => $publicaciones]);
?>

<style>
.search-dropdown {
    position: absolute;
    background-color: white;
    border: 1px solid #ccc;
    max-height: 300px; /* Ajusta según sea necesario */
    overflow-y: auto;
    width: 100%;
    z-index: 1000;
    padding: 10px;
}

.search-dropdown h5 {
    margin: 0;
    font-size: 16px;
}

.search-dropdown ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.search-dropdown ul li {
    padding: 5px 0;
}

.search-dropdown ul li a {
    text-decoration: none;
    color: #333; /* Ajusta según tu diseño */
}

.search-dropdown ul li a:hover {
    color: #ff9800; /* Cambia el color al pasar el mouse */
}
</style>