<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'bakoviadb');

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el término de búsqueda
$query = isset($_GET['query']) ? $conexion->real_escape_string($_GET['query']) : '';

// Consultar productos
$sqlProductos = "SELECT id_producto, nombre_producto, descripcion, precio, imagen_producto, imagen_producto2, tipo 
                 FROM productos 
                 WHERE nombre_producto LIKE '%$query%' OR descripcion LIKE '%$query%'";

$resultProductos = $conexion->query($sqlProductos);

// Consultar publicaciones con los datos adicionales que necesitas
$sqlPublicaciones = "SELECT p.id_publicacion, p.titulo, p.imagen_publicacion, p.tag, u.nombre_usuario
                     FROM publicaciones p
                     JOIN usuarios u ON p.id_usuario = u.id_usuario
                     WHERE p.titulo LIKE '%$query%' OR p.contenido LIKE '%$query%'";

$resultPublicaciones = $conexion->query($sqlPublicaciones);

?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Publicaciones - Bakovia</title>
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

<!-- HEADER Y NAVBAR PRO -->
<header class="header navbar-area">
    <nav class="navbar navbar-expand-lg">
        <div class="container d-flex flex-column flex-lg-row align-items-start align-items-lg-center">

            <!-- LOGO CENTRADO EN MÓVILES -->
            <a class="navbar-brand mx-auto mx-lg-0" href="index.php">
                <img src="assets/images/logo/mini.png" alt="Logo" width="5">
            </a>

            <!-- ÍCONO DE PERFIL VISIBLE EN TODAS LAS PANTALLAS -->
            
            <div class="navbar-cart d-lg-none w-100">   
                <div class="d-flex justify-content-between">
                    <!-- BOTÓN DE MENÚ MÓVIL -->
                    <div class="icon">
                        <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="margin-top: 5px;">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                    </div>
                    <!-- ÍCONO DE PERFIL -->
                    <div class="cart-items">
                    <?php
                    // Comprobar si existe la sesión de la foto de perfil
                    if (isset($_SESSION['foto_perfil']) && !empty($_SESSION['foto_perfil'])) {
                        // Mostrar la foto de perfil
                        $fotoPerfil = $_SESSION['foto_perfil'];
                        echo '<a href="profile.php" ">
                                <img src="' . htmlspecialchars($fotoPerfil) . '" alt="Foto de perfil" style="width: 40px; height: 40px; object-fit: cover; border-radius: 5px; border: solid 2px #ECBE00;">
                            </a>';
                    } else {
                        // Mostrar el ícono predeterminado
                        echo '<a href="profile.php" class="main-btn" ">
                                <i class="lni lni-user"></i>
                            </a>';
                    }
                    ?>
                </div>
                </div>
            </div>

            <!-- MENÚ DE NAVEGACIÓN -->
            <div class="collapse navbar-collapse mt-lg-0" id="navbarSupportedContent" style="margin-top: 100px;">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">PRINCIPAL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="product-grids.php">CATÁLOGO</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-1-3" aria-expanded="false">OTROS</a>
                        <ul class="sub-menu collapse" id="submenu-1-3">
                            <li class="nav-item"><a class="dropdown-item" href="matches.php">Partidas</a></li>
                            <li class="nav-item"><a class="dropdown-item" href="blog-grid-sidebar.php">Publicaciones</a></li>
                            <li class="nav-item"><a class="dropdown-item" href="about-us.php">¿Quiénes Somos?</a></li>
                            <li class="nav-item"><a class="dropdown-item" href="faq.php">Preguntas Frecuentes</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- BARRA DE BÚSQUEDA -->
                <form class="d-flex" action="search-results.php" method="GET">
                    <div class="navbar-search search-style-5">
                        <div class="search-input">
                            <input id="search-input" name="query" class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                        </div>
                        <div class="search-btn">
                            <button type="submit"><i class="lni lni-search-alt"></i></button>
                        </div>
                        <!-- Dropdown de búsqueda -->
                        <div id="search-dropdown" class="search-dropdown" style="display: none;"></div>
                    </div>
                </form>
            </div>

            <!-- ÍCONO DE PERFIL EN PANTALLAS GRANDES -->
            <div class="navbar-cart ms-auto d-none d-lg-block">
                <div class="cart-items">
                    <?php
                    // Comprobar si existe la sesión de la foto de perfil
                    if (isset($_SESSION['foto_perfil']) && !empty($_SESSION['foto_perfil'])) {
                        // Mostrar la foto de perfil
                        $fotoPerfil = $_SESSION['foto_perfil'];
                        echo '<a href="profile.php" style="margin-right: 30px;">
                                <img src="' . htmlspecialchars($fotoPerfil) . '" alt="Foto de perfil" style="width: 40px; height: 40px; object-fit: cover; border-radius: 5px; border: solid 2px #ECBE00;">
                            </a>';
                    } else {
                        // Mostrar el ícono predeterminado
                        echo '<a href="profile.php" class="main-btn" style="margin-right: 30px;">
                                <i class="lni lni-user"></i>
                            </a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- TERMINA HEADER Y NAVBAR PRO -->

<div class="container-sm p-3">
    <h1>Resultados de búsqueda para "<?php echo htmlspecialchars($query); ?>"</h1>
    <br>
    <!-- Sección de productos -->
    <h2>Productos encontrados:</h2>
<div class="row">
    <?php if ($resultProductos->num_rows > 0): ?>
        <?php while ($producto = $resultProductos->fetch_assoc()): ?>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="single-product">
                    <a href="product-details.php?id=<?= $producto['id_producto'] ?>" style="text-decoration: none; color: inherit;">
                        <div class="product-image">
                            <img src="<?= htmlspecialchars($producto['imagen_producto']) ?>" 
                                 alt="<?= htmlspecialchars($producto['nombre_producto']) ?>" 
                                 class="first-image">
                            <?php if (!empty($producto['imagen_producto2'])): ?>
                                <img src="<?= htmlspecialchars($producto['imagen_producto2']) ?>" 
                                     alt="<?= htmlspecialchars($producto['nombre_producto']) ?>" 
                                     class="second-image">
                            <?php endif; ?>
                        </div>
                        <div class="product-info">
                            <span class="category"><?= htmlspecialchars($producto['tipo']) ?></span>
                            <span class="title"><?= htmlspecialchars($producto['nombre_producto']) ?></span>
                            <div class="price">
                                <span>Bs. <?= number_format($producto['precio'], 2) ?></span>
                            </div>
                            <div class="product-info">
                                <span class="category"><?= htmlspecialchars($producto['tipo']) ?></span>
                                <span class="title"><?= htmlspecialchars($producto['nombre_producto']) ?></span>
                                <div class="price">
                                    <span>Bs. <?= number_format($producto['precio'], 2) ?></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No se encontraron productos.</p>
        <?php endif; ?>
    </div>

    <!-- Sección de publicaciones -->
    <h2>Publicaciones encontradas:</h2>
    <section class="section blog-section blog-list">
                    <div class="row">
                        <?php if ($resultPublicaciones->num_rows > 0): ?>
                            <?php while ($publicacion = $resultPublicaciones->fetch_assoc()): ?>
                                <?php 
                                    $id_publicacion = htmlspecialchars($publicacion['id_publicacion']);
                                    $titulo = htmlspecialchars($publicacion['titulo']);
                                    $imagen = !empty($publicacion['imagen_publicacion']) ? htmlspecialchars($publicacion['imagen_publicacion']) : 'https://via.placeholder.com/370x215';
                                    $tag = htmlspecialchars($publicacion['tag']);
                                ?>
                                <div class="col-lg-4 col-md-6 col-12">
                                    <!-- Start Single Blog -->
                                    <div class="single-blog">
                                        <div class="blog-img">
                                            <a href="blog-single-sidebar.php?id=<?= $id_publicacion ?>">
                                                <img src="<?= $imagen ?>" alt="Imagen de la publicación" style="width: 370px; height: 215px; object-fit: cover;">
                                            </a>
                                        </div>
                                        <div class="blog-content">
                                            <h4>
                                                <a href="blog-single-sidebar.php?id=<?= $id_publicacion ?>"><?= (strlen($titulo) > 75 ? substr($titulo, 0, 75) . '...' : $titulo) ?></a>
                                            </h4>
                                            <br>
                                            <a class="category" href="blog-grid-sidebar.php?filtro=<?= urlencode($tag) ?>"><i class="lni lni-tag"></i><?= $tag ?></a>
                                        </div>
                                    </div>
                                    <!-- End Single Blog -->
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>No se encontraron publicaciones.</p>
                        <?php endif; ?>
                    </div>
    </section>
</div>


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