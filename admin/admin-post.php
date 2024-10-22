<?php
include 'db.php'; 
include 'validate_session.php';

// Verificar si el usuario es superadministrador
if ($_SESSION['rol'] !== 'superadmin') {
    header("Location: index.php");
    exit();
}

// Obtener todas las publicaciones
$sql = "SELECT p.id_publicacion, p.titulo, p.contenido, p.fecha_publicacion, u.nombre_usuario 
        FROM publicaciones p 
        JOIN usuarios u ON p.id_usuario = u.id_usuario
        ORDER BY p.fecha_publicacion DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Superadministrador</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Publicaciones</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_publicacion']; ?></td>
                    <td><?php echo $row['titulo']; ?></td>
                    <td><?php echo $row['nombre_usuario']; ?></td>
                    <td><?php echo date('d M Y', strtotime($row['fecha_publicacion'])); ?></td>
                    <td>
                        <a href="editar_publicacion.php?id=<?php echo $row['id_publicacion']; ?>" class="btn btn-warning">Editar</a>
                        <form action="eliminar_publicacion.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id_publicacion" value="<?php echo $row['id_publicacion']; ?>">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta publicación?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>