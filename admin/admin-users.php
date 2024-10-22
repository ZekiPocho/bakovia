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

// Eliminar usuario
if (isset($_GET['delete_user'])) {
    $id_usuario = intval($_GET['delete_user']);
    
    // Primero eliminar los comentarios asociados
    $delete_comments_query = "DELETE FROM comentarios WHERE id_usuario = $id_usuario";
    mysqli_query($conn, $delete_comments_query);
    
    // Luego eliminar las publicaciones
    $delete_posts_query = "DELETE FROM publicaciones WHERE id_usuario = $id_usuario";
    mysqli_query($conn, $delete_posts_query);
    
    // Finalmente eliminar el usuario
    $delete_user_query = "DELETE FROM usuarios WHERE id_usuario = $id_usuario";
    mysqli_query($conn, $delete_user_query);
    
    header("Location: admin-users.php");
}

// Eliminar publicación
if (isset($_GET['delete_post'])) {
    $id_publicacion = intval($_GET['delete_post']);
    
    // Primero eliminar los comentarios asociados
    $delete_comments_query = "DELETE FROM comentarios WHERE id_publicacion = $id_publicacion";
    mysqli_query($conn, $delete_comments_query);
    
    // Luego eliminar la publicación
    $delete_post_query = "DELETE FROM publicaciones WHERE id_publicacion = $id_publicacion";
    mysqli_query($conn, $delete_post_query);
    
    header("Location: admin-users.php");
}

// Eliminar comentario
if (isset($_GET['delete_comment'])) {
    $id_comentario = intval($_GET['delete_comment']);
    $query = "DELETE FROM comentarios WHERE id_comentario = $id_comentario";
    mysqli_query($conn, $query);
    header("Location: admin-users.php");
}

// Obtener todos los usuarios
$query = "SELECT * FROM usuarios";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios</title>
    <style>
        body {
            background-color: #1e1e1e;
            color: #ffffff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1, h2 {
            color: #ff9800;
            text-align: center;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #2c2c2c;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #444;
        }
        table th {
            background-color: #ff9800;
            color: #000;
        }
        a {
            color: #ff9800;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .actions {
            text-align: center;
        }
        .comment {
            background-color: #3c3c3c;
            padding: 5px;
            border-radius: 5px;
            margin-top: 5px;
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
        .actions {
            text-align: center;
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
    <h1>Administrar Usuarios</h1>

    <a href="admin-dashboard.php" class="back-button">Volver al dashboard</a>

    <table>
        <tr>
            <th>ID Usuario</th>
            <th>Nombre</th>
            <th>Correo Electrónico</th>
            <th>Fecha de Registro</th>
            <th>Publicaciones</th>
            <th>Comentarios</th>
            <th>Acciones</th>
            </tr>
        <?php while ($user = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $user['id_usuario']; ?></td>
            <td><?php echo $user['nombre_usuario']; ?></td>
            <td><?php echo $user['correo']; ?></td> <!-- Asegúrate de que la columna se llame 'correo' -->
            <td><?php echo $user['fecha_registro']; ?></td> <!-- Asegúrate de que la columna se llame 'fecha_registro' -->
            <td>
                <?php
                // Obtener las publicaciones del usuario
                $user_id = $user['id_usuario'];
                $post_query = "SELECT * FROM publicaciones WHERE id_usuario = $user_id";
                $post_result = mysqli_query($conn, $post_query);
                while ($post = mysqli_fetch_assoc($post_result)): ?>
                    <div>
                        <strong><?php echo $post['titulo']; ?></strong>
                        <a href="admin-users.php?delete_post=<?php echo $post['id_publicacion']; ?>" onclick="return confirm('¿Estás seguro de eliminar esta publicación?')">Eliminar</a>
                    </div>
                <?php endwhile; ?>
            </td>
            <td>
                <?php
                // Obtener los comentarios del usuario
                $comment_query = "SELECT * FROM comentarios WHERE id_usuario = $user_id";
                $comment_result = mysqli_query($conn, $comment_query);
                while ($comment = mysqli_fetch_assoc($comment_result)): ?>
                    <div class="comment">
                        <strong>Comentario:</strong> <?php echo $comment['comentario']; ?>
                        <a href="admin-users.php?delete_comment=<?php echo $comment['id_comentario']; ?>" onclick="return confirm('¿Estás seguro de eliminar este comentario?')">Eliminar</a>
                    </div>
                <?php endwhile; ?>
            </td>
            <td>
                <a href="admin-users.php?delete_user=<?php echo $user['id_usuario']; ?>" onclick="return confirm('¿Estás seguro de eliminar este usuario y sus publicaciones y comentarios?')">Eliminar Usuario</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>