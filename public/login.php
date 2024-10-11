<?php

session_start();
include "db.php";

// Verificar si las cookies existen
if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
    $email = $_COOKIE['email'];
    $password = $_COOKIE['password'];
    
    // Verificar si los datos de las cookies son válidos
    $res = $conn->query("SELECT * FROM usuarios 
        WHERE correo='$email' 
        AND contrasena='$password'  
        AND verificado='si'") or die($conn->error);
    
    if (mysqli_num_rows($res) > 0) {
        // Si es válido, iniciar la sesión automáticamente
        $_SESSION['user'] = $email;
        header("Location:../public/index.html");
        exit();
    }
}

$email = $_POST['email'];
$password = sha1($_POST['clave']);

// Consulta SQL para verificar el correo y la contraseña
$res = $conn->query("SELECT * FROM usuarios 
    WHERE correo='$email' 
    AND contrasena='$password'  
    AND verificado='si'") or die($conn->error);

if (mysqli_num_rows($res) > 0) {
    // Iniciar sesión
    session_start();
    $_SESSION['user'] = $email;
    
    // Verificar si la opción de 'remember me' está seleccionada
    if (isset($_POST['remember'])) {
        // Generar cookies con duración de 30 días
        setcookie('email', $email, time() + (86400 * 30), "/"); // 86400 = 1 día
        setcookie('password', $password, time() + (86400 * 30), "/");
    }
    
    // Redirigir al usuario a la página principal
    header("Location:../public/index.html");
} else {
    echo "login incorrecto";
}
?>
