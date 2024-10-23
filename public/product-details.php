<?php
include("../public/db.php"); // Asegúrate de incluir el archivo de conexión a la base de datos

// Obtener el ID del producto de la URL
if (isset($_GET['id'])) {
    $producto_id = $_GET['id'];

    // Consulta SQL para obtener los detalles del producto
    $sql = "SELECT nombre_producto, id_juego, tipo, precio, stock, desc_mini, descripcion, imagen_producto, imagen_producto2 FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);

    // Verificar si prepare() falló
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $stmt->bind_result($nombre, $id_juego, $tipo, $precio, $stock, $desc_mini, $descripcion, $imagen1, $imagen2);
    
    // Verificar si se encontró el producto
    if ($stmt->fetch()) {
        // Producto encontrado, ahora se mostrará el nombre del juego
        // Inicializar variable para el nombre del juego
        $nombre_juego = "Juego no encontrado"; // Valor por defecto

        // Cerrar la primera declaración antes de preparar la siguiente
        $stmt->close();

        // Consulta para obtener el nombre del juego
        $sqlJuego = "SELECT nombre FROM juego WHERE id_juego = ?";
        $stmtJuego = $conn->prepare($sqlJuego);

        // Verificar si prepare() falló
        if (!$stmtJuego) {
            die("Error en la preparación de la consulta de juego: " . $conn->error);
        }

        $stmtJuego->bind_param("i", $id_juego);
        $stmtJuego->execute();
        $stmtJuego->bind_result($juego); // Usar esta variable para almacenar el nombre del juego
        
        // Verificar si se encontró el juego
        if (!$stmtJuego->fetch()) {
            $juego = "Juego no encontrado"; // Esto es redundante pero puede ser útil para el control de errores
        }

        $stmtJuego->close(); // Cerrar la declaración de juego
    } else {
        echo "Producto no encontrado.";
        exit;
    }
    
} else {
    echo "ID de producto no especificado.";
    exit;
}

$conn->close();
?>





<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Producto - Bakovia</title>
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
                        <h1 class="page-title">PRODUCTO</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.php"><i class="lni lni-home"></i> INICIO</a></li>
                        <li><a href="product-grids.php">TIENDA</a></li>
                        <li>PRODUCTO</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Item Details -->
    <section class="item-details section">
    <div class="container">
        <div class="top-area">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="product-images">
                        <main id="gallery">
                            <div class="main-img" style="width: 500px; height: 350px; overflow: hidden;">
                                <!-- Imagen principal del producto -->
                                <img src="<?php echo $imagen1; ?>" id="current" alt="<?php echo $nombre; ?>" style="width: 100%; height: 100%; object-fit: scale-down; background-color: white;" onclick="openFullscreen(this.src)">
                            </div>
                            <div class="images" style="display: flex; margin-top: 10px;">
                                <img src="<?php echo $imagen1; ?>" class="img" alt="<?php echo $nombre; ?>" style="width: 80px; height: 80px; margin-right: 10px; object-fit: cover;">
                                <img src="<?php echo $imagen2; ?>" class="img" alt="<?php echo $nombre; ?>" style="width: 80px; height: 80px; margin-right: 10px; object-fit: cover;">
                            </div>
                        </main>
                    </div>
                </div>
                <br>
                <div class="col-lg-6 col-md-12 col-12 pb-50">
                    <div class="product-info">
                        <!-- Nombre del producto -->
                        <span style="font-size: 40px; padding-bottom: 10px;"><?php echo $nombre; ?></span>
                        <br>
                        <p class="category">Juego: <a href="javascript:void(0)"><?php echo $juego; ?></a></p>
                        <p class="category">Tipo de Producto: <a href="javascript:void(0)"><?php echo $tipo; ?></a></p>
                        <!-- Precio -->
                        <h3 class="price">Bs. <?php echo $precio; ?></h3>
                        <!-- Disponibilidad -->
                        <p style="padding-bottom: 10px;">Disponibilidad: 
                            <?php if ($stock > 0): ?>
                                <span style="color: #5DD422;"><?php echo $stock; ?> en Stock</span>
                            <?php else: ?>
                                <span style="color: #FF0000;">No disponible</span>
                            <?php endif; ?>
                        </p>
                        <!-- Descripción corta -->
                        <p><?php echo $desc_mini; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Descripción larga del producto -->
     <br>
    <div class="container">
        <div class="top-area">
            <div class="row">
                <div class="col-12">
                    <div class="info-body custom-responsive-margin">
                        <h4>Detalles</h4>
                        <p><?php echo $descripcion; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<br><br>

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
    <script>
    function openFullscreen(imageSrc) {
        const fullscreenDiv = document.createElement('div');
        fullscreenDiv.style.position = 'fixed';
        fullscreenDiv.style.top = 0;
        fullscreenDiv.style.left = 0;
        fullscreenDiv.style.width = '100%';
        fullscreenDiv.style.height = '100%';
        fullscreenDiv.style.backgroundColor = 'rgba(0, 0, 0, 0.9)';
        fullscreenDiv.style.display = 'flex';
        fullscreenDiv.style.alignItems = 'center';
        fullscreenDiv.style.justifyContent = 'center';
        fullscreenDiv.style.zIndex = 9999;

        const img = document.createElement('img');
        img.src = imageSrc;
        img.style.maxWidth = '90%';
        img.style.maxHeight = '90%';
        img.style.objectFit = 'contain';

        // Cerrar pantalla completa al hacer clic en la imagen o fuera de ella
        fullscreenDiv.onclick = function() {
            document.body.removeChild(fullscreenDiv);
        };

        fullscreenDiv.appendChild(img);
        document.body.appendChild(fullscreenDiv);
    }
</script>
    <!-- ========================= JS here ========================= -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/glightbox.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script type="text/javascript">
        const current = document.getElementById("current");
        const opacity = 0.6;
        const imgs = document.querySelectorAll(".img");
        imgs.forEach(img => {
            img.addEventListener("click", (e) => {
                //reset opacity
                imgs.forEach(img => {
                    img.style.opacity = 1;
                });
                current.src = e.target.src;
                //adding class 
                //current.classList.add("fade-in");
                //opacity
                e.target.style.opacity = opacity;
            });
        });
    </script>
</body>

</html>