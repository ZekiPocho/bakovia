<?php
include("../src/validate_session.php");
include("../public/db.php");

// Verifica si el usuario ha iniciado sesión y si tiene el rol de administrador (id_rol = 1)
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    // Redirige a la página principal si no es administrador o no ha iniciado sesión
    header('Location: ../public/index.php');
    exit;
}


// Función para obtener la lista de productos
function getAllProducts($conn) {
    $sql = "SELECT p.id_producto, p.nombre_producto, p.descripcion, p.precio, p.imagen_producto, j.nombre AS nombre_juego, p.tipo
            FROM productos p
            JOIN juego j ON p.id_juego = j.id_juego";
    $result = $conn->query($sql);
    return $result;
}

// Función para obtener la lista de juegos
function getAllGames($conn) {
    $sql = "SELECT id_juego, nombre FROM juego";
    $result = $conn->query($sql);
    return $result;
}

// Función para agregar un nuevo producto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $nombre_producto = trim($_POST['nombre_producto']);
    $descripcion = trim($_POST['descripcion']);
    $precio = trim($_POST['precio']);
    $id_juego = $_POST['id_juego'];  // Usamos el id_juego ahora
    $tipo = trim($_POST['tipo']);
    
    // Procesar imagen
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

    // Insertar producto
    $sql = "INSERT INTO productos (nombre_producto, descripcion, precio, imagen_producto, id_juego, tipo) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsss", $nombre_producto, $descripcion, $precio, $imagen_producto, $id_juego, $tipo);
    $stmt->execute();
    header('Location: admin-products.php');
    exit;
}

// Función para eliminar un producto
if (isset($_GET['delete'])) {
    $id_producto = $_GET['delete'];
    
    // Obtener la ruta de la imagen del producto antes de borrarlo
    $query = "SELECT imagen_producto FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $stmt->bind_result($productImage);
    $stmt->fetch();
    $stmt->close();

    // Borrar imagen del servidor
    if (file_exists($productImage)) {
        unlink($productImage);
    }

    // Borrar producto de la base de datos
    $sql = "DELETE FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    header('Location: admin-products.php');
    exit;
}

// Obtener productos para mostrar
$productos = getAllProducts($conn);

// Obtener juegos para el formulario
$juegos = getAllGames($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Productos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Panel de Administración de Productos</h1>

    <!-- Mostrar lista de productos -->
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
                    <td><img src="<?= $producto['imagen_producto'] ?>" alt="<?= $producto['nombre_producto'] ?>" width="50"></td>
                    <td><?= $producto['nombre_juego'] ?></td>
                    <td><?= $producto['tipo'] ?></td>
                    <td>
                        <a href="edit-product.php?id=<?= $producto['id_producto'] ?>">Editar</a> | 
                        <a href="admin-products.php?delete=<?= $producto['id_producto'] ?>" onclick="return confirm('¿Seguro que quieres eliminar este producto?')">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Formulario para agregar un nuevo producto -->
    <h2>Añadir Nuevo Producto</h2>
    <form action="admin-products.php" method="POST" enctype="multipart/form-data">
        <label for="nombre_producto">Nombre del Producto:</label>
        <input type="text" name="nombre_producto" required><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" required></textarea><br>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" step="0.01" required><br>

        <label for="id_juego">Juego:</label>
        <select name="id_juego" required>
            <?php while ($juego = $juegos->fetch_assoc()): ?>
                <option value="<?= $juego['id_juego'] ?>"><?= $juego['nombre'] ?></option>
            <?php endwhile; ?>
        </select><br>

        <label for="tipo">Tipo:</label>
        <input type="text" name="tipo" required><br>

        <label for="imagen_producto">Imagen del Producto:</label>
        <input type="file" name="imagen_producto" required><br>

        <button type="submit" name="add_product">Añadir Producto</button>
    </form>

</body>
</html>
