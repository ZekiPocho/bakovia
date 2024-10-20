<?php
include ('../src/validate_session.php'); // Asegúrate de que el usuario esté autenticado

$mensaje = "";
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // Tu contraseña de la base de datos
$dbname = "bakoviadb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $conn->real_escape_string($_POST['titulo']);
    $contenido = $conn->real_escape_string($_POST['contenido']);
    $tag = $conn->real_escape_string($_POST['tag']); // Capturamos el tag seleccionado
    $id_usuario = $_SESSION['id_usuario']; // Asumimos que tienes la sesión del usuario

    // Manejo de imagen subida
    $upload_dir = 'assets/images/blog';
    $imagen_publicacion = '';

    if (!empty($_FILES['imagenes']['name'][0])) {
        $image_name = basename($_FILES['imagenes']['name'][0]);
        $image_tmp_name = $_FILES['imagenes']['tmp_name'][0];
        $image_path = $upload_dir . $image_name;

        // Crear la carpeta si no existe
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        if (move_uploaded_file($image_tmp_name, $image_path)) {
            $imagen_publicacion = $image_path; // Guardamos la ruta de la imagen
        } else {
            echo "Error al subir la imagen.";
        }
    }

    // Insertar la publicación en la base de datos con la imagen
    $sql = "INSERT INTO publicaciones (id_usuario, titulo, contenido, fecha_publicacion, imagen_publicacion, tag) 
            VALUES ('$id_usuario', '$titulo', '$contenido', NOW(), '$imagen_publicacion', '$tag')";

    if ($conn->query($sql) === TRUE) {
        // Obtener el ID de la publicación recién creada
        $id_publicacion = $conn->insert_id;

        // Redirigir al detalle de la publicación recién creada
        header("Location: blog-single-sidebar.php?id=$id_publicacion");
        exit(); // Importante: salir después de la redirección
    } else {
        echo "Error al crear la publicación: " . $conn->error;
    }
}

// Si hay un parámetro de éxito, mostrar el mensaje
if (isset($_GET['success'])) {
    $mensaje = "<div class='alert-success'>La publicación se creó correctamente</div>";
}

$conn->close();
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Principal - Bakovia</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logito.png" />
    <!-- FUENTE -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/LineIcons.3.0.css" />
    <link rel="stylesheet" href="assets/css/tiny-slider.css" />
    <link rel="stylesheet" href="assets/css/glightbox.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />

</head>

<body>

<!--HEADER Y NAVBAR PRO-->
<header class="header navbar-area">
    <nav class="navbar navbar-expand-lg">
<div class="container">
<a class="navbar-brand" href="index.php">
    <img src="assets/images/logo/mini.png" alt="Logo" width="5">
</a>
<button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="toggler-icon"></span>
    <span class="toggler-icon"></span>
    <span class="toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">
      <a class="active" aria-label="Toggle navigation" href="index.php">PRINCIPAL</a>
    </li>
    <li class="nav-item">
        <a class="nav-link dropdown-toggle" href="product-grids.html"
            data-bs-target="#submenu-1-2" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">TIENDA</a>
        <ul class="sub-menu collapse" id="submenu-1-2">
            <li class="nav-item"><a href="about-us.html">About Us</a></li>
            <li class="nav-item"><a href="faq.html">Faq</a></li>
            <li class="nav-item"><a href="login.php">Login</a></li>
            <li class="nav-item"><a href="register.php">Register</a></li>
            <li class="nav-item"><a href="mail-success.html">Mail Success</a></li>
            <li class="nav-item"><a href="404.html">404 Error</a></li>
        </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="collapse"
        data-bs-target="#submenu-1-3" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">CATEGORÍAS</a>
        <ul class="sub-menu collapse" id="submenu-1-3">
          <li class="nav-item"><a href="#">Action</a></li>
          <li class="nav-item"><a href="#">Another action</a></li>
          <li class="nav-item"><a href="#">XD</a></li>
        </ul>
      </li>
  </ul>
  <form class="d-flex">
    <div class="navbar-search search-style-5">
            <div class="navbar-search search-input">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
            </div>
                <div class="search-btn">
                    <button><i class="lni lni-search-alt"></i></button>
                </div>
        </div>
    </form>
    
