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

// Eliminar publicación y sus comentarios
if (isset($_GET['delete'])) {
    $id_publicacion = intval($_GET['delete']);
    
    // Primero eliminar los comentarios asociados
    $delete_comments_query = "DELETE FROM comentarios WHERE id_publicacion = $id_publicacion";
    mysqli_query($conn, $delete_comments_query);
    
    // Luego eliminar la publicación
    $delete_post_query = "DELETE FROM publicaciones WHERE id_publicacion = $id_publicacion";
    mysqli_query($conn, $delete_post_query);
    
    header("Location: admin-post.php");
}

// Eliminar comentario
if (isset($_GET['delete_comment'])) {
    $id_comentario = intval($_GET['delete_comment']);
    $query = "DELETE FROM comentarios WHERE id_comentario = $id_comentario";
    mysqli_query($conn, $query);
    header("Location: admin-post.php");
}

// Obtener todas las publicaciones
$query = "SELECT * FROM publicaciones";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Publicaciones</title>
    <style>
        body {
            background-color: #1e1e1e;
            color: #ffffff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        h1, h2 {
            color: #ff9800;
            text-align: center;
        }
        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #2c2c2c;
            overflow-x: auto; /* Permitir scroll horizontal */
            display: block; /* Para que el overflow funcione */
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
        table td img {
            max-width: 50px;
            height: auto;
            border-radius: 5px;
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
        .back-button {
            display: block;
            width: 80%;
            max-width: 200px;
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
        .comment {
            background-color: #3c3c3c;
            padding: 5px;
            border-radius: 5px;
            margin-top: 5px;
        }
        .comment a {
            margin-left: 10px;
        }
        
        @media (max-width: 600px) {
            table, 
            table th, 
            table td {
                display: block; /* Hace que cada celda sea un bloque */
                width: 100%; /* Ocupa el 100% del contenedor */
            }
            table th {
                display: none; /* Oculta los encabezados en vista móvil */
            }
            .back-button {
                width: 90%; /* Botón más ancho en móvil */
            }
        }
    </style>
</head>
<body>
    <h1>Administrar Publicaciones</h1>

    <a href="admin-dashboard.php" class="back-button">Volver al dashboard</a>
    <a href="../public/blog-grid-sidebar.php" class="back-button">Volver a publicaciones</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Contenido</th>
            <th>Imagen</th>
            <th>Fecha de Publicación</th>
            <th>Acciones</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['id_publicacion']; ?></td>
            <td><?php echo $row['titulo']; ?></td>
            <td><?php echo substr($row['contenido'], 0, 100); ?>...</td>
            <td><img src="<?php echo $row['imagen_publicacion']; ?>" alt="Imagen"></td>
            <td><?php echo $row['fecha_publicacion']; ?></td>
            <td>
                <a href="edit-post.php?id=<?php echo $row['id_publicacion']; ?>">Editar</a> |
                <a href="admin-post.php?delete=<?php echo $row['id_publicacion']; ?>" onclick="return confirm('¿Estás seguro de eliminar esta publicación y todos sus comentarios?')">Eliminar</a>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <h2>Comentarios</h2>
                <?php
                // Obtener los comentarios para esta publicación
                $id_publicacion = $row['id_publicacion'];
                $comment_query = "SELECT * FROM comentarios WHERE id_publicacion = $id_publicacion";
                $comment_result = mysqli_query($conn, $comment_query);

                while ($comment = mysqli_fetch_assoc($comment_result)): ?>
                    <div class="comment">
                        <strong>ID Comentario:</strong> <?php echo $comment['id_comentario']; ?><br>
                        <strong>Comentario:</strong> <?php echo $comment['comentario']; ?><br>
                        <strong>Fecha:</strong> <?php echo $comment['fecha_comentario']; ?>
                        <a href="edit-comment.php?id=<?php echo $comment['id_comentario']; ?>">Editar</a> |
                        <a href="admin-post.php?delete_comment=<?php echo $comment['id_comentario']; ?>" onclick="return confirm('¿Estás seguro de eliminar este comentario?')">Eliminar</a>
                    </div>
                <?php endwhile; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
