<?php
session_start();

// Destruir la sesión
session_destroy();

// Borrar las cookies 'email' y 'password'
if (isset($_COOKIE['email'])) {
    setcookie('email', '', time() - 3600, '/'); // Borra la cookie 'email'
}

if (isset($_COOKIE['password'])) {
    setcookie('password', '', time() - 3600, '/'); // Borra la cookie 'password'
}

// Redirigir al usuario
header("Location: ../public/index.php");
exit(); // Termina la ejecución del script
?>
