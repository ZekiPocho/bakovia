<?php
// Incluir tu archivo de conexión a la base de datos
include('../public/db.php');

// Verificar si se ha recibido el ID de la partida
if (isset($_GET['id_partida'])) {
    $id_partida = $_GET['id_partida'];

    // Consulta para obtener los datos de la partida
    $query = "SELECT p.puntaje_usuario1, p.puntaje_usuario2, 
                      j1.nombre AS nombre_jugador1, 
                      j2.nombre AS nombre_jugador2, 
                      f1.nombre AS faccion1, f1.subfaccion AS subfaccion1, f1.icono AS icono1,
                      f2.nombre AS faccion2, f2.subfaccion AS subfaccion2, f2.icono AS icono2,
                      p.nombre_juego, p.puntos, p.hora_inicio
              FROM partida p
              JOIN jugador j1 ON p.id_jugador1 = j1.id_jugador
              JOIN jugador j2 ON p.id_jugador2 = j2.id_jugador
              JOIN faccion f1 ON p.id_faccion_usuario1 = f1.id_faccion
              JOIN faccion f2 ON p.id_faccion_usuario2 = f2.id_faccion
              WHERE p.id_partida = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_partida);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'Partida no encontrada']);
    }
} else {
    echo json_encode(['error' => 'ID de partida no proporcionado']);
}
?>
