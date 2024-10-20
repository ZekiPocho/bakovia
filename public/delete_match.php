<?php
require_once "../src/validate_session.php"; // Asegúrate de que el usuario esté validado
include '../public/db.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el ID de la partida y el ID de reserva desde el formulario
    $id_partida = htmlspecialchars($_POST['id_partida']);
    $id_reserva = htmlspecialchars($_POST['id_reserva']); // Asegúrate de enviar este campo en el formulario

    // Preparar las consultas
    $sqlDeletePartida = "DELETE FROM partida WHERE id_partida = ?";
    $sqlUpdateMade = "UPDATE usuarios SET made = 0 
                      WHERE nombre_usuario IN 
                      (SELECT nombre_usuario1 FROM partida WHERE id_partida = ?) 
                      OR nombre_usuario IN 
                      (SELECT nombre_usuario2 FROM partida WHERE id_partida = ?)";
    $sqlDeleteReserva = "DELETE FROM reserva_mesa WHERE id_reserva = ?";

    // Iniciar una transacción
    $conn->begin_transaction();

    try {
        // Cambiar el made de los jugadores a 0
        $stmtUpdateMade = $conn->prepare($sqlUpdateMade);
        $stmtUpdateMade->bind_param("ii", $id_partida, $id_partida);
        if (!$stmtUpdateMade->execute()) {
            throw new Exception($stmtUpdateMade->error);
        }
        
        // Ejecutar la consulta para eliminar la partida
        $stmtDeletePartida = $conn->prepare($sqlDeletePartida);
        $stmtDeletePartida->bind_param("i", $id_partida);
        if (!$stmtDeletePartida->execute()) {
            throw new Exception($stmtDeletePartida->error);
        }

        // Eliminar la reserva
        $stmtDeleteReserva = $conn->prepare($sqlDeleteReserva);
        $stmtDeleteReserva->bind_param("i", $id_reserva);
        if (!$stmtDeleteReserva->execute()) {
            throw new Exception($stmtDeleteReserva->error);
        }

        // Confirmar la transacción
        $conn->commit();

        // Redirigir o mostrar un mensaje de éxito
        echo "Partida y reserva eliminadas con éxito.";
        header("Location: matches.php");
        exit(); // Asegúrate de usar exit después de redirigir
    } catch (Exception $e) {
        // Revertir la transacción si algo sale mal
        $conn->rollback();
        echo "Error al eliminar la partida: " . $e->getMessage();
    }
} else {
    // Si no es una solicitud POST, redirigir o mostrar un error
    header("Location: index.php"); // Cambia esto a la página que desees
    exit(); // Asegúrate de usar exit después de redirigir
}
?>
