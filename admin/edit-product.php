<?php
include("../src/validate_session.php");
include("../public/db.php");

// Verifica si el usuario ha iniciado sesión y si tiene el rol de administrador (id_rol = 1)
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    header('Location: ../public/index.php');
    exit;
}

// Definición de la función (si no está en db.php)
function getAllGames($conn) {
    $sql = "SELECT id_juego, nombre FROM juego";
    $result = $conn->query($sql);
    return $result;
}

// Función para obtener un producto por su ID
function getProductById($conn, $id) {
    $sql = "SELECT p.id_producto, p.nombre_producto, p.descripcion, p.desc_mini, p.precio, p.imagen_producto, p.imagen_producto2, p.tipo, p.stock, p.id_juego 
            FROM productos p 
            WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Actualizar producto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_product'])) {
    $id_producto = $_POST['id_producto'];
    $nombre_producto = trim($_POST['nombre_producto']);
    $descripcion = trim($_POST['descripcion']);
    $desc_mini = trim($_POST['desc_mini']);
    $precio = trim($_POST['precio']);
    $id_juego = $_POST['id_juego'];
    $tipo = trim($_POST['tipo']);
    $stock = (int)$_POST['stock'];

    $imagen_producto = $_POST['current_image'];
    $imagen_producto2 = $_POST['current_image2'];

    // Cargar la primera imagen si se sube una nueva
    if (isset($_FILES['imagen_producto']) && $_FILES['imagen_producto']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['imagen_producto'];
        $targetDir = '../uploads/products/';
        $imageExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $newImageName = uniqid() . '.' . $imageExtension;
        $targetFile = $targetDir . $newImageName;

        if (move_uploaded_file($image['tmp_name'], $targetFile)) {
            // Elimina la imagen anterior si se ha cargado una nueva
            if (file_exists($imagen_producto)) {
                unlink($imagen_producto);
            }
            $imagen_producto = $targetFile;
        }
    }

    // Cargar la segunda imagen si se sube una nueva
    if (isset($_FILES['imagen_producto2']) && $_FILES['imagen_producto2']['error'] === UPLOAD_ERR_OK) {
        $image2 = $_FILES['imagen_producto2'];
        $imageExtension2 = pathinfo($image2['name'], PATHINFO_EXTENSION);
        $newImageName2 = uniqid() . '_2.' . $imageExtension2;
        $targetFile2 = $targetDir . $newImageName2;

        if (move_uploaded_file($image2['tmp_name'], $targetFile2)) {
            // Elimina la imagen anterior si se ha cargado una nueva
            if (file_exists($imagen_producto2)) {
                unlink($imagen_producto2);
            }
            $imagen_producto2 = $targetFile2;
        }
    }

    $sql = "UPDATE productos SET nombre_producto = ?, descripcion = ?, desc_mini = ?, precio = ?, imagen_producto = ?, imagen_producto2 = ?, id_juego = ?, tipo = ?, stock = ? 
            WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdsssiii", $nombre_producto, $descripcion, $desc_mini, $precio, $imagen_producto, $imagen_producto2, $id_juego, $tipo, $stock, $id_producto);
    $stmt->execute();
    header('Location: admin-products.php');
    exit;
}

// Obtener el producto a editar
if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];
    $producto = getProductById($conn, $id_producto);
    if (!$producto) {
        header('Location: admin-products.php');
        exit;
    }
} else {
    header('Location: admin-products.php');
    exit;
}

$juegos = getAllGames($conn);
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
    <h1>Editar Producto</h1>

    <a href="admin-products.php" class="back-button">Volver a Productos</a>
    <a href="../public/product-grids.php" class="back-button">Volver a la Tienda</a>

    <form action="edit-product.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">
        <input type="hidden" name="current_image" value="<?= $producto['imagen_producto'] ?>">
        <input type="hidden" name="current_image2" value="<?= $producto['imagen_producto2'] ?>">

        <label for="nombre_producto">Nombre del Producto:</label>
        <input type="text" name="nombre_producto" value="<?= $producto['nombre_producto'] ?>" required>

        <label for="descripcion">Descripción:</label>
        <texto id="default" type="text" name="descripcion" rows="10"><?= $producto['descripcion'] ?></texto>

        <label for="desc_mini">Descripción Corta:</label>
        <textarea type="text" name="desc_mini" id="desc_mini" rows="10" maxlength="300" value="<?= $producto['desc_mini'] ?>" required></textarea>
        <p id="charCount">300 caracteres restantes</p>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" step="0.01" value="<?= $producto['precio'] ?>" required>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" value="<?= $producto['stock'] ?>" required>

        <label for="imagen_producto">Imagen del Producto 1:</label>
        <input type="file" name="imagen_producto">

        <label for="imagen_producto2">Imagen del Producto 2 (Opcional):</label>
        <input type="file" name="imagen_producto2">

        <label for="id_juego">Juego:</label>
        <select name="id_juego" required>
            <?php while ($juego = $juegos->fetch_assoc()): ?>
                <option value="<?= $juego['id_juego'] ?>" <?= $producto['id_juego'] == $juego['id_juego'] ? 'selected' : '' ?>><?= $juego['nombre'] ?></option>
            <?php endwhile; ?>
        </select>

        <label for="tipo">Tipo:</label>
        <select name="tipo" required>
            <option value="Miniaturas" <?= $producto['tipo'] == 'Miniaturas' ? 'selected' : '' ?>>Miniaturas</option>
            <option value="Pinturas" <?= $producto['tipo'] == 'Pinturas' ? 'selected' : '' ?>>Pinturas</option>
            <option value="Suplementos" <?= $producto['tipo'] == 'Suplementos' ? 'selected' : '' ?>>Suplementos</option>
            <option value="Accesorios" <?= $producto['tipo'] == 'Accesorios' ? 'selected' : '' ?>>Accesorios</option>
        </select>

        <button type="submit" name="update_product">Actualizar Producto</button>
    </form>

    <script>
        // Contador de caracteres para la descripción corta
        const descMiniInput = document.getElementById('desc_mini');
        const charCount = document.getElementById('charCount');

        descMiniInput.addEventListener('input', () => {
            const remainingChars = 300 - descMiniInput.value.length;
            charCount.textContent = `${remainingChars} caracteres restantes`;
        });
    </script>
</body>
</html>
