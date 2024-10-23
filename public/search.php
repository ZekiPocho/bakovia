<?php
header('Content-Type: application/json');

include "db.php";

$query = $_GET['query'];

// Preparar y ejecutar la consulta para productos
$product_sql = "SELECT id_producto, nombre_producto FROM productos WHERE nombre_producto LIKE ?";
$stmt = $conn->prepare($product_sql);
$like_query = "%{$query}%";
$stmt->bind_param("s", $like_query);
$stmt->execute();
$product_result = $stmt->get_result();
$products = [];

while ($row = $product_result->fetch_assoc()) {
    $products[] = [
        'id' => $row['id_producto'],
        'name' => $row['nombre_producto'],
        'link' => "producto.php?id={$row['id_producto']}" // Ajusta la URL según tus necesidades
    ];
}

// Preparar y ejecutar la consulta para publicaciones
$publication_sql = "SELECT id_publicacion, titulo FROM publicaciones WHERE titulo LIKE ?";
$stmt = $conn->prepare($publication_sql);
$stmt->bind_param("s", $like_query);
$stmt->execute();
$publication_result = $stmt->get_result();
$publications = [];

while ($row = $publication_result->fetch_assoc()) {
    $publications[] = [
        'id' => $row['id_publicacion'],
        'title' => $row['titulo'],
        'link' => "publicacion.php?id={$row['id_publicacion']}" // Ajusta la URL según tus necesidades
    ];
}

// Devolver resultados
echo json_encode([
    'products' => $products,
    'publications' => $publications
]);

$conn->close();
?>