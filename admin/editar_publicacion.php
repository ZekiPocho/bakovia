<?php
include '../public/db.php'; 
include 'validate_session.php';

// Verificar si el usuario es superadministrador
if ($_SESSION['rol'] !== 'superadmin') {
    header("Location: index.php");
    exit();
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