<?php
include "../public/db.php";

// Obtener la consulta de búsqueda
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Inicializar un array para almacenar los resultados
$items = [];

// Consulta para buscar productos
$sqlProducts = "SELECT nombre_producto AS name, 'product' AS type, CONCAT('product-details.php?id=', id_producto) AS link FROM productos WHERE nombre_producto LIKE '%$query%'";
$resultProducts = $conn->query($sqlProducts);

if ($resultProducts->num_rows > 0) {
    while ($row = $resultProducts->fetch_assoc()) {
        $items[] = $row;
    }
}

// Consulta para buscar publicaciones
$sqlPublications = "SELECT titulo AS name, 'post' AS type, CONCAT('blog-single-sidebar.php?id=', id_publicacion) AS link FROM publicaciones WHERE titulo LIKE '%$query%'";
$resultPublications = $conn->query($sqlPublications);

if ($resultPublications->num_rows > 0) {
    while ($row = $resultPublications->fetch_assoc()) {
        $items[] = $row;
    }
}

// Devolver los resultados como JSON
header('Content-Type: application/json');
echo json_encode($items);

$conn->close();
?>