<?php
session_start();
require 'conexion.php';  // Incluimos la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Preparamos la consulta
    $sql = "SELECT * FROM usuarios WHERE correo = :correo";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['correo' => $correo]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificamos si el usuario existe y la contraseña es correcta
    if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
        $_SESSION['usuario_id'] = $usuario['id_usuario'];
        $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
        header('Location: profile.html');
        exit;
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>
