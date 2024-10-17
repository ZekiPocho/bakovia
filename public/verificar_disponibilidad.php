<?php
include '../public/db.php'; // Asegúrate de incluir tu conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_mesa = $_POST['id_mesa'];
    $id_hora_inicio = $_POST['id_hora_inicio'];
    $id_hora_final = $_POST['id_hora_final'];
    $fecha_actual = date('Y-m-d');

    // Verificar si la mesa está ocupada
    $query_reserva = "SELECT * FROM reserva_mesa WHERE id_mesa = $id_mesa 
                      AND id_hora_inicio <= $id_hora_final 
                      AND id_hora_final >= $id_hora_inicio 
                      AND fecha = '$fecha_actual'";
    $result_reserva = mysqli_query($conn, $query_reserva);

    $disponible = mysqli_num_rows($result_reserva) === 0; // True si está disponible

    echo json_encode(['disponible' => $disponible]);
}
?>

