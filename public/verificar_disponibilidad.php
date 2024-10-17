<?php
include '../public/db.php'; // Asegúrate de incluir tu archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_mesa = $_POST['id_mesa'];
    $id_hora_inicio = $_POST['id_hora_inicio'];
    $id_hora_final = $_POST['id_hora_final'];
    $fecha_actual = date('Y-m-d');

    // Consultar si la mesa está ocupada en ese rango de tiempo
    $query_verificar = "SELECT * FROM reserva_mesa 
                        WHERE id_mesa = $id_mesa 
                        AND id_hora_inicio <= $id_hora_final 
                        AND id_hora_final >= $id_hora_inicio 
                        AND fecha = '$fecha_actual'";
    $result_verificar = mysqli_query($conn, $query_verificar);

    if (mysqli_num_rows($result_verificar) > 0) {
        echo json_encode(["disponible" => false]);
    } else {
        echo json_encode(["disponible" => true]);
    }
}
?>
