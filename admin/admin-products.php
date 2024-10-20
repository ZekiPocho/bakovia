<?php
include("../src/validate_session.php");
include("../public/db.php");

// Verifica si el usuario ha iniciado sesión y si tiene el rol de administrador (id_rol = 1)
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    // Redirige a la página principal si no es administrador o no ha iniciado sesión
    header('Location: ../public/index.php');
    exit;
}

// Funciones para gestionar productos y juegos
function getAllProducts($conn) {
    $sql = "SELECT p.id_producto, p.nombre_producto, p.descripcion, p.precio, p.imagen_producto, j.nombre AS nombre_juego, p.tipo
            FROM productos p
            JOIN juego j ON p.id_juego = j.id_juego";
    return $conn->query($sql);
}

function getAllGames($conn) {
    $sql = "SELECT id_juego, nombre FROM juego";
    return $conn->query($sql);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $nombre_producto = trim($_POST['nombre_producto']);
    $descripcion = trim($_POST['descripcion']);
    $precio = trim($_POST['precio']);
    $id_juego = $_POST['id_juego'];
    $tipo = trim($_POST['tipo']);
    
    $imagen_producto = '';
    if (isset($_FILES['imagen_producto']) && $_FILES['imagen_producto']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['imagen_producto'];
        $targetDir = '../uploads/products/';
        $imageExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $newImageName = uniqid() . '.' . $imageExtension;
        $targetFile = $targetDir . $newImageName;
        
        if (move_uploaded_file($image['tmp_name'], $targetFile)) {
            $imagen_producto = $targetFile;
        }
    }

    $sql = "INSERT INTO productos (nombre_producto, descripcion, precio, imagen_producto, id_juego, tipo) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsss", $nombre_producto, $descripcion, $precio, $imagen_producto, $id_juego, $tipo);
    $stmt->execute();
    header('Location: admin-products.php');
    exit;
}

if (isset($_GET['delete'])) {
    $id_producto = $_GET['delete'];
    
    $query = "SELECT imagen_producto FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $stmt->bind_result($productImage);
    $stmt->fetch();
    $stmt->close();

    if (file_exists($productImage)) {
        unlink($productImage);
    }

    $sql = "DELETE FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    header('Location: admin-products.php');
    exit;
}

$productos = getAllProducts($conn);
$juegos = getAllGames($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Productos</title>
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
    <h1>Panel de Administración de Productos</h1>

    <a href="admin-dashboard.php" class="back-button">Volver a la Página Principal</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Juego</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($producto = $productos->fetch_assoc()): ?>
                <tr>
                    <td><?= $producto['id_producto'] ?></td>
                    <td><?= $producto['nombre_producto'] ?></td>
                    <td><?= $producto['descripcion'] ?></td>
                    <td><?= $producto['precio'] ?></td>
                    <td><img src="<?= $producto['imagen_producto'] ?>" alt="<?= $producto['nombre_producto'] ?>"></td>
                    <td><?= $producto['nombre_juego'] ?></td>
                    <td><?= $producto['tipo'] ?></td>
                    <td class="actions">
                        <a href="edit-product.php?id=<?= $producto['id_producto'] ?>">Editar</a> | 
                        <a href="admin-products.php?delete=<?= $producto['id_producto'] ?>" onclick="return confirm('¿Seguro que quieres eliminar este producto?')">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h2>Añadir Nuevo Producto</h2>
    <form action="admin-products.php" method="POST" enctype="multipart/form-data">
        <label for="nombre_producto">Nombre del Producto:</label>
        <input type="text" name="nombre_producto" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" required></textarea>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" step="0.01" required>

        <label for="id_juego">Juego:</label>
        <select name="id_juego" required>
            <?php while ($juego = $juegos->fetch_assoc()): ?>
                <option value="<?= $juego['id_juego'] ?>"><?= $juego['nombre'] ?></option>
            <?php endwhile; ?>
        </select>

        <label for="tipo">Tipo:</label>
        <input type="text" name="tipo" required>

        <label for="imagen_producto">Imagen del Producto:</label>
        <input type="file" name="imagen_producto" required>

        <button type="submit" name="add_product">Añadir Producto</button>
    </form>
</body>
</html>
