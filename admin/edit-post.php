<?php
// Conexión a la base de datos
include("../public/db.php"); // Asegúrate de tener un archivo para conectarte a la base de datos

session_start();
if (!isset($_SESSION['id_usuario'])) {
    // Redirigir a la página de inicio de sesión si no está autenticado
    header("Location: ../public/login.php");
    exit();
}

// Verificar si el usuario tiene el rol de administrador
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    header('Location: ../public/index.php');
    exit();
}

// Obtener la publicación a editar
if (isset($_GET['id'])) {
    $id_publicacion = intval($_GET['id']);
    $query = "SELECT * FROM publicaciones WHERE id_publicacion = $id_publicacion";
    $result = mysqli_query($conn, $query);
    $publicacion = mysqli_fetch_assoc($result);
}

// Actualizar la publicación
if (isset($_POST['editar'])) {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $imagen_publicacion = $_FILES['imagen_publicacion']['name'];
    $fecha_publicacion = $_POST['fecha_publicacion'];

    // Si se ha subido una nueva imagen
    if (!empty($imagen_publicacion)) {
        $ruta_imagen = "../uploads/" . basename($imagen_publicacion);
        move_uploaded_file($_FILES['imagen_publicacion']['tmp_name'], $ruta_imagen);
    } else {
        // Mantener la imagen anterior si no se ha subido una nueva
        $ruta_imagen = $publicacion['imagen_publicacion'];
    }

    $query = "UPDATE publicaciones SET titulo = '$titulo', contenido = '$contenido', imagen_publicacion = '$ruta_imagen', fecha_publicacion = '$fecha_publicacion' WHERE id_publicacion = $id_publicacion";
    mysqli_query($conn, $query);
    header("Location: admin-post.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Publicación</title>
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
        input[type="text"], input[type="date"], textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px;
            background-color: #3c3c3c;
            color: #fff;
            border: none;
            border-radius: 5px;
        }
        input[type="file"] {
            color: #fff;
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
    <script src="https://cdn.tiny.cloud/1/ygwkt7hwy11qzbk8uc4veikmopkjbvolxix57q02vpkn8sif/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: 'texto',  // change this value according to your HTML
        menubar: 'edit insert format tools table help'
        });
    </script>
</head>
<body>
    <h1>Editar Publicación</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" value="<?php echo $publicacion['titulo']; ?>" required>

        <label for="contenido">Contenido</label>
        <texto name="contenido" rows="10" required><?php echo $publicacion['contenido']; ?></texto>

        <label for="imagen_publicacion">Imagen Actual</label>
        <img src="<?php echo $publicacion['imagen_publicacion']; ?>" alt="Imagen Actual" style="max-width: 200px; display: block; margin-bottom: 10px;">

        <label for="imagen_publicacion">Cambiar Imagen</label>
        <input type="file" name="imagen_publicacion">

        <label for="fecha_publicacion">Fecha de Publicación</label>
        <input type="date" name="fecha_publicacion" value="<?php echo $publicacion['fecha_publicacion']; ?>" required>

        <div class="actions">
            <button type="submit" name="editar">Guardar Cambios</button>
        </div>
    </form>

    <a class="back-button" href="admin-post.php">Volver a Administrar Publicaciones</a>
</body>
</html>
