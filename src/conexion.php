<?php
$host = 'localhost';
$dbname = 'bakoviadb';  // Nombre de la base de datos
$username = 'tu_usuario';  // Cambiar por tu usuario de MySQL
$password = 'tu_contraseña';  // Cambiar por tu contraseña de MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Configurar PDO para que lance excepciones en caso de error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Error al conectar con la base de datos: ' . $e->getMessage());
}
?>