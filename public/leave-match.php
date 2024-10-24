<?php

require_once "../src/validate_session.php"; // Asegúrate de que el usuario esté validado
include '../public/db.php'; // Conexión a la base de datos

// Obtener el ID de la partida desde la URL
$id_partida = isset($_GET['id_partida']) ? intval($_GET['id_partida']) : 0;

// Obtener el nombre del usuario desde la sesión
$nombre_usuario = $_SESSION['nombre_usuario'];

// Verificar si se ha proporcionado un ID de partida válido
if ($id_partida > 0) {
    // Actualizar la partida para cambiar el nombre y facción del usuario2
    $sql_update_partida = "UPDATE partida SET nombre_usuario2 = 'N/A', id_faccion_usuario2 = 31416 WHERE id_partida = ? AND nombre_usuario2 = ?";
    $stmt_update_partida = $conn->prepare($sql_update_partida);
    $stmt_update_partida->bind_param("is", $id_partida, $nombre_usuario); // Utiliza el nombre de usuario de la sesión

    // Ejecutar la consulta para actualizar la partida
    if ($stmt_update_partida->execute()) {
        // Actualizar el valor de made del usuario en la tabla de usuarios
        $sql_update_usuario = "UPDATE usuarios SET made = 0 WHERE nombre_usuario = ?";
        $stmt_update_usuario = $conn->prepare($sql_update_usuario);
        $stmt_update_usuario->bind_param("s", $nombre_usuario); // Utiliza el nombre de usuario de la sesión

        if ($stmt_update_usuario->execute()) {
            // Redirigir a matches.php después de salir de la partida
            header("Location: matches.php");
            exit;
        } else {
            echo "Error al actualizar el estado del usuario: " . $stmt_update_usuario->error;
        }
    } else {
        echo "Error al salir de la partida: " . $stmt_update_partida->error;
    }
} else {
    echo "ID de partida inválido.";
}

$conn->close();
?>
