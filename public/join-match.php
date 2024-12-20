<?php
require_once "../src/validate_session.php";

include '../public/db.php'; // Asegúrate de incluir tu archivo de conexión a la base de datos

$id_partida = $_POST['id_partida']; // Asegúrate de que el ID sea pasado de manera segura
$_SESSION['id_partida'] = $_POST['id_partida'];

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
                        <li>UNIRSE A UNA PARTIDA</li>
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
            <div class="col-xxl-12">
                <div class="matches-div text-center">
                            <h2 style="border-bottom: solid 1px #6E869D;">UNIRSE A UNA PARTIDA</h2>
                            <br>
                            <div class="container mt-1">
    <div class="row">
        <!-- Columna izquierda: Selección -->
        <div class="col-md-6">
            <h3 class="text-center">SELECCIONA TU FACCIÓN</h3>
            <br>
    <form action="../public/unirse.php" method="POST">
                <!-- Selección de Facción -->
                <div class="mb-3">
                    <select id="faccion40k" name="faccion" class="form-select" style="display:block;" onchange="mostrarFaccion40k()">
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
                    <select id="faccionSigmar" name="faccion" class="form-select" style="display:none;" onchange="mostrarFaccionSigmar()">
                        <option value="" selected disabled>Selecciona una facción</option>
                        <!-- Facciones de Warhammer 40k -->
                        <option value="33" data-subfaccion="Grandes Alianzas" data-icon="../public/assets/images/icons/order.svg">Orden</option>
                        <option value="34" data-subfaccion="Grandes Alianzas" data-icon="../public/assets/images/icons/death.svg">Muerte</option>
                        <option value="35" data-subfaccion="Grandes Alianzas" data-icon="../public/assets/images/icons/chaos.svg">Caos</option>
                        <option value="36" data-subfaccion="Grandes Alianzas" data-icon="../public/assets/images/icons/destruction.svg">Destrucción</option>
                        <!-- Agrega el resto de las facciones aquí siguiendo el formato -->
                    </select>
                </div>
            
        </div>

        <!-- Columna derecha: Previsualización -->
        <div class="col-md-6 text-center">
            <h3>LISTO PARA DEPLEGAR...</h3>
            <br>
            <?php
                            include("../public/db.php");
                            // Verificar conexión
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $id_partida = $_POST['id_partida'];
    
                            // Consulta para obtener partidas programadas
                            $sql = "SELECT p.id_juego, p.puntos, p.nombre_usuario1, p.nombre_usuario2, 
                            f1.nombre AS faccion1, f1.subfaccion AS subfaccion1, f1.icono AS icono1, 
                            f2.nombre AS faccion2, f2.subfaccion AS subfaccion2, f2.icono AS icono2,
                            p.hora_inicio, p.hora_final, p.id_mesa, p.puntaje_usuario1, 
                            p.puntaje_usuario2
                            FROM partida p
                            JOIN faccion f1 ON p.id_faccion_usuario1 = f1.id_faccion
                            JOIN faccion f2 ON p.id_faccion_usuario2 = f2.id_faccion
                            WHERE p.id_partida like $id_partida";
    
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <!-- Aquí empieza el HTML para mostrar las partidas programadas -->
                                    <div class="match-entry mb-2 text-center">
                                        <div class="row align-items-center player">
                                            <?php
                                                // Supongamos que $conn es tu conexión a la base de datos
                                                $nombre_usuario = $row['nombre_usuario1'];
                                                $query = "SELECT foto_perfil FROM usuarios WHERE nombre_usuario = ?";
                                                $stmt = $conn->prepare($query);
                                                $stmt->bind_param("s", $nombre_usuario);
                                                $stmt->execute();
                                                $stmt->bind_result($foto_perfil);
                                                $stmt->fetch();
                                                $stmt->close();

                                                ?>
                                            <div class="col-2">
                                                <img src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="Foto de perfil" class="img-fluid" style="object-fit: cover; border-radius: 5px; border: solid 2px #ECBE00;">
                                            </div>
                                            <div class="col-3">
                                            <span><a class="category" href="user_profile.php?usuario=<?php echo urlencode($row['nombre_usuario1']); ?>"><?php echo htmlspecialchars($row['nombre_usuario1']); ?></a></span>
                                            </div>
                                            <div class="col-2">
                                            <img src="assets/images/matches/sword.png" alt="Icono de batalla" class="img-fluid" style="max-width: 25px;">
                                            </div>
                                            <div class="col-3">
                                                <span><?php echo $_SESSION['nombre_usuario']; ?></span>
                                            </div>
                                            <div class="col-2">
                                            <img src="<?php echo $_SESSION['foto_perfil']; ?>" alt="Foto de perfil" class="img-fluid" style="object-fit: cover; border-radius: 5px; border: solid 2px #ECBE00;">
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
                                            <img id="icono-faccion" class="faction-icon" src="" alt="Icono de facción" style="display: none;">
                                                <div class="team-name"><?php echo "<html><span id='nombre-faccion'></span></html>"; ?><br><?php echo "<html><span id='subfaccion-faccion'></span></html>"; ?></div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <!-- Aquí termina el HTML para mostrar las partidas programadas -->
                                    <?php
                                }
                            } else {
                                echo "No hay partidas programadas.";
                            }
                            ?>
            

            
            
            <br><br>
            <div class="button">
                <button class="btn" id="crear-partida" type="submit" disabled>UNIRSE</button>
            </div>
        </div>
    </form>
    </div>
</div>

<script>
    // Recibir el valor de $juego desde PHP
    const juego = <?php echo $juego; ?>;

    const faccion40kSelect = document.getElementById('faccion40k');
    const faccionSigmarSelect = document.getElementById('faccionSigmar');

    // Función para actualizar el formulario basado en el juego
    function actualizarFormulario() {
        if (juego === 1) { // Warhammer 40k
            faccion40kSelect.style.display = 'block';
            faccionSigmarSelect.style.display = 'none';
            faccion40kSelect.disabled = false;
            faccionSigmarSelect.disabled = true;
        } else if (juego === 2) { // Age of Sigmar
            faccionSigmarSelect.style.display = 'block';
            faccion40kSelect.style.display = 'none';
            faccionSigmarSelect.disabled = false;
            faccion40kSelect.disabled = true;
        } else {
            // Para otros juegos, desactivar ambos selects
            faccion40kSelect.disabled = true;
            faccionSigmarSelect.disabled = true;
            faccion40kSelect.style.display = 'none';
            faccionSigmarSelect.style.display = 'none';
        }
    }

    // Llamar a la función de actualización del formulario
    actualizarFormulario();

    // Función para mostrar la facción seleccionada en Warhammer 40k
    function mostrarFaccion40k() {
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

        verificarFormulario();
    }

    // Función para mostrar la facción seleccionada en Age of Sigmar
    function mostrarFaccionSigmar() {
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

        verificarFormulario();
    }

    // Función para verificar que el formulario esté completo antes de permitir la creación
    function verificarFormulario() {
        let faccion = null;

        // Verificar qué select de facciones debe estar habilitado
        if (juego === 1) {
            faccion = document.getElementById('faccion40k').value;
        } else if (juego === 2) {
            faccion = document.getElementById('faccionSigmar').value;
        }

        let formValido = juego && faccion;

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

