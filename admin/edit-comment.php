<?php
// Conexión a la base de datos
include("../public/db.php");

session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../public/login.php");
    exit();
}

if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    header('Location: ../public/index.php');
    exit;
}

// Actualizar el comentario
if (isset($_POST['update'])) {
    $id_comentario = intval($_POST['id_comentario']);
    $comentario = mysqli_real_escape_string($conn, $_POST['comentario']);
    
    $query = "UPDATE comentarios SET comentario = '$comentario' WHERE id_comentario = $id_comentario";
    mysqli_query($conn, $query);
    
    header("Location: admin-post.php");
}

// Obtener el comentario para editar
if (isset($_GET['id'])) {
    $id_comentario = intval($_GET['id']);
    $query = "SELECT * FROM comentarios WHERE id_comentario = $id_comentario";
    $result = mysqli_query($conn, $query);
    $comment = mysqli_fetch_assoc($result);
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
        }
        h1 {
            color: #ff9800;
            text-align: center;
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
            padding: 8px;
            background-color: #3c3c3c;
            color: #fff;
            border: none;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        button {
            background-color: #ff9800;
            color: #000;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #e68900;
        }
    </style>
</head>
<body>
    <h1>Editar Comentario</h1>
    <form action="edit-comment.php" method="post">
        <input type="hidden" name="id_comentario" value="<?php echo $comment['id_comentario']; ?>">
        <label for="comentario">Comentario:</label>
        <textarea name="comentario" rows="5" required><?php echo $comment['comentario']; ?></textarea>
        <button type="submit" name="