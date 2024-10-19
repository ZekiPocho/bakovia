<?php

include ('validate_session.php');
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // Tu contraseña de la base de datos
$dbname = "bakoviadb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Publicación - Bakovia</title>
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
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->

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
      <a aria-label="Toggle navigation" href="index.php">PRINCIPAL</a>
    </li>
    <li class="nav-item">
        <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="collapse"
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
register.php<div class="col-sm-auto"></div>
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

    <!-- Start Blog Singel Area -->
    <section class="section blog-single">
        <div class="container-sm">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="single-inner">
                        <div class="post-details">
                        <?php
$sql = "SELECT p.titulo, p.contenido, p.imagen_publicacion, p.fecha_publicacion, p.tag, u.nombre_usuario 
        FROM publicaciones p
        JOIN usuarios u ON p.id_usuario = u.id_usuario
        ORDER BY p.fecha_publicacion DESC"; // Ordenar por fecha de publicación

$result = $conn->query($sql);


if (isset($_GET['id'])) {
    $id_publicacion = $_GET['id'];  // Capturar el ID de la publicación desde la URL

    // Consulta para obtener la publicación seleccionada
    $sql = "SELECT p.titulo, p.contenido, p.imagen_publicacion, p.fecha_publicacion, p.tag, u.nombre_usuario 
            FROM publicaciones p
            JOIN usuarios u ON p.id_usuario = u.id_usuario 
            WHERE p.id_publicacion = $id_publicacion";  // Filtrar por el ID

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $publicacion = $result->fetch_assoc();
        $titulo = $publicacion['titulo'];
        $contenido = $publicacion['contenido'];
        $imagen = !empty($publicacion['imagen_publicacion']) ? $publicacion['imagen_publicacion'] : 'https://via.placeholder.com/850x460';
        $usuario = $publicacion['nombre_usuario'];
        $fecha = date("d M, Y", strtotime($publicacion['fecha_publicacion']));
        $tag = $publicacion['tag'];

        // Mostrar la publicación
        echo '
        <div class="main-content-head">
            <div class="post-thumbnils">
                <img src="'.$imagen.'" alt="#">
            </div>
            <div class="meta-information">
                <h2 class="post-title">'.$titulo.'</h2>
                <ul class="meta-info">
                    <li>
                        <a href="javascript:void(0)"> <i class="lni lni-user"></i>'.$usuario.'</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><i class="lni lni-calendar"></i>'.$fecha.'</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><i class="lni lni-tag"></i>'.$tag.'</a>
                    </li>
                </ul>
            </div>
            <div class="detail-inner">
                <p>'.$contenido.'</p>
            </div>
        </div>';
    } else {
        echo "Publicación no encontrada.";
    }
} else {
    echo "No se ha proporcionado un ID de publicación.";
}
$conn->close();
?>






                            <!-- Comments -->
                            <?php
// Conexión a la base de datos
include 'db.php'; // Suponemos que ya tienes este archivo para la conexión

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comentar'])) {
    $id_publicacion = $_POST['id_publicacion'];
    $comentario = $conn->real_escape_string($_POST['comentario']);
    $nombre_usuario = $_SESSION['nombre_usuario'];  // Asumimos que el nombre del usuario está almacenado en la sesión
    $fecha_comentario = date('Y-m-d H:i:s'); // Fecha actual

    // Insertar comentario en la base de datos
    $sql = "INSERT INTO comentarios (id_publicacion, nombre_usuario, comentario, fecha_comentario)
            VALUES ('$id_publicacion', '$nombre_usuario', '$comentario', '$fecha_comentario')";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='alert-success'>Comentario agregado correctamente.</p>";
    } else {
        echo "Error al agregar el comentario: " . $conn->error;
    }
}
?>


<?php
// Consulta para obtener los comentarios de la publicación actual
$sql_comentarios = "SELECT * FROM comentarios WHERE id_publicacion = $id_publicacion ORDER BY fecha_comentario DESC";
$result_comentarios = $conn->query($sql_comentarios);

if ($result_comentarios->num_rows > 0) {
    echo '<div class="post-comments">';
    echo '<h3 class="comment-title"><span>Comentarios</span></h3>';
    echo '<ul class="comments-list">';

    while ($comentario = $result_comentarios->fetch_assoc()) {
        $nombre_usuario = $comentario['nombre_usuario'];
        $fecha_comentario = date("d M, Y", strtotime($comentario['fecha_comentario']));
        $texto_comentario = $comentario['comentario'];
        $foto_perfil = 'https://via.placeholder.com/150'; // Placeholder o foto real del usuario si la tienes

        echo '
        <li>
            <div class="comment-img">
                <img src="'.$foto_perfil.'" alt="img">
            </div>
            <div class="comment-desc">
                <div class="desc-top">
                    <h6>'.$nombre_usuario.'</h6>
                    <span class="date">'.$fecha_comentario.'</span>
                </div>
                <p>'.$texto_comentario.'</p>
            </div>
        </li>';
    }

    echo '</ul>';
    echo '</div>';
} else {
    echo '<p>No hay comentarios aún.</p>';
}
?>


<div class="comment-form">
    <h3 class="comment-reply-title">Deja un comentario</h3>
    <form action="" method="POST">
        <input type="hidden" name="id_publicacion" value="<?php echo $id_publicacion; ?>"> <!-- ID de la publicación -->
        <div class="row">
            <div class="col-12">
                <div class="form-box form-group">
                    <textarea name="comentario" class="form-control form-control-custom" placeholder="Tu comentario" required></textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="button">
                    <button type="submit" name="comentar" class="btn">Publicar comentario</button>
                </div>
            </div>
        </div>
    </form>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Blog Singel Area -->

    <!-- Start Footer Area -->
    <footer class="footer">
        <!-- Start Footer Middle -->
        <div class="footer-middle">
            <div class="container">
                <div class="bottom-inner">
                    <div class="row">
                        
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-contact">
                                <h3>¿QUIÉNES SOMOS?</h3>
                                <p class="phone">Phone: +1 (900) 33 169 7720</p>
                                <ul>
                                    <li><span>Monday-Friday: </span> 9.00 am - 8.00 pm</li>
                                    <li><span>Saturday: </span> 10.00 am - 6.00 pm</li>
                                </ul>
                                <p class="mail">
                                    <a href="mailto:support@shopgrids.com">support@shopgrids.com</a>
                                </p>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>CATEGORÍAS</h3>
                                <ul>
                                    <li><a href="javascript:void(0)">About Us</a></li>
                                    <li><a href="javascript:void(0)">Contact Us</a></li>
                                    <li><a href="javascript:void(0)">Downloads</a></li>
                                    <li><a href="javascript:void(0)">Sitemap</a></li>
                                    <li><a href="javascript:void(0)">FAQs Page</a></li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>INFORMACIÓN</h3>
                                <ul>
                                    <li><a href="javascript:void(0)">Computers & Accessories</a></li>
                                    <li><a href="javascript:void(0)">Smartphones & Tablets</a></li>
                                    <li><a href="javascript:void(0)">TV, Video & Audio</a></li>
                                    <li><a href="javascript:void(0)">Cameras, Photo & Video</a></li>
                                    <li><a href="javascript:void(0)">Headphones</a></li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                            
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!--Single Widget-->
                            <div class="footer-logo">
                                    <a href="index.php">
                                        <img src="assets/images/logo/mini.png" alt="#">
                                    </a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Middle -->
    </footer>
    <!--/ End Footer Area -->
    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/glightbox.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>