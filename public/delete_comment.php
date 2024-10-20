<?php
// Conexión a la base de datos
include 'db.php';
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    die("Acceso denegado. Debes iniciar sesión para eliminar comentarios.");
}

// Verificar si se ha enviado el ID del comentario
if (isset($_POST['id_comentario']) && isset($_POST['id_publicacion'])) {
    $id_comentario = (int)$_POST['id_comentario'];
    $id_usuario_actual = $_SESSION['id_usuario'];

    // Verificar si el usuario autenticado es el autor del comentario
    $sql_check = "SELECT id_usuario FROM comentarios WHERE id_comentario = $id_comentario";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        $row = $result_check->fetch_assoc();
        $id_usuario_comentario = $row['id_usuario'];

        if ($id_usuario_actual == $id_usuario_comentario) {
            // Eliminar el comentario
            $sql_delete = "DELETE FROM comentarios WHERE id_comentario = $id_comentario";
            if ($conn->query($sql_delete)) {
                header("Location: blog-single-sidebar.php?id=".$_POST['id_publicacion']."&success=deleted");
                exit();
            } else {
                echo "Error al eliminar el comentario: " . $conn->error;
            }
        } else {
            echo "No tienes permiso para eliminar este comentario.";
        }
    } else {
        echo "Comentario no encontrado.";
    }
} else {
    echo "No se ha proporcionado el ID del comentario.";
}

$conn->close();
?>