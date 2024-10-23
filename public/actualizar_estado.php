<?php
// Conexión a la base de datos
include 'conexion.php'; // Asegúrate de incluir la conexión a tu base de datos

// Obtener los datos enviados por fetch
$data = json_decode(file_get_contents('php://input'), true);

$id_partida = $data['id_partida'];
$estado = $data['estado'];
$id_jugador1 = $data['id_jugador1'];
$id_jugador2 = $data['id_jugador2'];

// Cambiar el estado de la partida
$query = "UPDATE partida SET estado = '$estado' WHERE id_partida = $id_partida";
$result = mysqli_query($conexion, $query);

if ($result) {
    // Si la partida ha finalizado, actualizar la columna 'made' de ambos jugadores
    if ($estado === 'finalizado') {
        $query_jugador1 = "UPDATE usuarios SET made = 0 WHERE id_usuario = $id_jugador1";
        $query_jugador2 = "UPDATE usuarios SET made = 0 WHERE id_usuario = $id_jugador2";
        
        $result_jugador1 = mysqli_query($conexion, $query_jugador1);
        $result_jugador2 = mysqli_query($conexion, $query_jugador2);
        
        if ($result_jugador1 && $result_jugador2) {
            // Devolver respuesta de éxito
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar los jugadores.']);
        }
    } else {
        // Devolver respuesta de éxito si solo se cambió el estado
        echo json_encode(['success' => true]);
    }
} else {
    // Devolver respuesta de error si falla la actualización de la partida
    echo json_encode(['success' => false, 'message' => 'Error al actualizar la partida.']);
}

mysqli_close($conexion);
?>
