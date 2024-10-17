<?php
// Conexión a la base de datos
include('conexion.php'); // Asegúrate de incluir el archivo correcto para la conexión a la base de datos

// Configuración para que los nombres de días estén en español
mysqli_query($conn, "SET lc_time_names = 'es_ES'");

// Fecha actual
$fecha_actual = date('Y-m-d');

// Consulta para obtener los horarios del día actual
$query_horarios = "SELECT h.id_horario, h.hora_inicio 
                   FROM horarios h 
                   WHERE DAYNAME(CURDATE()) = h.dia_semana";
$result_horarios = mysqli_query($conn, $query_horarios);

// Genera el HTML de las filas de la tabla
while ($horario = mysqli_fetch_assoc($result_horarios)) {
    echo "<tr style='background-color: white; border: solid 2px #171D25'>";
    echo "<td>" . $horario['hora_inicio'] . "</td>";

    // Itera sobre las mesas (1 a 3)
    for ($mesa = 1; $mesa <= 3; $mesa++) {
        // Consulta para verificar si la mesa está ocupada en este horario
        $query_reserva = "SELECT * FROM reserva_mesa 
                          WHERE id_mesa = $mesa 
                          AND id_hora_inicio <= " . $horario['id_horario'] . " 
                          AND id_hora_final >= " . $horario['id_horario'] . " 
                          AND fecha = '$fecha_actual'";
        $result_reserva = mysqli_query($conn, $query_reserva);

        // Determina si la mesa está ocupada o disponible
        if (mysqli_num_rows($result_reserva) > 0) {
            // Mesa ocupada
            echo "<td class='ocupado'>Ocupado</td>";
        } else {
            // Mesa disponible
            echo "<td class='disponible'>Disponible</td>";
        }
    }

    echo "</tr>";
}
?>
