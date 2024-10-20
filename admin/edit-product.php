<?php
include("../src/validate_session.php");
include("../public/db.php");

// Verifica si el usuario ha iniciado sesión y si tiene el rol de administrador (id_rol = 1)
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    // Redirige a la página principal si no es administrador o no ha iniciado sesión
    header('Location: ../public/index.php');
    exit;
}

// Función para obtener el producto por su ID
function getProductById($conn, $id) {
    $sql = "SELECT p.id_producto, p.nombre_producto, p.descripcion, p.precio, p.imagen_producto, p.id_juego, p.tipo
            FROM productos p
            WHERE p.id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function getAllGames($conn) {
    $sql = "SELECT id_juego, nombre FROM juego";
    return $conn->query($sql);
}

if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];
    $producto = getProductById($conn, $id_producto);
    $juegos = getAllGames($conn);
} else {
    header('Location: admin-products.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_product'])) {
    $nombre_producto = trim($_POST['nombre_producto']);
    $descripcion = trim($_POST['descripcion']);
    $precio = trim($_POST['precio']);
    $id_juego = $_POST['id_juego'];
    $tipo = trim($_POST['tipo']);
    
    // Verifica si se subió una nueva imagen
    $imagen_producto = $producto['imagen_producto'];
    if (isset($_FILES['imagen_producto']) && $_FILES['imagen_producto']['error'] === UPLOAD_ERR_OK) {
        // Elimina la imagen anterior si se subió una nueva
        if (file_exists($imagen_producto)) {
            unlink($imagen_producto);
        }

        $image = $_FILES['imagen_producto'];
        $targetDir = '../uploads/products/';
        $imageExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $newImageName = uniqid() . '.' . $imageExtension;
        $targetFile = $targetDir . $newImageName;

        if (move_uploaded_file($image['tmp_name'], $targetFile)) {
            $imagen_producto = $targetFile;
        }
    }

    $sql = "UPDATE productos SET nombre_producto = ?, descripcion = ?, precio = ?, imagen_producto = ?, id_juego = ?, tipo = ? 
            WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsssi", $nombre_producto, $descripcion, $precio, $imagen_producto, $id_juego, $tipo, $id_producto);
    $stmt->execute();
    header('Location: admin-products.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
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
        input[type="text"], input[type="number"], select, textarea {
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
        .back-button {
            display: block;
            text-align: center;
            margin: 20px auto;
            background-color: #3c3c3c;
            padding: 10px 20px;
            border: none;
            color: #ff9800;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #444;
        }
    </style>
</head>
<body>
    <h1>Editar Producto</h1>

    <form action="edit-product.php?id=<?= $producto['id_producto'] ?>" method="POST" enctype="multipart/form-data">
        <label for="nombre_producto">Nombre del Producto:</label>
        <input type="text" name="nombre_producto" value="<?= htmlspecialchars($producto['nombre_producto']) ?>" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" required><?= htmlspecialchars($producto['descripcion']) ?></textarea>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" step="0.01" value="<?= htmlspecialchars($producto['precio']) ?>" required>

        <label for="id_juego">Juego:</label>
        <select name="id_juego" required>
            <?php while ($juego = $juegos->fetch_assoc()): ?>
                <option value="<?= $juego['id_juego'] ?>" <?= $juego['id_juego'] == $producto['id_juego'] ? 'selected' : '' ?>>
                    <?= $juego['nombre'] ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="tipo">Tipo:</label>
        <input type="text" name="tipo" value="<?= htmlspecialchars($producto['tipo']) ?>" required>

        <label for="imagen_producto">Imagen del Producto:</label>
        <input type="file" name="imagen_producto">

        <button type="submit" name="update_product">Actualizar Producto</button>
    </form>

    <a href="admin-products.php" class="back-button">Volver a la Administración de Productos</a>
</body>
</html>
