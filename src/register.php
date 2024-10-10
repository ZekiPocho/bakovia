<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'db.php';

    $nombre_usuario = $_POST['username'];
    $correo = $_POST['email'];
    $contraseña = password_hash($_POST['clave'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre_usuario, correo, contraseña) VALUES (:nombre_usuario, :correo, :contraseña)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute(['nombre_usuario' => $nombre_usuario, 'correo' => $correo, 'contraseña' => $contraseña])) {
        echo "Usuario registrado exitosamente";
    } else {
        echo "Error al registrar el usuario";
    }
}
?>