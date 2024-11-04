<?php
include('../public/db.php');

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(['error' => 'Error de conexión: ' . $conn->connect_error]));
}

// Comprobar si se ha pasado el ID de la partida
if (isset($_GET['id_partida'])) {
    $id_partida = intval($_GET['id_partida']);

    // Consulta para obtener los datos de la partida
    $sql = "SELECT p.*, 
       p.nombre_usuario1 AS nombre_jugador1,
       p.nombre_usuario2 AS nombre_jugador2,
       f1.nombre AS faccion1, 
       f1.subfaccion AS subfaccion1, 
       f1.icono AS icono1,
       f2.nombre AS faccion2, 
       f2.subfaccion AS subfaccion2, 
       f2.icono AS icono2
FROM partida p
JOIN faccion f1 ON p.id_faccion_usuario1 = f1.id_faccion
JOIN faccion f2 ON p.id_faccion_usuario2 = f2.id_faccion
WHERE p.id_partida = $id_partida;";

    $result = $conn->query($sql);
    if ($result) {
        $partida = $result->fetch_assoc();
        if ($partida) {
            // Devolver los datos de la partida como JSON
            echo json_encode($partida);
        } else {
            echo json_encode(['error' => 'Partida no encontrada']);
        }
    } else {
        echo json_encode(['error' => 'Error en la consulta: ' . $conn->error]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se está actualizando el puntaje o la ronda
    $id_partida = $_POST['id_partida'];

    if (isset($_POST['jugador']) && isset($_POST['puntaje'])) {
        // Actualizar puntaje del jugador
        $jugador = intval($_POST['jugador']);
        $puntaje = intval($_POST['puntaje']);

        // Validar datos
        if ($jugador < 1 || $jugador > 2) {
            echo json_encode(['error' => 'Jugador no válido']);
            exit;
        }

        // Actualizar puntaje en la base de datos
        $campo_puntaje = $jugador === 1 ? 'puntaje_usuario1' : 'puntaje_usuario2';
        $sql_update = "UPDATE partida SET $campo_puntaje = ? WHERE id_partida = ?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param('ii', $puntaje, $id_partida);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Error al actualizar el puntaje: ' . $stmt->error]);
        }

        $stmt->close();
    } elseif (isset($_POST['ronda'])) {
        // Actualizar la ronda
        $ronda = intval($_POST['ronda']);

        // Actualizar ronda en la base de datos
        $sql_update_ronda = "UPDATE partida SET ronda = ? WHERE id_partida = ?";
        $stmt_ronda = $conn->prepare($sql_update_ronda);
        $stmt_ronda->bind_param('ii', $ronda, $id_partida);

        if ($stmt_ronda->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Error al actualizar la ronda: ' . $stmt_ronda->error]);
        }

        $stmt_ronda->close();
    } else {
        echo json_encode(['error' => 'Datos no válidos para actualizar']);
    }
} else {
    echo json_encode(['error' => 'Método no permitido']);
}

$conn->close();
?>
