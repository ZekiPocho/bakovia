<?php
// Incluir tu archivo de conexión a la base de datos
include('conexion.php');

// Verificar si se han recibido los datos necesarios
if (isset($_POST['id_partida']) && isset($_POST['jugador']) && isset($_POST['puntaje'])) {
    $id_partida = $_POST['id_partida'];
    $jugador = $_POST['jugador'];
    $puntaje = $_POST['puntaje'];

    // Actualizar el puntaje dependiendo del jugador
    if ($jugador == 1) {
        $query = "UPDATE partida SET puntaje_usuario1 = ? WHERE id_partida = ?";
    } else if ($jugador == 2) {
        $query = "UPDATE partida SET puntaje_usuario2 = ? WHERE id_partida = ?";
    }

    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $puntaje, $id_partida);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Error al actualizar el puntaje']);
    }
} else {
    echo json_encode(['error' => 'Datos insuficientes']);
}
?>
