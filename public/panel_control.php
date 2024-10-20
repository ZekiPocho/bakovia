<?php
require_once "../src/validate_session.php";

include '../public/db.php'; // Asegúrate de incluir tu archivo de conexión a la base de datos


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
    
    <?php
        $id_partida = $_GET['id_partida']; // Asegúrate de que el ID sea pasado de manera segura

        // Nueva consulta adaptada
        $query = "SELECT 
                        j.nombre AS nombre_juego, 
                        p.puntos AS puntos, 
                        p.nombre_usuario1 AS nombre_jugador1, 
                        u1.made AS made_usuario1, 
                        p.nombre_usuario2 AS nombre_jugador2, 
                        u2.made AS made_usuario2, 
                        f1.nombre AS faccion1, 
                        f1.subfaccion AS subfaccion1, 
                        f1.icono AS icono1, 
                        f2.nombre AS faccion2, 
                        f2.subfaccion AS subfaccion2, 
                        f2.icono AS icono2,
                        h1.hora AS hora_inicio, 
                        h2.hora AS hora_final,
                        p.id_mesa AS id_mesa, 
                        p.puntaje_usuario1 AS puntaje_jugador1, 
                        p.puntaje_usuario2 AS puntaje_jugador2
                    FROM partida p
                    JOIN faccion f1 ON p.id_faccion_usuario1 = f1.id_faccion
                    JOIN faccion f2 ON p.id_faccion_usuario2 = f2.id_faccion
                    JOIN usuarios u1 ON p.nombre_usuario1 = u1.nombre_usuario
                    JOIN usuarios u2 ON p.nombre_usuario2 = u2.nombre_usuario
                    JOIN juego j ON p.id_juego = j.id_juego
                    JOIN horarios h1 ON p.hora_inicio = h1.id_hora
                    JOIN horarios h2 ON p.hora_final = h2.id_hora
                    WHERE p.id_partida = ?";
                  
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("i", $id_partida); // 'i' indica que el parámetro es un entero
            $stmt->execute();  
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Obtener los datos de la partida
                $partida = $result->fetch_assoc();

                // Asignar las variables
                $nombre_juego = $partida['nombre_juego'] ?? null; 
                $puntos = $partida['puntos'] ?? null;
                $nombre_jugador1 = $partida['nombre_jugador1'] ?? null;
                $made_usuario1 = $partida['made_usuario1'] ?? null;
                $nombre_jugador2 = $partida['nombre_jugador2'] ?? null;
                $made_usuario2 = $partida['made_usuario2'] ?? null;
                $faccion1 = $partida['faccion1'] ?? null;
                $subfaccion1 = $partida['subfaccion1'] ?? null;
                $icono1 = $partida['icono1'] ?? null;
                $faccion2 = $partida['faccion2'] ?? null;
                $subfaccion2 = $partida['subfaccion2'] ?? null;
                $icono2 = $partida['icono2'] ?? null;
                $hora_inicio = $partida['hora_inicio'] ?? null;
                $hora_final = $partida['hora_final'] ?? null;
                $id_mesa = $partida['id_mesa'] ?? null;
                $puntaje_jugador1 = $partida['puntaje_jugador1'] ?? null;
                $puntaje_jugador2 = $partida['puntaje_jugador2'] ?? null;

                // Ahora puedes usar las variables para mostrar los datos en tu HTML
            } else {
                echo "No se encontró la partida con el ID proporcionado.";
            }    
            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta.";
        }
    ?>

<div class="container-sm mt-4">
    <div class="row justify-content-center">
        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4"> <!-- Columna para el Jugador 1 -->
            <div class="team">
                <h4 class="text-center"><?php echo htmlspecialchars($nombre_jugador1); ?></h4>
                <br>
                <img src="<?php echo htmlspecialchars($icono1); ?>" alt="Facción Jugador 1" class="img-fluid" style="height: 200px;">
                <br>
                <br>
                <div class="team-name">
                    <p><?php echo htmlspecialchars($faccion1); ?></p>
                    <p><?php echo htmlspecialchars($subfaccion1); ?></p>
                </div>
                <form action="adjust_score.php" method="POST" id="scoreFormJugador1">
                    <input type="hidden" name="id_partida" value="<?php echo htmlspecialchars($id_partida); ?>">
                    <input type="hidden" name="jugador" value="1">
                    <div class="mb-3">
                        <label for="puntaje_jugador1" class="form-label">Puntaje Jugador 1:</label>
                        <input type="number" name="puntaje_jugador1" class="form-control" value="<?php echo htmlspecialchars($puntaje_jugador1); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Ajustar Puntaje</button>
                </form>
            </div>
        </div>

        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4"> <!-- Columna central -->
            <div class="matches-div text-center">
                        <div class="middle-section text-center">
                            <h3 style="font-size: 1.25rem;">Tiempo Transcurrido</h3> <!-- Reducido el tamaño de la fuente -->
                            <p id="tiempo-transcurrido" style="font-size: 1.2rem;">00:00:00</p> <!-- Reducido el tamaño de la fuente -->
                            <br>
                            <form action="adjust_rounds.php" method="POST" id="roundForm">
                                <input type="hidden" name="id_partida" value="<?php echo htmlspecialchars($id_partida); ?>">
                                <div class="mb-3">
                                    <label for="rondas" class="form-label">Rondas:</label>
                                    <input type="number" name="rondas" class="form-control" value="0"> <!-- Cambia este valor al número de rondas actual -->
                                </div>
                                <button type="submit" class="btn btn-primary">Ajustar Rondas</button>
                            </form>
                        </div>
            </div>
        </div>

        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4"> <!-- Columna para el Jugador 2 -->
            <div class="team">
                <h4 class="text-center"><?php echo htmlspecialchars($nombre_jugador2); ?></h4>
                <br>
                <img src="<?php echo htmlspecialchars($icono2); ?>" alt="Facción Jugador 2" class="img-fluid" style="height: 200px;">
                <br>
                <br>
                <div class="team-name">
                    <p><?php echo htmlspecialchars($faccion2); ?></p>
                    <p><?php echo htmlspecialchars($subfaccion2); ?></p>
                </div>
                <form action="adjust_score.php" method="POST" id="scoreFormJugador2">
                    <input type="hidden" name="id_partida" value="<?php echo htmlspecialchars($id_partida); ?>">
                    <input type="hidden" name="jugador" value="2">
                    <div class="mb-3">
                        <label for="puntaje_jugador2" class="form-label">Puntaje Jugador 2:</label>
                        <input type="number" name="puntaje_jugador2" class="form-control" value="<?php echo htmlspecialchars($puntaje_jugador2); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Ajustar Puntaje</button>
                </form>
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

