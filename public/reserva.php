<?php
include "../public/db.php"
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
                        <h1 class="page-title">CREAR PARTIDA</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.html"><i class="lni lni-home"></i> INICIO</a></li>
                        <li><a href="matches.php">PARTIDAS</a></li>
                        <li>CREAR PARTIDA</li>
                    </ul>
                </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
     <!---->
     <div class="container-sm mt-4">
    <div class="row justify-content-center">
        <div class="col-xxl-10">
            <div class="matches-div text-center">
                <h2 style="border-bottom: solid 1px #6E869D;">RESERVA TU MESA</h2>
                <br>
                <div class="container mt-1">
                    <div class="row">
                        <!-- Columna izquierda: Selección -->
                        <div class="col-md-6">
                            <h3 class="text-center">HORARIOS PARA HOY</h3>
                            <br>
                            <table class="table table-bordered">
                                <thead>
                                    <tr style="background-color: #6E869D; border: solid 2px #171D25">
                                        <th>Hora</th>
                                        <th>Mesa 1</th>
                                        <th>Mesa 2</th>
                                        <th>Mesa 3</th>
                                    </tr>
                                </thead>
                                <tbody id="horariosMesas">
                                <?php
                                // Configurar el locale para el idioma español
                                mysqli_query($conn, "SET lc_time_names = 'es_ES'");

                                // Obtener la fecha actual
                                $fecha_actual = date('Y-m-d');

                                // Consulta para obtener los horarios del día
                                $query_horarios = "SELECT h.id_horario, h.hora_inicio 
                                                    FROM horarios h 
                                                    WHERE DAYNAME(CURDATE()) = h.dia_semana;";
                                $result_horarios = mysqli_query($conn, $query_horarios);

                                while ($horario = mysqli_fetch_assoc($result_horarios)) {
                                    echo "<tr style='background-color: white; border: solid 2px #171D25'>";
                                    echo "<td>" . $horario['hora_inicio'] . "</td>";

                                    // Verificar la disponibilidad de cada mesa
                                    for ($mesa = 1; $mesa <= 3; $mesa++) {
                                        // Consulta para verificar si hay una reserva en esa mesa y horario
                                        $query_reserva = "SELECT * FROM reserva_mesa 
                                                        WHERE id_mesa = $mesa 
                                                        AND id_hora_inicio <= " . $horario['id_horario'] . " 
                                                        AND id_hora_final >= " . $horario['id_horario'] . " 
                                                        AND fecha = '$fecha_actual'";
                                        $result_reserva = mysqli_query($conn, $query_reserva);

                                        if (mysqli_num_rows($result_reserva) > 0) {
                                            // Si hay una reserva, la mesa está ocupada
                                            echo "<td class='ocupado'>Ocupado</td>";
                                        } else {
                                            // Si no hay reservas, la mesa está disponible
                                            echo "<td class='disponible'>Disponible</td>";
                                        }
                                    }

                                    echo "</tr>";
                                }
                                ?>
                                </tbody>

                            </table>
                        </div>

                        <!-- Columna derecha: Previsualización -->
                        <div class="col-md-6 text-center">
                            <h3>SELECCIONA</h3>
                            <br>
                            <form action="procesar_reserva.php" method="POST">
                                <div class="form-group">
                                    <label for="mesa">Mesa:</label>
                                    <select name="id_mesa" id="mesa" class="form-control" required>
                                        <option value="1">Mesa 1</option>
                                        <option value="2">Mesa 2</option>
                                        <option value="3">Mesa 3</option>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="hora_inicio">Hora de inicio:</label>
                                    <select name="id_hora_inicio" id="hora_inicio" class="form-control" required>
                                        <?php
                                        $query_horas = "SELECT id_horario, hora_inicio FROM horarios WHERE dia_semana = DAYNAME(CURDATE())";
                                        $result_horas = mysqli_query($conn, $query_horas);
                                        while ($hora = mysqli_fetch_assoc($result_horas)) {
                                            echo "<option value='" . $hora['id_horario'] . "'>" . $hora['hora_inicio'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="hora_final">Hora de finalización:</label>
                                    <select name="id_hora_final" id="hora_final" class="form-control" required>
                                        <?php
                                        $query_horas_final = "SELECT id_horario, hora_inicio FROM horarios WHERE dia_semana = DAYNAME(CURDATE())";
                                        $result_horas_final = mysqli_query($conn, $query_horas_final);
                                        while ($hora = mysqli_fetch_assoc($result_horas_final)) {
                                            echo "<option value='" . $hora['id_horario'] . "'>" . $hora['hora_inicio'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Reservar</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function actualizarHorarios() {
    // Realizar la petición AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'actualizar_horarios.php', true);
    xhr.onload = function() {
        if (xhr.status == 200) {
            // Reemplazar el contenido del tbody con los nuevos datos
            document.getElementById('horariosMesas').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

setInterval(actualizarHorarios, 5000);
</script>


    

    
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