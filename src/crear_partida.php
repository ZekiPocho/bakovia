<?php
require_once "../src/validate_session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que el usuario está autenticado
    if (isset($_SESSION['id_usuario'])) {
        $nombre_usuario1 = $_SESSION['nombre_usuario'];
        $id_usuario = $_SESSION['id_usuario'];
        // Datos de la partida
        $juego = $_SESSION['juego'];
        $puntos = $_SESSION['puntos'];
        $faccion = $_SESSION['faccion'];
        $id_p_r = rand(1000000000, 9999999999);



        // Recibir datos del formulario
        $mesa = $_POST['mesa'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_final = $_POST['hora_final'];        
        
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
            $sql_reserva = "INSERT INTO reserva_mesa (id_reserva, id_mesa, nombre_usuario, id_hora_inicio, id_hora_final) 
                            VALUES (?, ?, ?, ?, ?)";
            
            $stmt_reserva = $conn->prepare($sql_reserva);
            if ($stmt_reserva === false) {
                throw new Exception("Error en la consulta de reserva: " . $conn->error);
            }

            // Vincular parámetros y ejecutar
            $stmt_reserva->bind_param("iisii", $id_p_r, $mesa, $nombre_usuario1, $hora_inicio, $hora_final);
            if (!$stmt_reserva->execute()) {
                throw new Exception("Error al insertar la reserva: " . $stmt_reserva->error);
            }

            // 2. Insertar la partida en la tabla 'partida'
            $sql_partida = "INSERT INTO partida (id_reserva, id_juego, puntos, id_faccion_usuario1, hora_inicio, hora_final, id_mesa, nombre_usuario1)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt_partida = $conn->prepare($sql_partida);
            if ($stmt_partida === false) {
                throw new Exception("Error en la consulta de partida: " . $conn->error);
            }

            

            // Vincular parámetros y ejecutar
            $stmt_partida->bind_param("iiisssss", $id_p_r, $juego, $puntos, $faccion, $hora_inicio, $hora_final, $mesa, $nombre_usuario1);
            if (!$stmt_partida->execute()) {
                throw new Exception("Error al insertar la partida: " . $stmt_partida->error);
            }


            $id_usuario = $_SESSION['id_usuario']; // Obtener el ID del usuario de la sesión

            // Consulta para actualizar el valor de 'made'
            $sql_usuario = "UPDATE usuarios SET made = ? WHERE id_usuario = ?";

            $stmt_usuario = $conn->prepare($sql_usuario);
            if ($stmt_usuario === false) {
                throw new Exception("Error en la consulta de actualización de usuarios: " . $conn->error);
            }

            // Asignar los valores a variables
            $made_value = 1; // 1 representa true en este caso

            // Vincular parámetros y ejecutar
            $stmt_usuario->bind_param("ii", $made_value, $id_usuario);
            if (!$stmt_usuario->execute()) {
                throw new Exception("Error al actualizar el usuario: " . $stmt_usuario->error);
            }

            // Cerrar el statement
            $stmt_usuario->close();


            // Si ambas inserciones fueron exitosas, confirmar la transacción
            $conn->commit();

            // Redirigir a la página de confirmación si es exitoso
            header("Location: ../public/matches.php");
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
