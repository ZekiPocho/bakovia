<?php

include "db.php";

$query = $_GET['query'];

// Consulta a la base de datos para buscar productos y publicaciones
$sql = "SELECT nombre_producto AS name, 'product' AS type, CONCAT('product-details.php?id=', id_producto) AS link FROM productos WHERE nombre_producto LIKE '%$query%'
        UNION ALL
        SELECT nombre_publicacion AS name, 'post' AS type, CONCAT('blog-single-sidebar.php?id=', id_publicacion) AS link FROM publicaciones WHERE nombre_publicacion LIKE '%$query%'";

$result = $conn->query($sql);

$items = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

// Devolver los resultados como JSON
echo json_encode($items);

$conn->close();
?>