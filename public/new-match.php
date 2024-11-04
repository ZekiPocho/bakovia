<?php
require_once "../src/validate_session.php";
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
                        <h1 class="page-title">CREAR PARTIDA</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.php"><i class="lni lni-home"></i> INICIO</a></li>
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
                            <h2 style="border-bottom: solid 1px #6E869D;">NUEVA PARTIDA</h2>
                            <br>
                            <div class="container mt-1">
    <div class="row">
        <!-- Columna izquierda: Selección -->
        <div class="col-md-6">
            <h3 class="text-center">SELECCIONA</h3>
            <br>
    <form action="../public/reserva.php" method="POST">
                <!-- Selección de Juego -->
                <div class="mb-3">
                    <label for="juego" class="form-label">Juego</label>
                    <select id="juego" name="juego" class="form-select" onchange="actualizarFormulario()">
                        <option value="" selected disabled>Selecciona un juego</option>
                        <option value="1">Warhammer 40k</option>
                        <option value="2">Age of Sigmar</option>
                    </select>
                </div>

                <!-- Selección de Puntos -->
                <div class="mb-3">
                    <label for="puntos" class="form-label">Puntos</label>
                    <select id="puntos" name="puntos" class="form-select" disabled onchange="verificarFormulario()">
                        <option value="" selected disabled>Selecciona los puntos</option>
                        <option value="500">500</option>
                        <option value="1000">1000</option>
                        <option value="1500">1500</option>
                        <option value="2000">2000</option>
                    </select>
                </div>

                <!-- Selección de Facción -->
                <div class="mb-3">
                    <label for="faccion" class="form-label">Facción</label>
                    <select id="faccion40k" name="faccion" class="form-select" disabled style="display:block;" onchange="mostrarFaccion40k()">
                        <option value="" selected disabled>Selecciona una facción</option>
                        <!-- Facciones de Warhammer 40k -->
                        <option value="1" data-subfaccion="Adeptus Astartes" data-icon="../public/assets/images/icons/templarios.svg">Templarios Negros</option>
                        <option value="2" data-subfaccion="Adeptus Astartes" data-icon="../public/assets/images/icons/sangrientos.svg">Ángeles Sangrientos</option>
                        <option value="3" data-subfaccion="Adeptus Astartes" data-icon="../public/assets/images/icons/oscuros.svg">Ángeles Oscuros</option>
                        <option value="4" data-subfaccion="Adeptus Astartes" data-icon="../public/assets/images/icons/puños.svg">Puños Imperiales</option>
                        <option value="5" data-subfaccion="Adeptus Astartes" data-icon="../public/assets/images/icons/manos.svg">Manos de Hierro</option>
                        <option value="6" data-subfaccion="Adeptus Astartes" data-icon="../public/assets/images/icons/cuervo.svg">Guardia del Cuervo</option>
                        <option value="7" data-subfaccion="Adeptus Astartes" data-icon="../public/assets/images/icons/salamandras.svg">Salamandras</option>
                        <option value="8" data-subfaccion="Adeptus Astartes" data-icon="../public/assets/images/icons/lobos.svg">Lobos Espaciales</option>
                        <option value="9" data-subfaccion="Adeptus Astartes" data-icon="../public/assets/images/icons/ultras.svg">Ultramarines</option>
                        <option value="10" data-subfaccion="Adeptus Astartes" data-icon="../public/assets/images/icons/cicatrices.svg">Cicatrices Blancas</option>
                        <option value="11" data-subfaccion="Imperium" data-icon="../public/assets/images/icons/custodes.svg">Adeptus Custodes</option>
                        <option value="12" data-subfaccion="Imperium" data-icon="../public/assets/images/icons/sororitas.svg">Hermanas de Batalla</option>
                        <option value="13" data-subfaccion="Imperium" data-icon="../public/assets/images/icons/mechanicus.svg">Adeptus Mechanicus</option>
                        <option value="14" data-subfaccion="Imperium" data-icon="../public/assets/images/icons/agentes.svg">Agentes Imperiales</option>
                        <option value="15" data-subfaccion="Imperium" data-icon="../public/assets/images/icons/guardia.svg">Guardia Imperial</option>
                        <option value="16" data-subfaccion="Imperium" data-icon="../public/assets/images/icons/grises.svg">Caballeros Grises</option>
                        <option value="17" data-subfaccion="Imperium" data-icon="../public/assets/images/icons/caballeros.svg">Caballeros Imperiales</option>
                        <option value="18" data-subfaccion="Imperium" data-icon="../public/assets/images/icons/astartes.svg">Marines Espaciales</option>
                        <option value="19" data-subfaccion="Aeldari" data-icon="../public/assets/images/icons/drukhari.svg">Drukhari</option>
                        <option value="20" data-subfaccion="Aeldari" data-icon="../public/assets/images/icons/ynnari.svg">Ynnari</option>
                        <option value="21" data-subfaccion="Caos" data-icon="../public/assets/images/icons/demons.svg">Demonios del Caos</option>
                        <option value="22" data-subfaccion="Caos" data-icon="../public/assets/images/icons/caballeroscaos.svg">Caballeros del Caos</option>
                        <option value="23" data-subfaccion="Caos" data-icon="../public/assets/images/icons/herejes.svg">Marines Espaciales del Caos</option>
                        <option value="24" data-subfaccion="Heretic Astartes" data-icon="../public/assets/images/icons/nurgle.svg">Guardia de la Muerte</option>
                        <option value="25" data-subfaccion="Heretic Astartes" data-icon="../public/assets/images/icons/hijos.svg">Mil Hijos</option>
                        <option value="26" data-subfaccion="Heretic Astartes" data-icon="../public/assets/images/icons/devoradores.svg">Devoradores de Mundos</option>
                        <option value="27" data-subfaccion="Heretic Astartes" data-icon="../public/assets/images/icons/negra.svg">Legión Negra</option>
                        <option value="28" data-subfaccion="Xenos" data-icon="../public/assets/images/icons/cultos.svg">Cultos Genestealers</option>
                        <option value="29" data-subfaccion="Xenos" data-icon="../public/assets/images/icons/necrones.svg">Necrones</option>
                        <option value="30" data-subfaccion="Xenos" data-icon="../public/assets/images/icons/orcos.svg">Orcos</option>
                        <option value="31" data-subfaccion="Xenos" data-icon="../public/assets/images/icons/tau.svg">Imperio T'au</option>
                        <option value="32" data-subfaccion="Xenos" data-icon="../public/assets/images/icons/tiranidos.svg">Tiranidos</option>


                        <!-- Agrega el resto de las facciones aquí siguiendo el formato -->
                    </select>
                </div>
                <div class="mb-3">
                    <select id="faccionSigmar" name="faccion" class="form-select" disabled style="display:none;" onchange="mostrarFaccionSigmar()">
                        <option value="" selected disabled>Selecciona una facción</option>
                        <!-- Facciones de Warhammer 40k -->
                        <option value="33" data-subfaccion="Grandes Alianzas" data-icon="../public/assets/images/icons/order.svg">Orden</option>
                        <option value="34" data-subfaccion="Grandes Alianzas" data-icon="../public/assets/images/icons/death.svg">Muerte</option>
                        <option value="35" data-subfaccion="Grandes Alianzas" data-icon="../public/assets/images/icons/chaos.svg">Caos</option>
                        <option value="36" data-subfaccion="Grandes Alianzas" data-icon="../public/assets/images/icons/destruction.svg">Destrucción</option>
                        <!-- Agrega el resto de las facciones aquí siguiendo el formato -->
                    </select>
                </div>

                <!-- Selección de Hora de inicio y finalización
                <div class="mb-3">
                <label for="hora_inicio" class="form-label">Hora de inicio</label>
                <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" 
                    min="16:00" max="21:00" onchange="verificarFormulario()">

                </div>
                <div class="mb-3">
                <label for="hora_final" class="form-label">Hora de finalización</label>
                <input type="time" name="hora_final" id="hora_final" class="form-control" 
                    min="16:00" max="21:00" onchange="verificarFormulario()">

                </div>

                <!-- Selección de Mesa
                <div class="mb-3">
                    <label for="mesa" class="form-label">Mesa</label>
                    <select id="mesa" name="mesa" class="form-select">
                        <option value="" selected disabled>Selecciona tu Mesa</option>
                        <option value="1">Mesa 1</option>
                        <option value="2">Mesa 2</option>
                        <option value="3">Mesa 3</option>
                    </select>
                </div> -->
            
        </div>

        <!-- Columna derecha: Previsualización -->
        <div class="col-md-6 text-center">
            <h3>LISTO PARA DEPLEGAR...</h3>
            <br>
            <center><img id="icono-faccion" class="faction-icon my-3" src="" alt="Icono de facción" style="display: none;"></center>

            <span style="color: gray; font-size: 15px;" id="nombre-faccion"></span>
            <h4 id="subfaccion-faccion"></h4>
            <br><br>
            <div class="button">
                <button class="btn" id="crear-partida" type="submit" disabled>CREAR PARTIDA</button>
            </div>
        </div>
    </form>
    </div>
