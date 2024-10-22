<?php
// Conexión a la base de datos
include("../public/db.php"); // Asegúrate de tener un archivo para conectarte a la base de datos

session_start();
if (!isset($_SESSION['id_usuario'])) {
    // Redirigir a la página de inicio de sesión si no está autenticado
    header("Location: ../public/login.php");
    exit();
}

// Verifica si el usuario ha iniciado sesión y si tiene el rol de administrador (id_rol = 1)
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    header('Location: ../public/index.php');
    exit;
}
// Eliminar publicación
if (isset($_GET['delete'])) {
    $id_publicacion = intval($_GET['delete']);
    $query = "DELETE FROM publicaciones WHERE id_publicacion = $id_publicacion";
    mysqli_query($conexion, $query);
    header("Location: admin-post.php");
}

// Obtener todas las publicaciones
$query = "SELECT * FROM publicaciones";
$result = mysqli_query($conexion, $query);
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
            color: #ff9800;
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
            color: #ff9800;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #333;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ff9800;
            color: #ff9800;
        }
        th {
            background-color: #444;
        }
        a {
            color: #ff9800;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        button, a {
            padding: 5px 10px;
            background-color: #ff9800;
            border: none;
            color: #1e1e1e;
            cursor: pointer;
            text-transform: uppercase;
        }
        button:hover, a:hover {
            background-color: #e68900;
        }
        img {
            max-width: 100px;
        }
    </style>
</head>
<body>
    <h1>Administrar Publicaciones</h1>

    <table border="1">
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
</body>
</html>
