<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    // Redirigir a la página de inicio de sesión si no está autenticado
    header("Location: ../public/login.php");
    exit();
}
include("../public/db.php");

// Verifica si el usuario ha iniciado sesión y si tiene el rol de administrador (id_rol = 1)
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    header('Location: ../public/index.php');
    exit;
}

// Funciones para gestionar productos y juegos
function getAllProducts($conn) {
    $sql = "SELECT p.id_producto, p.nombre_producto, p.descripcion, p.desc_mini, p.precio, p.imagen_producto, p.imagen_producto2, p.tipo, j.nombre AS nombre_juego, p.stock
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
    $desc_mini = trim($_POST['desc_mini']);
    $precio = trim($_POST['precio']);
    $id_juego = $_POST['id_juego'];
    $tipo = trim($_POST['tipo']);
    $stock = (int)$_POST['stock'];
    
    $imagen_producto = '';
    $imagen_producto2 = '';

    // Cargar la primera imagen
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

    // Cargar la segunda imagen
    if (isset($_FILES['imagen_producto2']) && $_FILES['imagen_producto2']['error'] === UPLOAD_ERR_OK) {
        $image2 = $_FILES['imagen_producto2'];
        $imageExtension2 = pathinfo($image2['name'], PATHINFO_EXTENSION);
        $newImageName2 = uniqid() . '_2.' . $imageExtension2;
        $targetFile2 = $targetDir . $newImageName2;

        if (move_uploaded_file($image2['tmp_name'], $targetFile2)) {
            $imagen_producto2 = $targetFile2;
        }
    }

    $sql = "INSERT INTO productos (nombre_producto, descripcion, desc_mini, precio, imagen_producto, imagen_producto2, id_juego, tipo, stock) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdssssi", $nombre_producto, $descripcion, $desc_mini, $precio, $imagen_producto, $imagen_producto2, $id_juego, $tipo, $stock);
    $stmt->execute();
    header('Location: admin-products.php');
    exit;
}

if (isset($_GET['delete'])) {
    $id_producto = $_GET['delete'];
    
    $query = "SELECT imagen_producto, imagen_producto2 FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $stmt->bind_result($productImage, $productImage2);
    $stmt->fetch();
    $stmt->close();

    if (file_exists($productImage)) {
        unlink($productImage);
    }
    if (file_exists($productImage2)) {
        unlink($productImage2);
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
    <script src="https://cdn.tiny.cloud/1/ygwkt7hwy11qzbk8uc4veikmopkjbvolxix57q02vpkn8sif/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: 'textarea',  // change this value according to your HTML
        menu: {
            file: { title: 'File', items: 'newdocument restoredraft | preview | importword exportpdf exportword | print | deleteallconversations' },
            edit: { title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall | searchreplace' },
            view: { title: 'View', items: 'code revisionhistory | visualaid visualchars visualblocks | spellchecker | preview fullscreen | showcomments' },
            insert: { title: 'Insert', items: 'image link media addcomment pageembed codesample inserttable | math | charmap emoticons hr | pagebreak nonbreaking anchor tableofcontents | insertdatetime' },
            format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | styles blocks fontfamily fontsize align lineheight | forecolor backcolor | language | removeformat' },
            tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | a11ycheck code wordcount' },
            table: { title: 'Table', items: 'inserttable | cell row column | advtablesort | tableprops deletetable' },
            help: { title: 'Help', items: 'help' }
        }
        });
    </script>
</head>
<body>
    <h1>Panel de Administración de Productos</h1>

    <a href="admin-dashboard.php" class="back-button">Volver al dashboard</a>
    <a href="../public/product-grids.php" class="back-button">Volver a la Tienda</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Imágenes</th>
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
                    <td><label maxlength="50"><?= $producto['descripcion'] ?></label> </td>
                    <td><?= $producto['precio'] ?></td>
                    <td><?= $producto['stock'] ?></td>
                    <td>
                        <img src="<?= $producto['imagen_producto'] ?>" alt="<?= $producto['nombre_producto'] ?>">
                        <?php if (!empty($producto['imagen_producto2'])): ?>
                            <img src="<?= $producto['imagen_producto2'] ?>" alt="<?= $producto['nombre_producto'] ?>">
                        <?php endif; ?>
                    </td>
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
        <textarea name="descripcion" id="default" rows="10" required></textarea>

        <label for="desc_mini">Descripción Corta:</label>
        <input type="text" name="desc_mini" id="desc_mini" rows="10" maxlength="300">
        <p id="charCount">300 caracteres restantes</p>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" step="0.01" required>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" required>

        <label for="imagen_producto">Imagen del Producto 1:</label>
        <input type="file" name="imagen_producto" required>

        <label for="imagen_producto2">Imagen del Producto 2 (Opcional):</label>
        <input type="file" name="imagen_producto2">

        <label for="id_juego">Juego:</label>
        <select name="id_juego" required>
            <?php while ($juego = $juegos->fetch_assoc()): ?>
                <option value="<?= $juego['id_juego'] ?>"><?= $juego['nombre'] ?></option>
            <?php endwhile; ?>
        </select>

        <label for="tipo">Tipo:</label>
        <select name="tipo" required>
            <option value="Miniaturas">Miniaturas</option>
            <option value="Pinturas">Pinturas</option>
            <option value="Suplementos">Suplementos</option>
            <option value="Servicio">Servicio</option>
            <option value="Otros">Otros</option>
        </select>

        <button type="submit" name="add_product">Añadir Producto</button>
    </form>
</body>
<script>
    const descMini = document.getElementById('desc_mini');
    const charCount = document.getElementById('charCount');

    descMini.addEventListener('input', function () {
        const remaining = 300 - descMini.value.length;
        charCount.textContent = `${remaining} caracteres restantes`;
    });
</script>
</html>

