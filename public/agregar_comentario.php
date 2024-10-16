<?php
include 'db.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_publicacion = $_POST['id_publicacion'];
    $id_usuario = $_POST['id_usuario']; // Asegúrate de que esto sea el ID del usuario que comenta
    $comentario = $_POST['comentario'];
    $fecha_comentario = date('Y-m-d H:i:s'); // Obtener la fecha actual

    // Insertar el comentario en la base de datos
    $sql = "INSERT INTO comentarios (id_publicacion, id_usuario, comentario, fecha_comentario)
            VALUES ('$id_publicacion', '$id_usuario', '$comentario', '$fecha_comentario')";

    if ($conn->query($sql) === TRUE) {
        // Comentario añadido correctamente
        header("Location: blog-single-sidebar.php?id=$id_publicacion"); // Redirigir de vuelta a la publicación
        exit();
    } else {
        echo "Error: " . $conn->error; // Mostrar error en caso de que falle la inserción
    }
}

$conn->close(); // Cerrar la conexión
?>