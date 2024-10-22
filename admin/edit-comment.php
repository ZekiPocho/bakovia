<?php
// Conexión a la base de datos
include("../public/db.php"); // Asegúrate de tener un archivo para conectarte a la base de datos

session_start();
if (!isset($_SESSION['id_usuario'])) {
    // Redirigir a la página de inicio de sesión si no está autenticado
    header("Location: ../public/login.php");
    exit();
}

// Verifica si el usuario tiene el rol de administrador
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    header('Location: ../public/index.php');
    exit();
}

// Obtener el comentario a editar
if (isset($_GET['id'])) {
    $id_comentario = intval($_GET['id']);
    $query = "SELECT * FROM comentarios WHERE id_comentario = $id_comentario";
    $result = mysqli_query($conn, $query);
    $comentario = mysqli_fetch_assoc($result);
}

// Actualizar el comentario
if (isset($_POST['update'])) {
    $nuevo_contenido = mysqli_real_escape_string($conn, $_POST['contenido_comentario']);

    $query = "UPDATE comentarios SET contenido_comentario = '$nuevo_contenido' WHERE id_comentario = $id_comentario";
    mysqli_query($conn, $query);

    header("Location: admin-post.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Comentario</title>
    <style>
        body {
            background-color: #1e1e1e;
            color: #ffffff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        h1 {
            color: #ff9800;
            text-align: center;
            margin-top: 20px;
        }
        form {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: #2c2c2c;
            border-radius: 10px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        textarea {
            width: 100%;
            padding: 10px;
            background-color: #3c3c3c;
            color: #fff;
            border: none;
            border-radius: 5px;
        }
        button {
            background-color: #ff9800;
            color: #000;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
            display: block;
            width: 100%;
        }
        button:hover {
            background-color: #e68900;
        }
        .back-button {
            display: block;
            width: 200px;
            margin: 20px auto;
            background-color: #3c3c3c;
            padding: 10px;
            text-align: center;
            color: #ff9800;
            border-radius: 5px;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #444;
        }
    </style>
</head>
<body>

<h1>Editar Comentario</h1>

<a href="admin-post.php" class="back-button">Volver a publicaciones</a>

<form action="edit-comment.php?id=<?php echo $comentario['id_comentario']; ?>" method="POST">
    <label for="contenido_comentario">Contenido del comentario:</label>
    <textarea name="contenido_comentario" id="contenido_comentario" rows="10"><?php echo $comentario['contenido_comentario']; ?></textarea>
    
    <button type="submit" name="update">Actualizar Comentario</button>
</form>

</body>
</html>