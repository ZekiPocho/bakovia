<?php
require_once("../src/validate_session.php");
include("../public/db.php");

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id_usuario = $_SESSION['id_usuario']; // Obtener el ID del usuario de la sesión

// Consulta para obtener partidas programadas
$sql = "SELECT 
    p.id_partida, 
    j.nombre AS id_juego, 
    p.puntos, 
    p.nombre_usuario1, 
    u1.made AS made_usuario1, 
    p.nombre_usuario2, 
    u2.made AS made_usuario2, 
    f1.nombre AS faccion1, 
    f1.subfaccion AS subfaccion1, 
    f1.icono AS icono1, 
    f2.nombre AS faccion2, 
    f2.subfaccion AS subfaccion2, 
    f2.icono AS icono2,
    LEFT(h1.hora, 5) AS hora_inicio, 
    LEFT(h2.hora, 5) AS hora_final, 
    p.id_mesa, 
    p.puntaje_usuario1, 
    p.puntaje_usuario2,
    u_made.made AS made_usuario_sesion 
FROM partida p
JOIN faccion f1 ON p.id_faccion_usuario1 = f1.id_faccion
JOIN faccion f2 ON p.id_faccion_usuario2 = f2.id_faccion
LEFT JOIN usuarios u1 ON p.nombre_usuario1 = u1.nombre_usuario
LEFT JOIN usuarios u2 ON p.nombre_usuario2 = u2.nombre_usuario
LEFT JOIN usuarios u_made ON u_made.id_usuario = ? 
JOIN juego j ON p.id_juego = j.id_juego 
JOIN horarios h1 ON p.hora_inicio = h1.id_hora 
JOIN horarios h2 ON p.hora_final = h2.id_hora 
WHERE p.estado = 'programado'
AND p.fecha = CURDATE()";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

// Verificar y procesar los resultados
$matches = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $matches[] = $row; // Almacena cada partida en un array
    }
} 

echo json_encode($matches); // Devuelve el array como JSON

$conn->close();
?>
