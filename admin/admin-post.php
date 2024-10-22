<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    // Redirigir a la página de inicio de sesión si no está autenticado
    header("Location: ../public/login.php");
    exit();
}
include("../public/db.php");

// Verifica si el usuario ha iniciado sesión y si tiene el rol de administrador (id_rol = 1)
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    header('Location: ../public/index.php');
    exit;
}
}

// Inicializamos la variable para evitar errores
$publicacion = null;

// Verificar si se ha proporcionado un ID de publicación
if (isset($_GET['id'])) {
    $id_publicacion = $_GET['id'];
    
    // Obtener los datos de la publicación
    $sql = "SELECT * FROM publicaciones WHERE id_publicacion = $id_publicacion";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Si la publicación existe, la guardamos en la variable $publicacion
        $publicacion = $result->fetch_assoc();
    } else {
        echo "<p>La publicación no existe.</p>";
        exit(); // Detenemos la ejecución si no se encuentra la publicación
    }
} else {
    echo "<p>No se ha proporcionado un ID de publicación.</p>";
    exit(); // Detenemos la ejecución si no se ha proporcionado el ID
}

// Guardar cambios en la publicación
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

        <?php if ($publicacion): ?>
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
        <?php else: ?>
        <p>No se puede editar esta publicación.</p>
        <?php endif; ?>
    </div>
</body>
</html>