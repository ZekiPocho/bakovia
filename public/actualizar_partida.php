<?php
// Incluir tu archivo de conexión a la base de datos
include('../public/db.php');

// Verificar si se ha recibido el id de la partida
if (isset($_GET['id_partida'])) {
    $id_partida = $_GET['id_partida'];

    // Consultar la base de datos para obtener los datos actualizados de la partida
    $query = "SELECT * FROM partida WHERE id_partida = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_partida);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $partida = $result->fetch_assoc();
            echo json_encode([
                'success' => true,
                'puntaje_jugador1' => $partida['puntaje_usuario1'],
                'puntaje_jugador2' => $partida['puntaje_usuario2'],
                'hora_inicio' => $partida['hora_inicio'],
                'ronda' => $partida['ronda'],
            ]);
        } else {
            echo json_encode(['error' => 'Partida no encontrada']);
        }
    } else {
        echo json_encode(['error' => 'Error al recuperar datos de la partida']);
    }
} else {
    echo json_encode(['error' => 'ID de partida no especificado']);
}
?>
