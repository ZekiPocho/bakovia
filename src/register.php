<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'conexion.php';

    $nombre_usuario = $_POST['nombre_usuario'];
    $correo = $_POST['correo'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

    // Preparamos la consulta para insertar el usuario
    $sql = "INSERT INTO usuarios (nombre_usuario, correo, contraseña) VALUES (:nombre_usuario, :correo, :contraseña)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute(['nombre_usuario' => $nombre_usuario, 'correo' => $correo, 'contraseña' => $contraseña])) {
        echo "Usuario registrado exitosamente";
    } else {
        echo "Error al registrar el usuario";
    }
}
?>