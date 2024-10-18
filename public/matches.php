<?php
include("../src/validate_session.php");
include("../public/db.php");
$usuario_actual = $_SESSION['nombre_usuario']; // Esto depende de cómo guardes el nombre del usuario en la sesión
unset($_SESSION['juego']);
unset($_SESSION['puntos']);
unset($_SESSION['faccion']);
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Partidas - Bakovia</title>
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

<!-- Preloader-->
<div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
<!--/End Preloader -->

<!--HEADER Y NAVBAR PRO-->
<header class="header navbar-area">
    <nav class="navbar navbar-expand-lg">
<div class="container">
<a class="navbar-brand" href="index.html">
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
      <a aria-label="Toggle navigation" href="index.html">PRINCIPAL</a>
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
<div class="col-sm-auto"></div>
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

    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container-sm">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">PARTIDAS</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.html"><i class="lni lni-home"></i> INICIO</a></li>
                        <li>PARTIDAS</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
     <!---->
    <div class="container-sm mt-4">
        <div class="row">
            <!-- Columna de partidas en progreso -->
    <div class="col-xxl-6">
        <div class="matches-div text-center">
                            <h3 style="border-bottom: solid 1px #6E869D;">PARTIDAS EN PROGRESO</h3>
                            <br>
                            <?php
// Asegúrate de que la sesión esté iniciada

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta para obtener partidas en progreso
$sql = "SELECT p.id_partida, p.id_juego, p.puntos, p.nombre_usuario1, p.nombre_usuario2, 
        f1.nombre AS faccion1, f1.subfaccion AS subfaccion1, f1.icono AS icono1, 
        f2.nombre AS faccion2, f2.subfaccion AS subfaccion2, f2.icono AS icono2,
        p.hora_inicio, p.hora_final, p.id_mesa, p.puntaje_usuario1, 
        p.puntaje_usuario2
        FROM partida p
        JOIN faccion f1 ON p.id_faccion_usuario1 = f1.id_faccion
        JOIN faccion f2 ON p.id_faccion_usuario2 = f2.id_faccion
        WHERE p.estado = 'en progreso'";

$result = $conn->query($sql);

// Verificar y procesar los resultados
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
    <!-- Aquí empieza el HTML para mostrar las partidas en progreso -->
    <div class="match-entry mb-2 text-center">
        <div class="row align-items-center">
            <div class="col-2">
                <img src="https://via.placeholder.com/50x50" alt="Foto de perfil" class="img-fluid">
            </div>
            <div class="col-3">
                <span><?php echo $row['nombre_usuario1']; ?></span>
            </div>
            <div class="col-2">
                <?php
                // Mostrar el botón solo si el usuario actual es el usuario 1
                if ($usuario_actual === $row['nombre_usuario1']) {
                    echo '<a href="panel_control.php?id_partida=' . $row['id_partida'] . '" class="btn btn-primary">
                    ADMIN
                    </a>';
                } else {
                    echo '<img src="assets/images/matches/sword.png" alt="Icono de batalla" class="img-fluid" style="max-width: 25px;">';
                }
                ?>
            </div>
            <div class="col-3">
                <span><?php echo $row['nombre_usuario2']; ?></span>
            </div>
            <div class="col-2">
                <img src="https://via.placeholder.com/50x50" alt="Foto de perfil" class="img-fluid">
            </div>
        </div>
        <div class="scoreboard">
            <div class="team">
                <img src="<?php echo $row['icono1']; ?>" alt="Equipo 1">
                <div class="team-name"><?php echo $row['faccion1']; ?><br><?php echo $row['subfaccion1']; ?></div>
            </div>
            <div class="score"><?php echo $row['puntaje_usuario1']; ?></div>
            <div class="middle-section">
                <h1><?php echo $row['id_juego']; ?></h1>
                <h1><?php echo $row['puntos']; ?> Pts.</h1>
                <div class="timer"><i class="lni lni-hourglass"></i>00:00:00</div>
                <h1>Ronda Nº1</h1>
                <h1>MESA - <?php echo $row['id_mesa']; ?></h1>
            </div>
            <div class="score"><?php echo $row['puntaje_usuario2']; ?></div>
            <div class="team">
                <img src="<?php echo $row['icono2']; ?>" alt="Equipo 2">
                <div class="team-name"><?php echo $row['faccion2']; ?><br><?php echo $row['subfaccion2']; ?></div>
            </div>
        </div>
    </div>
<?php
    }
} else {
    echo "No hay partidas en progreso.";
}

