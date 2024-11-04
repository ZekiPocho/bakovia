
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


// Capturar el filtro de la URL
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : null;
$whereClause = "";
if ($filtro) {
    $whereClause = " WHERE p.tag = '" . $conn->real_escape_string($filtro) . "'";
}

// Actualizar la consulta principal para incluir el filtro
$sql = "SELECT p.id_publicacion, p.titulo, p.contenido, p.imagen_publicacion, p.fecha_publicacion, p.tag, u.nombre_usuario 
        FROM publicaciones p
        JOIN usuarios u ON p.id_usuario = u.id_usuario
        $whereClause
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

    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container-sm">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
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
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12">
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
                                    <a href="blog-single-sidebar.php?id=' . $id_publicacion . '">
                                        <img src="' . htmlspecialchars($imagen) . '" alt="#" style="max-width: 555px; max-height: 300px; object-fit: contain;">
                                    </a>
                                </div>
                                <div class="blog-content">
                                    <a class="category" href="user_profile.php?usuario=' . urlencode($usuario) . '">' . htmlspecialchars($usuario) . '</a>
                                    <h4>
                                        <a href="blog-single-sidebar.php?id=' . $id_publicacion . '">' . 
                                        (strlen($titulo) > 75 ? htmlspecialchars(substr($titulo, 0, 75)) . '...' : htmlspecialchars($titulo)) . 
                                        '</a>
                                    </h4>
                                    <br>
                                    <a class="category" href="blog-grid-sidebar.php?filtro=' . urlencode($tag) . '">
                                        <i class="lni lni-tag"></i>' . htmlspecialchars($tag) . '
                                    </a>
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
                        <div class="widget popular-tag-widget" style="text-align: center;">
                            <div class="button">
                                <a href="publicar-blog.php" class="btn">CREAR PUBLICACIÓN</a>
                            </div>
                        </div>
                        <div class="widget search-widget">
                            <h5 class="widget-title">Busca en Publicaciones</h5>
                            <form action="#">
                                <input type="text" placeholder="Buscar">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                        </div>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <?php
// Consulta para obtener un máximo de 3 publicaciones aleatorias
$queryAleatorio = "SELECT id_publicacion, titulo, fecha_publicacion, imagen_publicacion FROM publicaciones ORDER BY RAND() LIMIT 3";
$resultadoAleatorio = $conn->query($queryAleatorio);
?>
                        <div class="widget popular-feeds">
                            <h5 class="widget-title">Te podría interesar</h5>
                            <div class="popular-feed-loop">
                            <?php while ($publicacion = $resultadoAleatorio->fetch_assoc()): ?>
                                <div class="single-popular-feed">
                                
    <div class="feed-desc">
        <a class="feed-img" href="blog-single-sidebar.php?id=<?= $publicacion['id_publicacion'] ?>">
            <img src="<?= htmlspecialchars($publicacion['imagen_publicacion']) ?>" alt="Imagen del blog" width="200" height="200" style="object-fit: cover;">
        </a>
        <h6 class="post-title">
            <a href="blog-single-sidebar.php?id=<?= $publicacion['id_publicacion'] ?>">
                <?= htmlspecialchars($publicacion['titulo']) ?>
            </a>
        </h6>
    </div>

                                </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <!-- End Single Widget -->




                        <!-- Start Single Widget -->
<?php
// Consulta para obtener los tags únicos y contar las publicaciones de cada uno
$query = "SELECT tag, COUNT(*) as total FROM publicaciones GROUP BY tag";
$result = $conn->query($query);

$tags = [];
while ($row = $result->fetch_assoc()) {
    $tags[] = $row;
}
?>



<!--mostrar los tags en categorias-->
<div class="widget categories-widget">
    <h5 class="widget-title">Categorías</h5>
    <ul class="custom">
        <?php foreach ($tags as $tag): ?>
            <li>
            <a href="blog-grid-sidebar.php">Todos</a>
            </li>
            <li>
                <a href="blog-grid-sidebar.php?filtro=<?= urlencode($tag['tag']) ?>">
                    <i class="lni lni-tag"></i><?= htmlspecialchars($tag['tag']) ?>
                </a>
                <span>(<?= $tag['total'] ?>)</span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

                    </div>
                </aside>
            </div>
        </div>
    </section>
    <!-- End Blog Singel Area -->

    <!-- Start Footer Area -->
    <footer class="footer" style="border-top: solid 5px #6E869D;">
        <!-- Start Footer Middle -->
        <div class="footer-middle">
            <div class="container">
                <div class="bottom-inner">
                    <div class="row">
                        
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-contact">
                                <h3>¿QUIÉNES SOMOS?</h3>
                                Bakovia nace del cariño y las ganas de compartir el hobby que amamos: ¡Warhammer! 
                                Deja el mundo atrás, entra al Bunker y aléjate de la maldad del mundo.
                                
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>PÁGINAS</h3>
                                <ul>
                                    <li><a href="matches.php">Partidas</a></li>
                                    <li><a href="blog-grid-sidebar.php">Publicaciones</a></li>
                                    <li><a href="about-us.php">¿Quiénes Somos?</a></li>
                                    <li><a href="faq.php">Preguntas Frecuentes</a></li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>INFORMACIÓN</h3>
                                Nos encontramos en la avenida Arce, edificio Santa Isabel Nº 2529.
                                Atendemos de lunes a viernes, desde las 16:00 hasta las 21:00,
                                 y los sábados de 13:00 a 18:00.
                            </div>
                            <!-- End Single Widget -->
                            
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mt-5">
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