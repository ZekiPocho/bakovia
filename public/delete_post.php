<?php
// Conexión a la base de datos
include('db.php');

// Verificar si el usuario está autenticado y si existe la publicación
session_start();
if (!isset($_SESSION['id_usuario'])) {
    die("Acceso denegado. Debes iniciar sesión para eliminar publicaciones.");
}

if (isset($_GET['id'])) {
    $id_publicacion = (int)$_GET['id'];
    $id_usuario_actual = $_SESSION['id_usuario'];

    // Verificar si el usuario autenticado es el creador de la publicación
    $sql_check = "SELECT id_usuario FROM publicaciones WHERE id_publicacion = $id_publicacion";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        $row = $result_check->fetch_assoc();
        $id_usuario_publicacion = $row['id_usuario'];

        if ($id_usuario_actual == $id_usuario_publicacion) {
            // Eliminar la publicación
            $sql_delete = "DELETE FROM publicaciones WHERE id_publicacion = $id_publicacion";
            if ($conn->query($sql_delete)) {
                echo "Publicación eliminada correctamente.";
                header("Location: blog-grid-sidebar.php?success=deleted");
                exit();
            } else {
                echo "Error al eliminar la publicación: " . $conn->error;
            }
        } else {
            echo "No tienes permiso para eliminar esta publicación.";
        }
    } else {
        echo "Publicación no encontrada.";
    }
} else {
    echo "No se ha proporcionado un ID de publicación.";
}

$conn->close();
?>