</div>

<script>
    function actualizarFormulario() {
    const juego = document.getElementById('juego').value;
    const faccion40kSelect = document.getElementById('faccion40k');
    const faccionSigmarSelect = document.getElementById('faccionSigmar');
    const puntosSelect = document.getElementById('puntos');

    if (juego === '1') {
        faccion40kSelect.style.display = 'block';
        faccionSigmarSelect.style.display = 'none';
        faccion40kSelect.disabled = false;
        puntosSelect.disabled = false;
        faccionSigmarSelect.disabled = true;  // Desactivar Sigmar

    } else if (juego === '2') {
        faccionSigmarSelect.style.display = 'block';
        faccion40kSelect.style.display = 'none';
        faccionSigmarSelect.disabled = false;
        puntosSelect.disabled = false;  // Desactivar puntos para Sigmar
        faccion40kSelect.disabled = true;  // Desactivar 40k
    } else {
        // Para otros juegos como Kill Team o WarCry
        faccion40kSelect.disabled = true;
        faccionSigmarSelect.disabled = true;
        puntosSelect.disabled = true; // Desactivar puntos
        faccion40kSelect.style.display = 'none';
        faccionSigmarSelect.style.display = 'none';
    }
    }

    function mostrarFaccion40k() {
        const faccion40kSelect = document.getElementById('faccion40k');
        const selectedOption = faccion40kSelect.options[faccion40kSelect.selectedIndex];
        const subfaccion = selectedOption.getAttribute('data-subfaccion');
        const icono = selectedOption.getAttribute('data-icon');

        // Mostrar facción y subfacción en la columna de previsualización
        document.getElementById('nombre-faccion').textContent = subfaccion;
        document.getElementById('subfaccion-faccion').textContent = selectedOption.text;

        // Mostrar icono de facción
        const iconoFaccion = document.getElementById('icono-faccion');
        iconoFaccion.src = icono;
        iconoFaccion.style.display = 'block';

        // Habilitar botón de crear si todos los campos están llenos
        verificarFormulario();
    }
    function mostrarFaccionSigmar() {
        const faccionSigmarSelect = document.getElementById('faccionSigmar');
        const selectedOption = faccionSigmarSelect.options[faccionSigmarSelect.selectedIndex];
        const subfaccion = selectedOption.getAttribute('data-subfaccion');
        const icono = selectedOption.getAttribute('data-icon');

        // Mostrar facción y subfacción en la columna de previsualización
        document.getElementById('nombre-faccion').textContent = subfaccion;
        document.getElementById('subfaccion-faccion').textContent = selectedOption.text;

        // Mostrar icono de facción
        const iconoFaccion = document.getElementById('icono-faccion');
        iconoFaccion.src = icono;
        iconoFaccion.style.display = 'block';

        // Habilitar botón de crear si todos los campos están llenos
        verificarFormulario();
    }

    function verificarFormulario() {
    const juego = document.getElementById('juego').value;
    const puntos = document.getElementById('puntos').value;

    let faccion = null;

    // Verificar qué select de facciones debe estar habilitado
    if (juego === '1') {
        faccion = document.getElementById('faccion40k').value;
    } else if (juego === '2') {
        faccion = document.getElementById('faccionSigmar').value;
    }

    let formValido = juego && faccion;

    // Verificar puntos solo si el juego es Warhammer 40k
    if ((juego === '1' || juego === '2') && !puntos) {
    formValido = false;
    }


    document.getElementById('crear-partida').disabled = !formValido;
    }
    </script>
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

