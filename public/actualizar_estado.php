<?php
// Conectar a la base de datos
require '../public/db.php';  // Asegúrate de tener una conexión válida a tu base de datos

$data = json_decode(file_get_contents("php://input"), true);

$id_partida = $data['id_partida'];
$estado = $data['estado'];

// Actualizar el estado en la base de datos
$query = "UPDATE partida SET estado = ? WHERE id_partida = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('si', $estado, $id_partida);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
