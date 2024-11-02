<?php
include ('db.php')
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Tienda - Bakovia</title>
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

    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container-sm">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">TIENDA</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="../admin/admin-products.php"><i class="lni lni-home"></i> ADMIN</a></li>
                        <li>TIENDA</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Product Grids -->
    <section class="product-grids section">
        <div class="container-sm">
            <div class="row">
                 <div class="col-lg-3 col-12">
                    <!-- Start Product Sidebar -->
                    <div class="product-sidebar">
                        <!-- Start Single Widget -->
                        <div class="single-widget search">
                            <h3>Buscar Producto</h3>
                            <form action="#">
                                <input type="text" placeholder="Buscar">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                        </div>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                         
<?php
// Obtener los tipos únicos (tags) de la tabla productos
$query = "SELECT DISTINCT tipo FROM productos";
$result = $conn->query($query);
if ($result === false) {
    die("Error en la consulta: " . $conn->error);
}

$tags = [];
while ($row = $result->fetch_assoc()) {
    $tags[] = $row['tipo'];
}
?>

<!-- Start Single Widget -->
<div class="single-widget">
    <h3>Todas las Categorías</h3>
    <ul class="list">
        <li>
            <a href="product-grids.php">Todos</a>
        </li>
        <?php foreach ($tags as $tag): ?>
            <li>
                <a href="product-grids.php?filtro=<?= urlencode($tag) ?>">
                    <?= htmlspecialchars($tag) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<!-- End Product Sidebar -->
                    </div>
                    <!-- End Product Sidebar -->
                 </div>
                <div class="col-lg-9 col-12">
                    <div class="product-grids-head">
<?php
// Número de productos por página
$productosPorPagina = 12;

// Capturar el filtro de la URL
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : null;
$whereClause = "";
if ($filtro) {
    $whereClause = " WHERE tipo = '" . $conn->real_escape_string($filtro) . "'";
}

// Obtener el número total de productos
$totalProductosQuery = "SELECT COUNT(*) AS total FROM productos" . $whereClause;

$totalProductos = $conn->query($totalProductosQuery)->fetch_assoc()['total'];

// Calcular el número total de páginas
$totalPaginas = ceil($totalProductos / $productosPorPagina);

// Obtener el número de la página actual
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

// Calcular el límite para la consulta
$limite = ($paginaActual - 1) * $productosPorPagina;

// Función para obtener productos limitados
function getLimitedProducts($conn, $limite, $productosPorPagina, $whereClause) {
    $sql = "SELECT p.id_producto, p.nombre_producto, p.descripcion, p.precio, p.imagen_producto, p.imagen_producto2, p.tipo
            FROM productos p" . $whereClause . "
            LIMIT $limite, $productosPorPagina";
    return $conn->query($sql);
}

$productos = getLimitedProducts($conn, $limite, $productosPorPagina, $whereClause);
?>

<!-- Inicia la sección de productos -->
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-grid" role="tabpanel" aria-labelledby="nav-grid-tab">
        <div class="row">
            <?php while ($producto = $productos->fetch_assoc()): ?>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-product">
                        <a href="product-details.php?id=<?= $producto['id_producto'] ?>" style="text-decoration: none; color: inherit;">
                            <div class="product-image">
                                <img src="<?= htmlspecialchars($producto['imagen_producto']) ?>" 
                                     alt="<?= htmlspecialchars($producto['nombre_producto']) ?>" 
                                     class="first-image">
                                <img src="<?= htmlspecialchars($producto['imagen_producto2']) ?>" 
                                     alt="<?= htmlspecialchars($producto['nombre_producto']) ?>" 
                                     class="second-image">
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
        </div>
    </div>
</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Product Grids -->

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