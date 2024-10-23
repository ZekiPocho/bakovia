<?php
// Conexión a la base de datos
require 'db_connection.php'; // Asegúrate de tener este archivo con la conexión a la base de datos

// Obtener el término de búsqueda
$query = isset($_GET['query']) ? trim($_GET['query']) : '';

// Inicializar las variables
$productos = [];
$publicaciones = [];

// Realizar la búsqueda de productos
if (!empty($query)) {
    $queryEscaped = $conn->real_escape_string($query);
    
    // Buscar productos
    $sqlProductos = "SELECT id_producto, nombre_producto, descripcion, precio, imagen_producto, tipo 
                     FROM productos 
                     WHERE nombre_producto LIKE '%$queryEscaped%' OR descripcion LIKE '%$queryEscaped%'";
    $resultProductos = $conn->query($sqlProductos);
    
    if ($resultProductos->num_rows > 0) {
        while ($row = $resultProductos->fetch_assoc()) {
            $productos[] = $row;
        }
    }

    // Buscar publicaciones (suponiendo que hay una tabla 'publicaciones')
    $sqlPublicaciones = "SELECT id_publicacion, titulo, contenido, fecha_publicacion, imagen_publicacion 
                         FROM publicaciones 
                         WHERE titulo LIKE '%$queryEscaped%' OR contenido LIKE '%$queryEscaped%'";
    $resultPublicaciones = $conn->query($sqlPublicaciones);
    
    if ($resultPublicaciones->num_rows > 0) {
        while ($row = $resultPublicaciones->fetch_assoc()) {
            $publicaciones[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Búsqueda</title>
    <!-- Incluye tus hojas de estilo aquí -->
</head>
<body>
    <h1>Resultados de Búsqueda para "<?= htmlspecialchars($query) ?>"</h1>
    
    <h2>Productos</h2>
    <div class="product-results">
        <?php if (!empty($productos)): ?>
            <ul>
                <?php foreach ($productos as $producto): ?>
                    <li>
                        <a href="product-details.php?id=<?= $producto['id_producto'] ?>">
                            <?= htmlspecialchars($producto['nombre_producto']) ?> - Bs. <?= number_format($producto['precio'], 2) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No se encontraron productos.</p>
        <?php endif; ?>
    </div>

    <h2>Publicaciones</h2>
    <div class="post-results">
        <?php if (!empty($publicaciones)): ?>
            <ul>
                <?php foreach ($publicaciones as $publicacion): ?>
                    <li>
                        <a href="post-details.php?id=<?= $publicacion['id_publicacion'] ?>">
                            <?= htmlspecialchars($publicacion['titulo']) ?> - <?= htmlspecialchars($publicacion['fecha_publicacion']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No se encontraron publicaciones.</p>
        <?php endif; ?>
    </div>
</body>
</html>