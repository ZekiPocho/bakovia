<?php
require_once "../src/validate_session.php"; // Verifica que el usuario esté autenticado

include '../public/db.php'; // Incluye la conexión a la base de datos

// Obtener el ID de la partida de la sesión
$id_partida = isset($_SESSION['id_partida']) ? intval($_SESSION['id_partida']) : 0;

// Obtener la facción del segundo jugador del POST
$faccion_usuario = isset($_POST['faccion']) ? $_POST['faccion'] : null;

// Verificar si se ha proporcionado un ID de partida válido y la facción no es nula
if ($id_partida > 0 && $faccion_usuario !== null) {
    // Obtener los detalles de la partida para verificar el estado
    $sql = "SELECT * FROM partida WHERE id_partida = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_partida);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $partida = $result->fetch_assoc();

        // Comprobar el estado de la partida
        if ($partida['estado'] === 'Programado') {
            // Obtener el nombre del usuario desde la sesión
            $nombre_usuario = $_SESSION['nombre_usuario'];

            // Actualizar la partida con el nombre del segundo jugador y la facción
            $sql_update = "UPDATE partida SET nombre_usuario2 = ?, id_faccion_usuario2 = ?, estado = 'en progreso' WHERE id_partida = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("ssi", $nombre_usuario, $faccion_usuario, $id_partida);

            if ($stmt_update->execute()) {
                // Actualizar la columna 'made' del usuario en la base de datos
                $sql_user_update = "UPDATE usuarios SET made = 1 WHERE nombre_usuario = ?";
                $stmt_user_update = $conn->prepare($sql_user_update);
                $stmt_user_update->bind_param("s", $nombre_usuario);
                $stmt_user_update->execute();

                // Redirigir a matches.php
                header("Location: matches.php");
                exit;
            } else {
                echo "Error al unirte a la partida: " . $stmt_update->error;
            }
        } else {
            echo "La partida no está disponible para unirse.";
        }
    } else {
        echo "Partida no encontrada.";
    }
} else {
    echo "ID de partida inválido o facción no especificada.";
}

$conn->close(); // Cierra la conexión a la base de datos
?>
