<?php
// Conexión a la base de datos
include 'db.php';
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    die("Acceso denegado. Debes iniciar sesión para eliminar publicaciones.");
}

// Verificar si se ha enviado el ID de la publicación
if (isset($_POST['id_publicacion'])) {
    $id_publicacion = (int)$_POST['id_publicacion'];
    $id_usuario_actual = $_SESSION['id_usuario'];

    // Verificar si el usuario autenticado es el autor de la publicación
    $sql_check = "SELECT id_usuario FROM publicaciones WHERE id_publicacion = $id_publicacion";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        $row = $result_check->fetch_assoc();
        $id_usuario_publicacion = $row['id_usuario'];

        if ($id_usuario_actual == $id_usuario_publicacion) {
            // Primero, eliminar los comentarios asociados a la publicación
            $sql_delete_comments = "DELETE FROM comentarios WHERE id_publicacion = $id_publicacion";
            if ($conn->query($sql_delete_comments)) {
                // Luego, eliminar la publicación
                $sql_delete_post = "DELETE FROM publicaciones WHERE id_publicacion = $id_publicacion";
                if ($conn->query($sql_delete_post)) {
                    header("Location: blog-grid-sidebar.php?success=deleted");
                    exit();
                } else {
                    echo "Error al eliminar la publicación: " . $conn->error;
                }
            } else {
                echo "Error al eliminar los comentarios: " . $conn->error;
            }
        } else {
            echo "No tienes permiso para eliminar esta publicación.";
        }
    } else {
        echo "Publicación no encontrada.";
    }
} else {
    echo "No se ha proporcionado el ID de la publicación.";
}

$conn->close();
?>