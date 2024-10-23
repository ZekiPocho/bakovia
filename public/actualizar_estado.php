<?php
// Conexión a la base de datos
include '../public/db.php'; // Asegúrate de incluir la conexión a tu base de datos

// Configurar el encabezado para JSON
header('Content-Type: application/json');

// Obtener los datos enviados por fetch
$data = json_decode(file_get_contents('php://input'), true);

// Verifica que todos los datos necesarios estén presentes
$id_partida = $data['id_partida'] ?? null;
$estado = $data['estado'] ?? null;
$id_jugador1 = $data['nombre_jugador1'] ?? null;
$id_jugador2 = $data['nombre_jugador2'] ?? null;

if (is_null($id_partida) || is_null($estado) || is_null($id_jugador1) || is_null($id_jugador2)) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos requeridos.']);
    exit;
}

// Cambiar el estado de la partida
$query = "UPDATE partida SET estado = '$estado' WHERE id_partida = $id_partida";
$result = mysqli_query($conn, $query);

if ($result) {
    if ($estado === 'finalizado') {
        // Actualizar la columna 'made' de ambos jugadores
        $query_jugador1 = "UPDATE usuarios SET made = 0 WHERE nombre_usuario = $id_jugador1";
        $query_jugador2 = "UPDATE usuarios SET made = 0 WHERE nombre_usuario = $id_jugador2";
        
        $result_jugador1 = mysqli_query($conn, $query_jugador1);
        $result_jugador2 = mysqli_query($conn, $query_jugador2);

        // Obtener el id_reserva desde la tabla partida
        $query_id_reserva = "SELECT id_reserva FROM partida WHERE id_partida = $id_partida";
        $result_reserva = mysqli_query($conn, $query_id_reserva);

        if ($result_reserva) {
            $row_reserva = mysqli_fetch_assoc($result_reserva);
            $id_reserva = $row_reserva['id_reserva'] ?? null;

            // Eliminar la reserva vinculada usando el id_reserva
            if ($id_reserva) {
                $query_eliminar_reserva = "DELETE FROM reserva_mesa WHERE id_reserva = $id_reserva";
                $result_eliminar_reserva = mysqli_query($conn, $query_eliminar_reserva);
            }

            // Verificar que ambos jugadores y la reserva se hayan actualizado correctamente
            if ($result_jugador1 && $result_jugador2 && (!isset($query_eliminar_reserva) || $result_eliminar_reserva)) {
                echo json_encode(['success' => true, 'redirect' => 'matches.php']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al actualizar los jugadores o la reserva.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al obtener id_reserva.']);
        }
    } else {
        echo json_encode(['success' => true]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar la partida.']);
}

mysqli_close($conn);
?>
