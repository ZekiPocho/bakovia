<?php
session_start();
require_once "../src/validate_session.php"; // Asegúrate de que el usuario esté validado
include '../public/db.php'; // Conexión a la base de datos

// Obtener el ID de la partida desde la URL
$id_partida = isset($_GET['id_partida']) ? intval($_GET['id_partida']) : 0;

// Obtener el nombre del usuario desde la sesión
$nombre_usuario = $_SESSION['nombre_usuario'];

// Verificar si se ha proporcionado un ID de partida válido
if ($id_partida > 0) {
    // Actualizar la partida para cambiar el nombre y facción del usuario2
    $sql_update = "UPDATE partida SET nombre_usuario2 = 'N/A', id_faccion_usuario2 = 31416 WHERE id_partida = ? AND nombre_usuario2 = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("is", $id_partida, $nombre_usuario); // Utiliza el nombre de usuario de la sesión

    if ($stmt_update->execute()) {
        // Redirigir a matches.php después de salir de la partida
        header("Location: matches.php");
        exit;
    } else {
        echo "Error al salir de la partida: " . $stmt_update->error;
    }
} else {
    echo "ID de partida inválido.";
}

$conn->close();
?>
