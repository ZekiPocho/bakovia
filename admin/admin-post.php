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

// Eliminar publicación
if (isset($_GET['delete'])) {
    $id_publicacion = intval($_GET['delete']);
    $query = "DELETE FROM publicaciones WHERE id_publicacion = $id_publicacion";
    mysqli_query($conn, $query);
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
    <h1>Administrar Publicaciones y Comentarios</h1>

    <a href="admin-dashboard.php" class="back-button">Volver al dashboard</a>
    <a href="../public/blog-grid-sidebar.php" class="back-button">Volver a publicaciones</a>

    <h2>Publicaciones</h2>
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
        <?php endwhile; ?>
    </table>

    <h2>Comentarios</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>ID Publicación</th>
            <th>Contenido del Comentario</th>
            <th>Acciones</th>
        </tr>
        <?php
        // Obtener todos los comentarios
        $query_comentarios = "SELECT * FROM comentarios";
        $result_comentarios = mysqli_query($conn, $query_comentarios);

        while ($comentario = mysqli_fetch_assoc($result_comentarios)): ?>
        <tr>
            <td><?php echo $comentario['id_comentario']; ?></td>
            <td><?php echo $comentario['id_publicacion']; ?></td>
            <td><?php echo substr($comentario['contenido_comentario'], 0, 100); ?>...</td>
            <td>
                <a href="edit-comment.php?id=<?php echo $comentario['id_comentario']; ?>">Editar</a> |
                <a href="admin-post.php?delete_comment=<?php echo $comentario['id_comentario']; ?>" onclick="return confirm('¿Estás seguro de eliminar este comentario?')">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>