<?php
// Conectar a la base de datos
require '../public/db.php';  // Asegúrate de tener una conexión válida a tu base de datos

// Obtener el cuerpo de la solicitud en formato JSON
$data = json_decode(file_get_contents('php://input'), true);

// Verificar si se recibió el id_partida
if (isset($data['id_partida']) && isset($data['nuevo_estado'])) {
    $id_partida = $data['id_partida'];
    $nuevo_estado = $data['nuevo_estado'];

    // Actualizar el estado de la partida
    $query = "UPDATE partida SET estado = ? WHERE id_partida = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $nuevo_estado, $id_partida);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Datos insuficientes']);
}

$conn->close();
?>
