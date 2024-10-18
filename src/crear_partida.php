<?php
require_once "../src/validate_session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que el usuario está autenticado
    if (isset($_SESSION['id_usuario'])) {
        $nombre_usuario = $_SESSION['nombre_usuario'];
        $id_usuario = $_SESSION['id_usuario']; // Asegúrate de que el id del usuario esté en la sesión

        // Recibir datos del formulario
        $mesa = $_POST['mesa'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_final = $_POST['hora_final'];
        $fecha = date('Y-m-d');  // Asume que la reserva es para el mismo día
        
        // Datos de la partida
        $juego = $_POST['juego']; 
        $puntos = $_POST['puntos']; 
        $faccion_usuario1 = $_POST['faccion_usuario1'];
        $faccion_usuario2 = $_POST['faccion_usuario2'] ?? null; // Jugador 2 puede ser null si aún no hay contrincante
        
        // Conectar a la base de datos
        include "../public/db.php";

        // Verificar conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Iniciar la transacción
        $conn->begin_transaction();

        try {
            // 1. Insertar reserva en la tabla 'reserva_mesa'
            $sql_reserva = "INSERT INTO reserva_mesa (id_mesa, nombre_usuario, fecha, id_hora_inicio, id_hora_final) 
                            VALUES (?, ?, ?, ?, ?)";
            
            $stmt_reserva = $conn->prepare($sql_reserva);
            if ($stmt_reserva === false) {
                throw new Exception("Error en la consulta de reserva: " . $conn->error);
            }

            // Vincular parámetros y ejecutar
            $stmt_reserva->bind_param("issii", $mesa, $nombre_usuario, $fecha, $hora_inicio, $hora_final);
            if (!$stmt_reserva->execute()) {
                throw new Exception("Error al insertar la reserva: " . $stmt_reserva->error);
            }

            // 2. Insertar la partida en la tabla 'partida'
            $sql_partida = "INSERT INTO partida (id_juego, puntos, id_faccion_usuario1, id_faccion_usuario2, estado, id_mesa, hora_inicio, hora_final) 
                            VALUES (?, ?, ?, ?, 'abierto', ?, ?, ?)";
            
            $stmt_partida = $conn->prepare($sql_partida);
            if ($stmt_partida === false) {
                throw new Exception("Error en la consulta de partida: " . $conn->error);
            }

            // Vincular parámetros y ejecutar
            $stmt_partida->bind_param("iiiiiss", $juego, $puntos, $faccion_usuario1, $faccion_usuario2, $mesa, $hora_inicio, $hora_final);
            if (!$stmt_partida->execute()) {
                throw new Exception("Error al insertar la partida: " . $stmt_partida->error);
            }

            // Si ambas inserciones fueron exitosas, confirmar la transacción
            $conn->commit();

            // Redirigir a la página de confirmación si es exitoso
            header("Location: ../public/reservas.php");
            exit(); // Detener el script para evitar más ejecución

        } catch (Exception $e) {
            // Si ocurre algún error, deshacer las inserciones
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }

        // Cerrar conexiones y sentencias
        $stmt_reserva->close();
        $stmt_partida->close();
        $conn->close();

    } else {
        echo "Usuario no autenticado.";
    }
} else {
    echo "Método no permitido.";
}
?>
