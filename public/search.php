<?php
// Conectar a la base de datos
include 'db.php';

// Obtener el término de búsqueda desde el request
$searchTerm = $_GET['search'];

// Realizar consultas a la base de datos
$products = [];
$publications = [];

// Consulta para productos
$productQuery = "SELECT id_producto, nombre_producto FROM productos WHERE nombre_producto LIKE ?";
$stmt = $conn->prepare($productQuery);
$likeTerm = "%" . $searchTerm . "%";
$stmt->bind_param("s", $likeTerm);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $products[] = [
        'id' => $row['id_producto'],
        'name' => $row['nombre_producto'],
        'link' => "producto.php?id=" . urlencode($row['id_producto']) // Genera el enlace
    ];
}

// Consulta para publicaciones
$publicationQuery = "SELECT id_publicacion, titulo FROM publicaciones WHERE titulo LIKE ?";
$stmt = $conn->prepare($publicationQuery);
$stmt->bind_param("s", $likeTerm);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $publications[] = [
        'id' => $row['id_publicacion'],
        'title' => $row['titulo'],
        'link' => "publicacion.php?id=" . urlencode($row['id_publicacion']) // Genera el enlace
    ];
}

// Devolver resultados en formato JSON
echo json_encode([
    'products' => $products,
    'publications' => $publications
]);