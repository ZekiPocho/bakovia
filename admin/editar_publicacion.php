<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    // Redirigir a la página de inicio de sesión si no está autenticado
    header("Location: ../public/login.php");
    exit();
}
include("../public/db.php");

// Verifica si el usuario ha iniciado sesión y si tiene el rol de administrador (id_rol = 1)
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    header('Location: ../public/index.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_publicacion = $_POST['id_publicacion'];
    
    // Eliminar la publicación
    $sql = "DELETE FROM publicaciones WHERE id_publicacion = $id_publicacion";
    if ($conn->query($sql)) {
        header("Location: admin_dashboard.php?delete_success=1");
        exit();
    } else {
        echo "Error al eliminar: " . $conn->error;
    }
}
?>