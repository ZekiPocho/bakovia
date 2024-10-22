<?php
include 'db.php'; 
include 'validate_session.php';

// Verificar si el usuario es superadministrador
if ($_SESSION['rol'] !== 'superadmin') {
    header("Location: index.php");
    exit();
}

// Obtener los datos de la publicación
if (isset($_GET['id'])) {
    $id_publicacion = $_GET['id'];
    $sql = "SELECT * FROM publicaciones WHERE id_publicacion = $id_publicacion";
    $result = $conn->query($sql);
    $publicacion = $result->fetch_assoc();
}

// Guardar cambios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];

    $sql = "UPDATE publicaciones SET titulo = '$titulo', contenido = '$contenido' WHERE id_publicacion = $id_publicacion";
    if ($conn->query($sql)) {
        header("Location: admin_dashboard.php?edit_success=1");
        exit();
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Publicación</title>
</head>
<body>
    <div class="container">
        <h1>Editar Publicación</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" name="titulo" value="<?php echo $publicacion['titulo']; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="contenido">Contenido</label>
                <textarea name="contenido" class="form-control"><?php echo $publicacion['contenido']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
