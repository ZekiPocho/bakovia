<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'bakoviadb');

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el término de búsqueda
$query = isset($_GET['query']) ? $conexion->real_escape_string($_GET['query']) : '';

// Consultar productos
$sqlProductos = "SELECT id_producto, nombre_producto, descripcion, precio, imagen_producto, tipo 
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

<!-- HEADER Y NAVBAR PRO -->
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
                        <a class="active" aria-label="Toggle navigation" href="product-grids.php">TIENDA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="collapse"
                            data-bs-target="#submenu-1-3" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">CATEGORÍAS</a>
                        <ul class="sub-menu collapse" id="submenu-1-3">
                            <li class="nav-item"><a href="matches.php">Partidas</a></li>
                            <li class="nav-item"><a href="blog-grid-sidebar.php">Blogs</a></li>
                            <li class="nav-item"><a href="about-us.php">¿Quienes Somos?</a></li>
                            <li class="nav-item"><a href="faq.php">Preguntas Frecuentes</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
    <div class="navbar-search search-style-5">
        <div class="navbar-search search-input">
            <input id="search-input" class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
        </div>
        <div class="search-btn">
            <button type="button"><i class="lni lni-search-alt"></i></button>
                <!-- Aquí se muestra el dropdown de búsqueda -->
    <div id="search-dropdown" class="search-dropdown" style="display: none;"></div>
        </div>
    </div>
</form>
            </div>
            
                </div>
            </div>
            <!-- PERFIL -->
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
</div>
        </div>
    </nav>
</header>
<!-- TERMINA HEADER Y NAVBAR PRO --> 
<body>
<div class="container-sm">

    <h1>Resultados de búsqueda para "<?php echo htmlspecialchars($query); ?>"</h1>

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
                        </div>
                    </a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No se encontraron productos.</p>
    <?php endif; ?>
</div>

<h2>Publicaciones encontradas:</h2>
<div class="row">
    <?php if ($resultPublicaciones->num_rows > 0): ?>
        <?php while ($publicacion = $resultPublicaciones->fetch_assoc()): ?>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Blog -->
                <div style="backround-color:#6E869D">
                    <div class="blog-img">
                        <a href="blog-single-sidebar.php?id=<?= $publicacion['id_publicacion'] ?>"> <!-- Enlace con el ID de la publicación -->
                            <img src="<?= htmlspecialchars($publicacion['imagen_publicacion']) ?>" alt="#" style="width: 370px; height: 215px; object-fit: cover;">
                        </a>
                    </div>
                    <div class="blog-content">
                        <h4>
                            <a href="blog-single-sidebar.php?id=<?= $publicacion['id_publicacion'] ?>">
                                <?= (strlen($publicacion['titulo']) > 75 ? substr(htmlspecialchars($publicacion['titulo']), 0, 75) . '...' : htmlspecialchars($publicacion['titulo'])) ?>
                            </a>
                        </h4>
                        <br>
                        <a class="category" href="javascript:void(0)">
                            <i class="lni lni-tag"></i><?= htmlspecialchars($publicacion['tag']) ?>
                        </a>
                    </div>
                </div>
                <!-- End Single Blog -->
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No se encontraron publicaciones.</p>
    <?php endif; ?>
</div>
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
<script>
    document.querySelectorAll('.product-image').forEach(function(productImage) {
    const productImg = productImage.querySelector('.product-img');
    const hoverImgUrl = productImg.getAttribute('data-hover');
    
    productImage.addEventListener('mouseenter', function() {
        productImage.style.setProperty('--hover-image', `url(${hoverImgUrl})`);
    });

    productImage.addEventListener('mouseleave', function() {
        productImage.style.setProperty('--hover-image', '');
    });
});

</script>
</html>