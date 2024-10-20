<?php
// Verificar si la sesión no ha sido iniciada previamente
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Aquí va el código de validación de sesión, como verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    // Redirigir a la página de inicio de sesión si no está autenticado
    header("Location: login.php");
    exit();
}
?>