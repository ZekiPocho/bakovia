<?php
require_once "../src/validate_session.php";

include '../public/db.php'; // Asegúrate de incluir tu archivo de conexión a la base de datos

$id_partida = $_POST['id_partida']; // Asegúrate de que el ID sea pasado de manera segura

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
        $fecha_partida = $partida['fecha_partida'] ?? null;
        $juego = $partida['juego'] ?? null;
        $puntos = $partida['puntos'] ?? null;
        $duracion = $partida['duracion'] ?? null;
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
                        <h1 class="page-title">CREAR PARTIDA</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.html"><i class="lni lni-home"></i> INICIO</a></li>
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
    <form action="../public/reserva.php" method="POST">
                <!-- Selección de Juego -->
                <div class="mb-3">
                    <select id="juego" name="juego" class="form-select" disabled on="actualizarFormulario()">
                        <option value="ageofsigmar" selected disabled>Selecciona un juego</option>
                    </select>
                </div>


                <!-- Selección de Facción -->
                <div class="mb-3">
                    <label for="faccion" class="form-label">Facción</label>
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
                    <select id="faccionSigmar" class="form-select" style="display:none;" onchange="mostrarFaccionSigmar()">
                        <option value="" selected disabled>Selecciona una facción</option>
                        <!-- Facciones de Warhammer 40k -->
                        <option value="1" data-subfaccion="Adeptus Astartes" data-icon="../public/assets/images/icons/templarios.svg">Templarios Negros</option>
                        <option value="2" data-subfaccion="Adeptus Astartes" data-icon="../public/assets/images/icons/sangrientos.svg">Ángeles Sangrientos</option>
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
                                        <div class="row align-items-center">
                                            <div class="col-2">
                                                <img src="https://via.placeholder.com/50x50" alt="Foto de perfil" class="img-fluid">
                                            </div>
                                            <div class="col-3">
                                                <span><?php echo $row['nombre_usuario1']; ?></span>
                                            </div>
                                            <div class="col-2">
                                            <img src="assets/images/matches/sword.png" alt="Icono de batalla" class="img-fluid" style="max-width: 25px;">
                                            </div>
                                            <div class="col-3">
                                                <span><?php echo $_SESSION['nombre_usuario']; ?></span>
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
                                                <div class="timer"><?php echo $row['hora_inicio']; ?> - <?php echo $row['hora_final']; ?></div>
                                                <h1>MESA - <?php echo $row['id_mesa']; ?></h1>
                                            </div>
                                            <div class="score"><?php echo $row['puntaje_usuario2']; ?></div>
                                            <div class="team">
                                            <center><img id="icono-faccion" class="faction-icon my-3" src="" alt="Icono de facción" style="display: none;"></center>
                                                <div class="team-name"><?php echo "<html><span style='color: gray; font-size: 15px;' id='nombre-faccion'></span></html>"; ?><br><?php echo "<html><h4 id='subfaccion-faccion'></h4></html>"; ?></div>
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
    document.addEventListener('DOMContentLoaded', function() {
        const juegoSelect = document.getElementById('juego');
        const faccion40kSelect = document.getElementById('faccion40k');
        const faccionSigmarSelect = document.getElementById('faccionSigmar');
        const puntosSelect = document.getElementById('puntos');

        // Actualizar formulario cuando el valor del juego cambia
        juegoSelect.addEventListener('change', actualizarFormulario);

        // Función para actualizar el formulario según el juego seleccionado
        function actualizarFormulario() {
            const juego = juegoSelect.value;

            if (juego === '1') { // Warhammer 40k
                faccion40kSelect.style.display = 'block';
                faccionSigmarSelect.style.display = 'none';
                faccion40kSelect.disabled = false;
                puntosSelect.disabled = false;
                faccionSigmarSelect.disabled = true; // Desactivar Sigmar

            } else if (juego === '2') { // Age of Sigmar
                faccionSigmarSelect.style.display = 'block';
                faccion40kSelect.style.display = 'none';
                faccionSigmarSelect.disabled = false;
                puntosSelect.disabled = true; // Desactivar puntos para Sigmar
                faccion40kSelect.disabled = true; // Desactivar 40k
            } else {
                // Para otros juegos
                faccion40kSelect.disabled = true;
                faccionSigmarSelect.disabled = true;
                puntosSelect.disabled = true; // Desactivar puntos
                faccion40kSelect.style.display = 'none';
                faccionSigmarSelect.style.display = 'none';
            }
        }

        // Funciones para mostrar facción y subfacción en la previsualización
        faccion40kSelect.addEventListener('change', mostrarFaccion40k);
        faccionSigmarSelect.addEventListener('change', mostrarFaccionSigmar);

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

            // Habilitar botón de crear si todos los campos están llenos
            verificarFormulario();
        }

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

            // Habilitar botón de crear si todos los campos están llenos
            verificarFormulario();
        }

        function verificarFormulario() {
            let faccion = null;
            const juego = juegoSelect.value; // Obtener el valor actual del juego
            const puntos = puntosSelect.value; // Obtener el valor de puntos

            // Verificar qué select de facciones debe estar habilitado
            if (juego === '1') {
                faccion = faccion40kSelect.value;
            } else if (juego === '2') {
                faccion = faccionSigmarSelect.value;
            }

            let formValido = juego && faccion;

            // Verificar puntos solo si el juego es Warhammer 40k
            if (juego === '1' && !puntos) {
                formValido = false;
            }

            document.getElementById('crear-partida').disabled = !formValido;
        }

        // Llamar a la función para inicializar el estado del formulario al cargar la página
        actualizarFormulario();
    });
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

