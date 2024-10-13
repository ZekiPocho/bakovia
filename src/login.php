<?php

session_start();
include "./db.php";

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
        // Obtener los datos del usuario
        $userData = $res->fetch_assoc();
        
        // Guardar los datos relevantes en la sesión
        $_SESSION['user'] = $userData['correo'];
        $_SESSION['nombre_usuario'] = $userData['nombre_usuario']; // Guardar nombre de usuario
        $_SESSION['id_usuario'] = $userData['id_usuario']; // Guardar el ID del usuario si lo necesitas
        
        // Redirigir a la página principal
        header("Location:../public/index.html");
        exit();
    }
}

// Verificar si el formulario de inicio de sesión ha sido enviado
if (isset($_POST['email']) && isset($_POST['clave'])) {
    $email = $_POST['email'];
    $password = sha1($_POST['clave']);

    // Consulta SQL para verificar el correo y la contraseña
    $res = $conn->query("SELECT * FROM usuarios 
        WHERE correo='$email' 
        AND contrasena='$password'  
        AND verificado='si'") or die($conn->error);

    if (mysqli_num_rows($res) > 0) {
        // Obtener los datos del usuario
        $userData = $res->fetch_assoc();

        // Iniciar sesión y guardar datos relevantes
        $_SESSION['user'] = $userData['correo'];
        $_SESSION['nombre_usuario'] = $userData['nombre_usuario']; // Guardar nombre de usuario
        $_SESSION['id_usuario'] = $userData['id_usuario']; // Guardar el ID del usuario si lo necesitas
        
        // Verificar si la opción de 'remember me' está seleccionada
        if (isset($_POST['remember'])) {
            // Generar cookies con duración de 30 días
            setcookie('email', $email, time() + (86400 * 30), "/"); // 86400 = 1 día
            setcookie('password', $password, time() + (86400 * 30), "/");
        }

        // Redirigir al usuario a la página principal
        header("Location:../public/index.html");
        exit();
    } else {
        echo "Login incorrecto";
    }
}
?>
