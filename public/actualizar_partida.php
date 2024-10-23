<?php
// Incluir tu archivo de conexión a la base de datos
include('../public/db.php');

// Verificar si se ha recibido el ID de la partida
if (isset($_GET['id_partida'])) {
    $id_partida = $_GET['id_partida'];

    // Consulta para obtener los datos de la partida específica
    $query = "SELECT p.id_partida, p.puntaje_usuario1, p.puntaje_usuario2, p.hora_inicio, p.ronda
              FROM partida p 
              WHERE p.id_partida = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_partida);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        $partida = $result->fetch_assoc();

        // Devolver los datos en formato JSON
        echo json_encode([
            'puntaje_jugador1' => $partida['puntaje_usuario1'],
            'puntaje_jugador2' => $partida['puntaje_usuario2'],
            'hora_inicio' => $partida['hora_inicio'],
            'ronda' => $partida['ronda']
        ]);
    } else {
        echo json_encode(['error' => 'Partida no encontrada']);
    }
} else {
    echo json_encode(['error' => 'ID de partida no proporcionado']);
}
?>
