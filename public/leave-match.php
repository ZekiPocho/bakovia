<?php

require_once "../src/validate_session.php"; // Asegúrate de que el usuario esté validado
include '../public/db.php'; // Conexión a la base de datos

// Obtener el ID de la partida desde la URL
$id_partida = isset($_GET['id_partida']) ? intval($_GET['id_partida']) : 0;

// Obtener el nombre del usuario desde la sesión
$nombre_usuario = $_SESSION['nombre_usuario'];

// Verificar si se ha proporcionado un ID de partida válido
if ($id_partida > 0) {
    // Consultar el estado de la partida
    $sql_check_estado = "SELECT estado FROM partida WHERE id_partida = ?";
    $stmt_check_estado = $conn->prepare($sql_check_estado);
    $stmt_check_estado->bind_param("i", $id_partida);
    $stmt_check_estado->execute();
    $stmt_check_estado->bind_result($estado);
    $stmt_check_estado->fetch();
    $stmt_check_estado->close();

    // Agregar logs para verificar el ID de la partida y su estado
    error_log("ID de partida recibido: " . $id_partida);
    error_log("Estado de la partida: " . $estado);

    // Verificar si la partida está en progreso
    if ($estado === 'en progreso') {
        echo '<script type="text/javascript">
                alert("La partida ya empezó.");
                window.location.href = "matches.php";
              </script>';
        exit; // Terminar el script después de mostrar la alerta
    }

    // Si la partida no está en progreso, proceder a actualizar
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