</div>
<!-- carrito -->
    <div class="navbar-cart">
        <div class="cart-items">
            <a href="javascript:void(0)" class="main-btn">
                <i class="lni lni-cart"></i>
                <span class="total-items">0</span>
            </a>
            <!-- Shopping Item -->
            <div class="shopping-item">
                <div class="dropdown-cart-header">
                    <span>2 Productos</span>
                    <a href="cart.html">Ver Carrito</a>
                </div>
                <ul class="shopping-list">
                    <li>
                        <a href="javascript:void(0)" class="remove" title="Remove this item"><i
                                class="lni lni-close"></i></a>
                        <div class="cart-img-head">
                            <a class="cart-img" href="product-details.html"><img
                                    src="assets/images/header/cart-items/item1.jpg" alt="#"></a>
                        </div>

                        <div class="content">
                            <h4><a href="product-details.html">
                                    Apple Watch Series 6</a></h4>
                            <p class="quantity">1x - <span class="amount">$99.00</span></p>
                        </div>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="remove" title="Remove this item"><i
                                class="lni lni-close"></i></a>
                        <div class="cart-img-head">
                            <a class="cart-img" href="product-details.html"><img
                                    src="assets/images/header/cart-items/item2.jpg" alt="#"></a>
                        </div>
                        <div class="content">
                            <h4><a href="product-details.html">Wi-Fi Smart Camera</a></h4>
                            <p class="quantity">1x - <span class="amount">$35.00</span></p>
                        </div>
                    </li>
                </ul>
                <div class="bottom">
                    <div class="total">
                        <span>Total</span>
                        <span class="total-amount">$134.00</span>
                    </div>
                    <div class="button">
                        <a href="checkout.html" class="btn animate">Checkout</a>
                    </div>
                </div>
            </div>
            <!--/ End Shopping Item -->
        </div>
    </div>
<!--PERFIL-->
<div class="col-sm-auto">
    <div class="navbar-cart">
        <div class="cart-items">
            <a href="profile.php" class="main-btn">
                <i class="lni lni-user"></i>
            </a>
        </div>
    </div>
</div>
</div>
</nav>
</header>
<!--TERMINA HEADER Y NAVBAR PRO-->


<section class="hero-area">
    <div class="container-sm">
        <h3>
            Crear Publicación
        </h3>
    <form action="" method="POST" enctype="multipart/form-data">
    <div>
    <label for="tags">Seleccionar Tag:</label>
    <select name="tag" id="tags">
        <option value="miniaturas">Miniaturas</option>
        <option value="otros">Otros</option>
        <option value="ejercito">Ejército</option>
        <option value="tienda">Tienda</option>
        <option value="juegos">Juegos</option>
        <option value="pintura">Pintura/Hobby</option>
        <option value="lore">Lore</option>
        <option value="noticias">Noticias</option>
    </select>
        <div>
            <label for="imagenes">Subir imágenes:</label><br>
            <input class="btn" type="file" id="imagenes" name="imagenes[]" accept="image/*" multiple onchange="previewImages()"><br><br>
        </div>
    </div>
    <div id="vista-previa"></div>
        <div>
            <textarea class="form-control" name="titulo" placeholder="título*" required></textarea>
        </div>
        <div>
            <textarea class="form-control" name="contenido" placeholder="cuerpo*"></textarea>
        </div >
        <div class="row">
            <div class="col">
            </div>
            <div class="col">
            </div>
            <div class="col">
            </div>
            <div class="col-auto">
            <input class="btn" type="submit" value="Publicar">
            </div>
        </div>
        
    </form>
    </div>
    
</section> 

<script>
function previewImages() {
    var preview = document.getElementById('vista-previa');
    var files = document.getElementById('imagenes').files;
    preview.innerHTML = '';  // Limpiar las imágenes previas

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        if (file.type.startsWith('image/')) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '300px';
                img.style.marginTop = '10px';
                preview.appendChild(img);
            }
            reader.readAsDataURL(file);
        } else {
            alert('El archivo seleccionado no es una imagen');
        }
    }
}
</script>
<center>
<?php
echo $mensaje;
?>
</center>

</body>

</html>
