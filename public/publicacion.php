<?php
// Conexión a la base de datos
include 'db_connection.php';

// Obtener el ID de la publicación de la URL
$id = $_GET['id'];

// Validar y sanitizar el ID
if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die("ID inválido");
}

// Realizar la consulta para obtener la publicación
$publicationQuery = "SELECT * FROM publicaciones WHERE id_publicacion = ?";
$stmt = $conn->prepare($publicationQuery);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si la publicación existe
if ($publication = $result->fetch_assoc()) {
    // Mostrar la publicación
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($publication['titulo']); ?></title>
        <link rel="stylesheet" href="styles.css"> <!-- Incluye tu CSS -->
    </head>
    <body>
        <h1><?php echo htmlspecialchars($publication['titulo']); ?></h1>
        <p><?php echo nl2br(htmlspecialchars($publication['contenido'])); ?></p>
        <p>Publicado el: <?php echo htmlspecialchars($publication['fecha_publicacion']); ?></p>
        <a href="index.php">Regresar a la lista de publicaciones</a> <!-- Cambia a tu página principal -->
    </body>
    </html>
    <?php
} else {
    echo "Publicación no encontrada";
}

$stmt->close();
$conn->close();
?>