$conn->close();
?>

            
        </div>
    </div>

    
            <!-- Columna de partidas abiertas para jugar -->
            <div class="col-xxl-6">
                <div class="matches-div text-center">
                    <h3 style="border-bottom: solid 1px #6E869D;">¡A JUGAR!</h3>
                    <br>
                                            <?php
                        include("../public/db.php");
                        // Verificar conexión
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Consulta para obtener partidas programadas
                        $sql = "SELECT p.id_partida, p.id_juego, p.puntos, p.nombre_usuario1, p.nombre_usuario2, 
                        f1.nombre AS faccion1, f1.subfaccion AS subfaccion1, f1.icono AS icono1, 
                        f2.nombre AS faccion2, f2.subfaccion AS subfaccion2, f2.icono AS icono2,
                        p.hora_inicio, p.hora_final, p.id_mesa, p.puntaje_usuario1, 
                        p.puntaje_usuario2
                        FROM partida p
                        JOIN faccion f1 ON p.id_faccion_usuario1 = f1.id_faccion
                        JOIN faccion f2 ON p.id_faccion_usuario2 = f2.id_faccion
                        WHERE p.estado = 'programado'";

                        $result = $conn->query($sql);

                        // Verificar y procesar los resultados
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <!-- Aquí empieza el HTML para mostrar las partidas programadas -->
                                <div class="match-entry mb-2 text-center">
                                    <div class="row align-items-center">
                                        <div class="col-2">
                                            <img src="https://via.placeholder.com/50x50" alt="Foto de perfil" class="img-fluid">
                                        </div>
                                        <div class="col-3">
                                            <span><?php echo $row['nombre_usuario1']; ?></span>
                                        </div>
                                        <div class="col-2">
                                            <h7>PARTIDA ABIERTA</h7>
                                        </div>
                                        <div class="col-5">
                                        <?php
                                        // Mostrar el botón solo si el usuario actual es el usuario 1
                                        if ($usuario_actual === $row['nombre_usuario1']) {
                                            echo 'ESPERANDO';
                                        } else {
                                            echo '<html> <div class="button">
                                                <button class="btn">UNIRSE</button>
                                            </div> </html>';
                                        }
                                        ?>
                                        </div>
                                    </div>
                                    <div class="scoreboard">
                                    <div class="team">
                                        <img src="<?php echo $row['icono1']; ?>" alt="Equipo 1">
                                        <div class="team-name"><?php echo $row['faccion1']; ?><br><?php echo $row['subfaccion1']; ?></div>
                                    </div>
                                    <div class="score"><?php echo $row['puntaje_usuario1']; ?></div>
                                    <div class="middle-section">
                                    <h1><?php echo $row['id_juego']; ?></h1>
                                    <h1><?php echo $row['puntos']; ?> Pts.</h1>
                                    <div class="timer"><?php echo $row['hora_inicio']; ?> - <?php echo $row['hora_final']; ?></div>
                                    <h1>MESA - <?php echo $row['id_mesa']; ?></h1>
                                    </div>
                                    <div class="score"><?php echo $row['puntaje_usuario2']; ?></div>
                                    <div class="team">
                                        <img src="<?php echo $row['icono2']; ?>" alt="Equipo 2" style="filter: opacity(25%);">
                                        <div class="team-name"><?php echo $row['faccion2']; ?><br><?php echo $row['subfaccion2']; ?></div>
                                    </div>
                                </div>
                                </div>
                                <!-- Aquí termina el HTML para mostrar las partidas programadas -->
                                <?php
                            }
                        } else {
                            echo "No hay partidas programadas.";
                        }

                        $conn->close();
                        ?>

                    <!-- Botón para iniciar una nueva partida -->
                    <br>
                    <p class="text-muted"><span style="font-size: 15px;">O sino, inicia tu propia partida</span></p>
                    <br>
                    <div class="button">
                        <a href="new-match.php"><button class="btn">Nueva Partida</button></a>
                    </div>
                </div>
            </div>
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
                                    <a href="index.html">
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
    <script type="text/javascript">

        //========= glightbox
        GLightbox({
            'href': 'https://www.youtube.com/watch?v=r44RKWyfcFw&fbclid=IwAR21beSJORalzmzokxDRcGfkZA1AtRTE__l5N4r09HcGS5Y6vOluyouM9EM',
            'type': 'video',
            'source': 'youtube', //vimeo, youtube or local
            'width': 900,
            'autoplayVideos': true,
        });
    </script>
</body>

</html>