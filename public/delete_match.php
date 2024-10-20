<?php
require_once "../src/validate_session.php"; // Asegúrate de que el usuario esté validado
include '../public/db.php'; // Conexión a la base de datos

// Asegúrate de que la conexión se haga con PDO
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener el ID de la partida y el ID de reserva desde el formulario
        $id_partida = htmlspecialchars($_POST['id_partida']);
        $id_reserva = htmlspecialchars($_POST['id_reserva']); // Asegúrate de enviar este campo en el formulario

        // Preparar las consultas
        $sqlDeletePartida = "DELETE FROM partida WHERE id_partida = :id_partida";
        $sqlUpdateMade = "UPDATE usuarios SET made = 0 WHERE nombre_usuario IN 
                          (SELECT nombre_usuario1 FROM partida WHERE id_partida = :id_partida) 
                          OR nombre_usuario IN 
                          (SELECT nombre_usuario2 FROM partida WHERE id_partida = :id_partida)";
        $sqlDeleteReserva = "DELETE FROM reserva_mesa WHERE id_reserva = :id_reserva";

        // Iniciar una transacción
        $conn->beginTransaction();

        // Ejecutar la consulta para eliminar la partida
        $stmtDeletePartida = $conn->prepare($sqlDeletePartida);
        $stmtDeletePartida->bindParam(':id_partida', $id_partida, PDO::PARAM_INT);
        $stmtDeletePartida->execute();

        // Cambiar el made de los jugadores a 0
        $stmtUpdateMade = $conn->prepare($sqlUpdateMade);
        $stmtUpdateMade->bindParam(':id_partida', $id_partida, PDO::PARAM_INT);
        $stmtUpdateMade->execute();

        // Eliminar la reserva
        $stmtDeleteReserva = $conn->prepare($sqlDeleteReserva);
        $stmtDeleteReserva->bindParam(':id_reserva', $id_reserva, PDO::PARAM_INT);
        $stmtDeleteReserva->execute();

        // Confirmar la transacción
        $conn->commit();

        // Redirigir o mostrar un mensaje de éxito
        echo "Partida y reserva eliminadas con éxito.";
        header("Location: matches.php");
    } else {
        // Si no es una solicitud POST, redirigir o mostrar un error
        header("Location: index.php"); // Cambia esto a la página que desees
    }
} catch (PDOException $e) {
    // Revertir la transacción si algo sale mal
    $conn->rollBack();
    echo "Error al eliminar la partida: " . $e->getMessage();
}
?>
