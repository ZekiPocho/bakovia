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
