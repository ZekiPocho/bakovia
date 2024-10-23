<?php
include('../public/db.php');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Manejar la solicitud POST para actualizar los datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados
    $id_partida = $_POST['id_partida']; // ID de la partida
    $puntaje_jugador1 = $_POST['puntaje_jugador1']; // Puntaje del jugador 1
    $puntaje_jugador2 = $_POST['puntaje_jugador2']; // Puntaje del jugador 2

    // Consulta para actualizar los datos de la partida
    $query = "UPDATE partida SET puntaje_usuario1 = ?, puntaje_usuario2 = ? WHERE id_partida = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("iii", $puntaje_jugador1, $puntaje_jugador2, $id_partida);

    if ($stmt->execute()) {
        // Si la actualización es exitosa, devuelve los datos actualizados
        $response = [
            'success' => true,
            'id_partida' => $id_partida,
            'puntaje_usuario1' => $puntaje_jugador1,
            'puntaje_usuario2' => $puntaje_jugador2
        ];
    } else {
        // Si hay un error, devuelve un mensaje de error
        $response = [
            'success' => false,
            'error' => 'Error al actualizar la partida: ' . $stmt->error
        ];
    }
    // Cierra la declaración
    $stmt->close();
} else {
    // Manejar la solicitud GET para recibir los datos actuales de la partida
    $id_partida = $_GET['id_partida'];
    $query = "SELECT * FROM partida WHERE id_partida = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id_partida);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        // Devuelve los datos de la partida como JSON
        $response = [
            'success' => true,
            'data' => $data
        ];
    } else {
        $response = [
            'success' => false,
            'error' => 'Partida no encontrada.'
        ];
    }
}

// Cierra la conexión
$conexion->close();

// Envía la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
