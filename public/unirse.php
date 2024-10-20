<?php
require_once "../src/validate_session.php";

include '../public/db.php'; // Asegúrate de incluir tu archivo de conexión a la base de datos

// Obtener el ID de la partida de la solicitud POST
$id_partida = isset($_POST['id_partida']) ? intval($_POST['id_partida']) : 0;

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
        if ($partida['estado'] === 'programado') {
            // Obtener el nombre del usuario desde la sesión
            $nombre_usuario = $_SESSION['usuario'];

            // Actualizar la partida con el nombre del segundo jugador y la facción
            $sql_update = "UPDATE partida SET nombre_usuario2 = ?, id_faccion_usuario2 = ?, estado = 'en progreso' WHERE id_partida = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("ssi", $nombre_usuario, $faccion_usuario, $id_partida);

            if ($stmt_update->execute()) {
                echo "Te has unido a la partida con éxito.";
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

$conn->close();
?>
