<?php
require_once "../src/validate_session.php";

include '../public/db.php'; // Asegúrate de incluir tu archivo de conexión a la base de datos

$id_partida = isset($_GET['id_partida']) ? intval($_GET['id_partida']) : 0;

// Preparar la consulta
$query = "SELECT * FROM partida WHERE id_partida = ?";
if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $id_partida); // 'i' indica que el parámetro es un entero
    $stmt->execute();  
    // Obtener los resultados
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $partida = $result->fetch_assoc(); // Obtiene todos los datos de la partida
        
        // Guardar cada dato en una variable, con verificación de existencia
        $id_partida = $partida['id_partida'] ?? null; // Usar null si no existe
        $id_jugador1 = $partida['id_jugador1'] ?? null; // Usar null si no existe
        $id_jugador2 = $partida['id_jugador2'] ?? null; // Usar null si no existe
        $juego = $partida['id_juego'] ?? null;
        $puntos = $partida['puntos'] ?? null;
        $mesa = $partida['mesa'] ?? null;
        $estado = $partida['estado'] ?? null;
        $resultado_jugador1 = $partida['resultado_jugador1'] ?? null;
        $resultado_jugador2 = $partida['resultado_jugador2'] ?? null;
        $puntaje_jugador1 = $partida['puntaje_jugador1'] ?? null;
        $puntaje_jugador2 = $partida['puntaje_jugador2'] ?? null;
        $faccion_jugador1 = $partida['faccion_jugador1'] ?? null;
        $faccion_jugador2 = $partida['faccion_jugador2'] ?? null;
        
        // Ahora puedes usar las variables, verificando si no son null
    } else {
        echo "No se encontró la partida con el ID proporcionado.";
    }    
    $stmt->close();
} else {
    echo "Error en la preparación de la consulta.";
}

$conn->close();



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
                        <h1 class="page-title">PANEL DE CONTROL</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.html"><i class="lni lni-home"></i> INICIO</a></li>
                        <li><a href="matches.php">PARTIDAS</a></li>
                        <li>PANEL DE CONTROL</li>
                    </ul>
                </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    

<div class="container-sm mt-4">
    <div class="row justify-content-center">
        <div class="col-xxl-12">
            <div class="matches-div text-center">
                <h2 style="border-bottom: solid 1px #6E869D;">PANEL DE CONTROL</h2>
                <br>
                <div class="container mt-1">
                    <div class="row">
                        <!-- Columna izquierda: Selección -->
                        <div class="col-md-6">
                            <h3 class="text-center">placeholder</h3>
                            <br>
                            <?php
                            if ($id_partida > 0) {
                                // Obtener información de la partida
                                $sql = "SELECT * FROM partida WHERE id_partida = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("i", $id_partida);
                                $stmt->execute();
                                $result = $stmt->get_result();
                            
                                if ($result->num_rows > 0) {
                                    $partida = $result->fetch_assoc();
                                    // Mostrar información de la partida
                                    echo "<h1>Panel de Control - Partida ID: " . htmlspecialchars($partida['id_partida']) . "</h1>";
                                    echo "<p>Estado: " . htmlspecialchars($partida['estado']) . "</p>";
                                    echo "<p>Jugador 1: " . htmlspecialchars($partida['nombre_usuario1']) . "</p>";
                                    echo "<p>Jugador 2: " . htmlspecialchars($partida['nombre_usuario2']) . "</p>";
                                    // Agregar más detalles según sea necesario
                            
                                    // Acciones administrativas
                                    echo '<h2>Acciones Administrativas</h2>';
                                    echo '<form action="update-match.php" method="POST">';
                                    echo '<input type="hidden" name="id_partida" value="' . htmlspecialchars($partida['id_partida']) . '">';
                                    echo '<button type="submit" class="btn btn-warning">Actualizar Partida</button>';
                                    echo '</form>';
                                    
                                    echo '<form action="delete-match.php" method="POST">';
                                    echo '<input type="hidden" name="id_partida" value="' . htmlspecialchars($partida['id_partida']) . '">';
                                    echo '<button type="submit" class="btn btn-danger">Eliminar Partida</button>';
                                    echo '</form>';
                                } else {
                                    echo "<p>Partida no encontrada.</p>";
                                }
                            } else {
                                echo "<p>ID de partida inválido.</p>";
                            }
                            
                            $conn->close();
                            ?>
                        </div>

                        <!-- Columna derecha: Previsualización -->
                        <div class="col-md-6 text-center">
                            <h3>placeholder</h3>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    

    
    <!-- ========================= scroll-top ========================= 
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>-->

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

