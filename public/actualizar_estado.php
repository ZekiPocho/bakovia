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
$id_jugador1 = $data['id_jugador1'] ?? null;
$id_jugador2 = $data['id_jugador2'] ?? null;

if (is_null($id_partida) || is_null($estado) || is_null($id_jugador1) || is_null($id_jugador2)) {
    // Prepara un array con los datos requeridos
    $missingData = [
        'id_partida' => $id_partida,
        'estado' => $estado,
        'id_jugador1' => $id_jugador1,
        'id_jugador2' => $id_jugador2
    ];
    
    // Devuelve un JSON con el estado de éxito y los datos faltantes
    echo json_encode(['success' => false, 'message' => 'Faltan datos requeridos.', 'missingData' => $missingData]);
    exit;
}


// Cambiar el estado de la partida
$query = "UPDATE partida SET estado = '$estado' WHERE id_partida = $id_partida";
$result = mysqli_query($conn, $query);

if ($result) {
    if ($estado === 'Finalizado') {
        // Actualizar la columna 'made' de ambos jugadores
        $query_jugador1 = "UPDATE usuarios SET made = 0 WHERE id_usuario = '$id_jugador1'";
        $query_jugador2 = "UPDATE usuarios SET made = 0 WHERE id_usuario = '$id_jugador2'";
        
        $result_jugador1 = mysqli_query($conn, $query_jugador1);
        $result_jugador2 = mysqli_query($conn, $query_jugador2);

        // Obtener el puntaje de ambos jugadores
        $query_puntajes = "SELECT puntaje_jugador1, puntaje_jugador2 FROM partida WHERE id_partida = $id_partida";
        $result_puntajes = mysqli_query($conn, $query_puntajes);
        
        if ($result_puntajes) {
            $row_puntajes = mysqli_fetch_assoc($result_puntajes);
            $puntaje_jugador1 = $row_puntajes['puntaje_jugador1'] ?? 0; // Asumiendo que tienes estas columnas
            $puntaje_jugador2 = $row_puntajes['puntaje_jugador2'] ?? 0;

            // Determinar quién ganó
            $ganador = null;
            if ($puntaje_jugador1 > $puntaje_jugador2) {
                $ganador = $id_jugador1;
            } elseif ($puntaje_jugador2 > $puntaje_jugador1) {
                $ganador = $id_jugador2;
            }

            if ($ganador) {
                // Incrementar la columna 'wins' del ganador
                $query_incrementar_wins = "UPDATE usuarios SET wins = wins + 1 WHERE id_usuario = '$ganador'";
                mysqli_query($conn, $query_incrementar_wins);

                // Determinar el perdedor
                $perdedor = ($ganador === $id_jugador1) ? $id_jugador2 : $id_jugador1;

                // Decrementar la columna 'wins' del perdedor
                $query_decrementar_wins = "UPDATE usuarios SET wins = wins - 1 WHERE id_usuario = '$perdedor'";
                mysqli_query($conn, $query_decrementar_wins);

                // Verificar el rango del ganador
                $query_wins = "SELECT wins FROM usuarios WHERE id_usuario = '$ganador'";
                $result_wins = mysqli_query($conn, $query_wins);
                $row_wins = mysqli_fetch_assoc($result_wins);
                $wins_actuales = $row_wins['wins'] ?? 0;

                // Consultar rangos necesarios
                $query_rangos = "SELECT id_rango FROM rangos WHERE partidas_necesarias = $wins_actuales";
                $result_rangos = mysqli_query($conn, $query_rangos);
                
                if ($result_rangos) {
                    $row_rango = mysqli_fetch_assoc($result_rangos);
                    $nuevo_rango_id = $row_rango['id_rango'] ?? null;

                    if ($nuevo_rango_id) {
                        // Actualizar el rango del ganador
                        $query_actualizar_rango = "UPDATE usuarios SET rango_id = $nuevo_rango_id WHERE id_usuario = '$ganador'";
                        mysqli_query($conn, $query_actualizar_rango);
                    }
                }
            }

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
                    // Redirigir a matches.php
                    echo json_encode(['success' => true, 'redirect' => 'matches.php']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al actualizar los jugadores o la reserva.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al obtener id_reserva.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al obtener puntajes.']);
        }
    } else {
        echo json_encode(['success' => true, 'redirect' => 'matches.php']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar la partida.']);
}

mysqli_close($conn);
?>


