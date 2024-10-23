<?php
// Conexión a la base de datos
include 'db_connection.php';

// Obtener el ID del producto de la URL
$id = $_GET['id'];

// Validar y sanitizar el ID
if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die("ID inválido");
}

// Realizar la consulta para obtener el producto
$productQuery = "SELECT * FROM productos WHERE id_producto = ?";
$stmt = $conn->prepare($productQuery);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si el producto existe
if ($product = $result->fetch_assoc()) {
    // Mostrar el producto
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($product['nombre_producto']); ?></title>
        <link rel="stylesheet" href="styles.css"> <!-- Incluye tu CSS -->
    </head>
    <body>
        <h1><?php echo htmlspecialchars($product['nombre_producto']); ?></h1>
        <img src="<?php echo htmlspecialchars($product['imagen_producto']); ?>" alt="<?php echo htmlspecialchars($product['nombre_producto']); ?>" />
        <p><?php echo nl2br(htmlspecialchars($product['descripcion'])); ?></p>
        <p>Precio: $<?php echo number_format($product['precio'], 2); ?></p>
        <a href="index.php">Regresar a la lista de productos</a> <!-- Cambia a tu página principal -->
    </body>
    </html>
    <?php
} else {
    echo "Producto no encontrado";
}

$stmt->close();
$conn->close();
?>
