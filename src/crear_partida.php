<?php
require_once "../src/validate_session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Asumiendo que el usuario está autenticado y tienes su id en la sesión
    if (isset($_SESSION['id_usuario'])) {
        $nombre_usuario1 = $_SESSION['nombre_usuario'];

        // Recibir datos del formulario
        $juego = $_POST['juego'];
        $puntos = isset($_POST['puntos']) ? $_POST['puntos'] : null;
        $faccion = $_POST['faccion'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_final = $_POST['hora_final'];
        $mesa = $_POST['mesa'];

        // Conectar con la base de datos
        include "./db.php";

        // Verificar conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Insertar datos en la tabla 'partida'
        $sql = "INSERT INTO partida (id_juego, puntos, id_faccion_usuario1, hora_inicio, hora_final, id_mesa, nombre_usuario1)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error en la consulta SQL: " . $conn->error);
        }
        $stmt->bind_param("iissssi", $juego, $puntos, $faccion, $hora_inicio, $hora_final, $mesa, $nombre_usuario1);

        if ($stmt->execute()) {
            // Redirigir a matches.php si la inserción es exitosa
            header("Location: ../public/matches.php");
            exit(); // Detener el script para evitar más ejecución
        } else {
            echo "Error al crear la partida: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Usuario no autenticado.";
    }
} else {
    echo "Método no permitido.";
}
?>

