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

// Eliminar publicación
if (isset($_GET['delete'])) {
    $id_publicacion = intval($_GET['delete']);
    $query = "DELETE FROM publicaciones WHERE id_publicacion = $id_publicacion";
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
                <a href="admin-post.php?delete=<?php echo $row['id_publicacion']; ?>" onclick="return confirm('¿Estás seguro de eliminar esta publicación?')">Eliminar</a>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <h2>Comentarios</h2>
                <table style="width: 100%; margin-top: 10px;">
                    <tr>
                        <th>ID Comentario</th>
                        <th>Comentario</th>
                        <th>Fecha</th>
                    </tr>
                    <?php
                    // Obtener los comentarios para esta publicación
                    $id_publicacion = $row['id_publicacion'];
                    $comment_query = "SELECT * FROM comentarios WHERE id_publicacion = $id_publicacion";
                    $comment_result = mysqli_query($conn, $comment_query);

                    while ($comment = mysqli_fetch_assoc($comment_result)): ?>
                        <tr>
                            <td><?php echo $comment['id_comentario']; ?></td>
                            <td><?php echo $comment['comentario']; ?></td>
                            <td><?php echo $comment['fecha_comentario']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>