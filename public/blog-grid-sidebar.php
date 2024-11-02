
<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "bakoviadb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Definir el número de publicaciones por página
$limite = 8; // Número de publicaciones por página

// Obtener el número de página actual
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limite; // Calcular el desplazamiento

// Consulta para obtener las publicaciones
$sql = "SELECT p.id_publicacion, p.titulo, p.contenido, p.imagen_publicacion, p.fecha_publicacion, p.tag, u.nombre_usuario 
        FROM publicaciones p
        JOIN usuarios u ON p.id_usuario = u.id_usuario
        ORDER BY p.fecha_publicacion DESC
        LIMIT $limite OFFSET $offset";

$result = $conn->query($sql);

// Consulta para contar el total de publicaciones
$sql_total = "SELECT COUNT(*) AS total FROM publicaciones";
$result_total = $conn->query($sql_total);
$total_publicaciones = $result_total->fetch_assoc()['total'];

// Calcular el número total de páginas
$total_paginas = ceil($total_publicaciones / $limite);
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
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">PUBLICACIONES</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.php"><i class="lni lni-home"></i> INICIO</a></li>
                        <li>PUBLICACIONES</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Blog Singel Area -->
    <section class="section blog-section blog-list">
        <div class="container-sm">
            <div class="container ">
                <div class="row">
                    <div class="col">
                        <h4><a aria-label="Toggle navigation" href="publicar-blog.php">Crear Blog <i class="lni lni-plus"></i></a></h4>
                    </div>
                    <div class="col">
                    
                    </div>
                    <div class="col">
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                <div class="row">
            <?php
            if ($result->num_rows > 0) {
                // Mostrar cada publicación
                while ($row = $result->fetch_assoc()) {
                    $id_publicacion = $row['id_publicacion'];
                    $titulo = $row['titulo'];
                    $usuario = $row['nombre_usuario'];
                    $imagen = !empty($row['imagen_publicacion']) ? $row['imagen_publicacion'] : 'https://via.placeholder.com/370x215'; 
                    $tag = $row['tag'];

                    echo '
                    <div class="col-lg-6 col-md-6 col-12">
                        <!-- Start Single Blog -->
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="blog-single-sidebar.php?id='.$id_publicacion.'">
                                    <img src="'.$imagen.'" alt="#" style="max-width: 555px; max-height: 300px; object-fit: contain;">
                                </a>
                            </div>
                            <div class="blog-content">
                                <a class="category" href="javascript:void(0)">'.$usuario.'</a>
                                <h4><a href="blog-single-sidebar.php?id='.$id_publicacion.'">'.(strlen($titulo) > 75 ? substr($titulo, 0, 75) . '...' : $titulo).'</a></h4>
                                <br>
                                <a class="category" href="javascript:void(0)"><i class="lni lni-tag"></i>'.$tag.'</a>
                            </div>
                        </div>
                        <!-- End Single Blog -->
                    </div>';
                }
            } else {
                echo "No se encontraron publicaciones.";
            }

            // Paginación
            echo '<div class="pagination left blog-grid-page">';
            echo '<ul class="pagination-list">';
            if ($page > 1) {
                echo '<li><a href="?page='.($page - 1).'">Prev</a></li>';
            }
            for ($i = 1; $i <= $total_paginas; $i++) {
                $active = $i == $page ? 'active' : '';
                echo '<li class="'.$active.'"><a href="?page='.$i.'">'.$i.'</a></li>';
            }
            if ($page < $total_paginas) {
                echo '<li><a href="?page='.($page + 1).'">Next</a></li>';
            }
            echo '</ul>';
            echo '</div>';
            ?>
        </div>
                    <!--/ End Pagination -->
                </div>
                <aside class="col-lg-4 col-md-12 col-12">
                    <div class="sidebar blog-grid-page">
                        <!-- Start Single Widget -->
                        <div class="widget search-widget">
                            <h5 class="widget-title">Busca en Publicaciones</h5>
                            <form action="#">
                                <input type="text" placeholder="Buscar">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                        </div>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <div class="widget popular-feeds">
                            <h5 class="widget-title">Te podría interesar</h5>
                            <div class="popular-feed-loop">
                                <div class="single-popular-feed">
                                    <div class="feed-desc">
                                        <a class="feed-img" href="blog-single-sidebar.html">
                                            <img src="https://via.placeholder.com/200x200" alt="#">
                                        </a>
                                        <h6 class="post-title"><a href="blog-single-sidebar.html">What information is
                                                needed for shipping?</a></h6>
                                        <span class="time"><i class="lni lni-calendar"></i> 05th Nov 2023</span>
                                    </div>
                                </div>
                                <div class="single-popular-feed">
                                    <div class="feed-desc">
                                        <a class="feed-img" href="blog-single-sidebar.html">
                                            <img src="https://via.placeholder.com/200x200" alt="#">
                                        </a>
                                        <h6 class="post-title"><a href="blog-single-sidebar.html">Interesting fact about
                                                gaming consoles</a></h6>
                                        <span class="time"><i class="lni lni-calendar"></i> 24th March 2023</span>
                                    </div>
                                </div>
                                <div class="single-popular-feed">
                                    <div class="feed-desc">
                                        <a class="feed-img" href="blog-single-sidebar.html">
                                            <img src="https://via.placeholder.com/200x200" alt="#">
                                        </a>
                                        <h6 class="post-title"><a href="blog-single-sidebar.html">Electronics,
                                                instrumentation & control engineering </a></h6>
                                        <span class="time"><i class="lni lni-calendar"></i> 30th Jan 2023</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <div class="widget categories-widget">
                            <h5 class="widget-title">Categorías</h5>
                            <ul class="custom">
                                <li>
                                    <a href="javascript:void(0)">Editor's Choice</a><span>(24)</span>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Electronics</a><span>(12)</span>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Industrial Design</a><span>(5)</span>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Secure Payments Online</a><span>(15)</span>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Online Shopping</a><span>(7)</span>
                                </li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <div class="widget popular-tag-widget">
                            <h5 class="widget-title">Etiquetas</h5>
                            <div class="tags">
                                <a href="javascript:void(0)">#electronics</a>
                                <a href="javascript:void(0)">#cpu</a>
                                <a href="javascript:void(0)">#gadgets</a>
                                <a href="javascript:void(0)">#wearables</a>
                                <a href="javascript:void(0)">#smartphones</a>
                            </div>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                </aside>
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