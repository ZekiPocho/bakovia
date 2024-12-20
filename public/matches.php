<?php
include("../src/validate_session.php");
if (date('N') == 6) { // 'N' devuelve 1 (lunes) a 7 (domingo)
    header("Location: sorry.html"); // Cambia 'otra_pagina.php' por la URL a la que deseas redirigir
    exit(); // Asegúrate de usar exit() después de header para detener la ejecución del script
}
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
                        <h1 class="page-title">PARTIDAS</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.php"><i class="lni lni-home"></i> INICIO</a></li>
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
date_default_timezone_set('America/La_Paz'); // O la zona horaria que necesites
// Consulta para obtener partidas en progreso
        $sql = "SELECT p.id_partida, p.id_juego, p.puntos, 
            p.nombre_usuario1, u1.made AS made_usuario1, 
            p.nombre_usuario2, u2.made AS made_usuario2, 
            f1.nombre AS faccion1, f1.subfaccion AS subfaccion1, f1.icono AS icono1, 
            f2.nombre AS faccion2, f2.subfaccion AS subfaccion2, f2.icono AS icono2,
            p.hora_inicio, p.hora_final, p.id_mesa, p.puntaje_usuario1, 
            p.puntaje_usuario2
        FROM partida p
        JOIN faccion f1 ON p.id_faccion_usuario1 = f1.id_faccion
        JOIN faccion f2 ON p.id_faccion_usuario2 = f2.id_faccion
        JOIN usuarios u1 ON p.nombre_usuario1 = u1.nombre_usuario
        JOIN usuarios u2 ON p.nombre_usuario2 = u2.nombre_usuario
        WHERE p.estado = 'en progreso'
        ";

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
                if ($usuario_actual === $row['nombre_usuario1'] && $row['made_usuario1'] == 1) {
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
    echo "<html><br></html>";
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

$id_usuario = $_SESSION['id_usuario']; // Obtener el ID del usuario de la sesión

// Consulta para obtener partidas programadas
$sql = "SELECT 
    p.id_partida, 
    j.nombre AS id_juego, -- Nombre del juego en lugar del ID
    p.puntos, 
    p.nombre_usuario1, 
    u1.made AS made_usuario1, 
    p.nombre_usuario2, 
    u2.made AS made_usuario2, 
    f1.nombre AS faccion1, 
    f1.subfaccion AS subfaccion1, 
    f1.icono AS icono1, 
    f2.nombre AS faccion2, 
    f2.subfaccion AS subfaccion2, 
    f2.icono AS icono2,
    LEFT(h1.hora, 5) AS hora_inicio, -- Mostrar solo los primeros 5 caracteres
    LEFT(h2.hora, 5) AS hora_final, -- Mostrar solo los primeros 5 caracteres
    p.id_mesa, 
    p.puntaje_usuario1, 
    p.puntaje_usuario2,
    u_made.made AS made_usuario_sesion -- Agregar made del usuario en la sesión
FROM partida p
JOIN faccion f1 ON p.id_faccion_usuario1 = f1.id_faccion
JOIN faccion f2 ON p.id_faccion_usuario2 = f2.id_faccion
LEFT JOIN usuarios u1 ON p.nombre_usuario1 = u1.nombre_usuario
LEFT JOIN usuarios u2 ON p.nombre_usuario2 = u2.nombre_usuario
LEFT JOIN usuarios u_made ON u_made.id_usuario = ? -- Unir por ID de usuario
JOIN juego j ON p.id_juego = j.id_juego -- Unir con la tabla juego para obtener el nombre
JOIN horarios h1 ON p.hora_inicio = h1.id_hora -- Unir con la tabla horarios para obtener la hora de inicio
JOIN horarios h2 ON p.hora_final = h2.id_hora -- Unir con la tabla horarios para obtener la hora de finalización
WHERE p.estado = 'programado'
AND p.fecha = CURDATE()";


$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario); // Vincula el ID de usuario
$stmt->execute();
$result = $stmt->get_result();

// Verificar y procesar los resultados
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
            <?php
            if ($usuario_actual === $row['nombre_usuario1'] && $row['made_usuario1'] == 1) {
                echo '<a href="panel_control.php?id_partida=' . $row['id_partida'] . '" class="btn btn-primary">ADMIN</a>';
            } else {
                if ($row['nombre_usuario2'] !== "N/A") {
                    echo '<img src="assets/images/matches/sword.png" alt="Icono de batalla" class="img-fluid" style="max-width: 25px;">';
                } else {
                    echo '<h7>PARTIDA ABIERTA</h7>';
                }
            }
            ?>
        </div>
        <div class="col-5">
            <?php
            // Supongamos que $conn es tu conexión a la base de datos
            $nombre_usuario = $row['nombre_usuario2'];
            $query = "SELECT foto_perfil FROM usuarios WHERE nombre_usuario = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $nombre_usuario);
            $stmt->execute();
            $stmt->bind_result($foto_perfil2);
            $stmt->fetch();
            $stmt->close();

            ?>
            <?php
            // Mostrar el botón solo si el usuario actual no es el usuario 1 y si la partida está abierta
            if ($usuario_actual === $row['nombre_usuario1'] && $row['made_usuario1'] == 1) {
                if ($row['nombre_usuario2'] !== "N/A") {
                    echo '<div class="row align-items-center player">
                            <div class="col-7">
                                <span><a class="category" href="user_profile.php?usuario=' . urlencode($row['nombre_usuario2']) . '">' . htmlspecialchars($row['nombre_usuario2']) . '</a></span>
                            </div>
                            <div class="col-5">
                                <img src="' . htmlspecialchars($foto_perfil2) . '" alt="Foto de perfil" class="img-fluid" style="object-fit: cover; border-radius: 5px; border: solid 2px #ECBE00;">
                            </div>
                        </div>';
                } else {
                    echo 'ESPERANDO';
                }
            } else {
                // Verificar si el usuario en la sesión tiene made como 1
                if ($row['made_usuario_sesion'] == 1) {
                    if ($row['nombre_usuario2'] !== "N/A") {
                        echo '<div class="row align-items-center player">
                                <div class="col-5">
                                    <span>' . htmlspecialchars($row["nombre_usuario2"]) . '</span>
                                </div>
                                <div class="col-7">';
                                
                                // Comprobación para el botón de salir
                                if ($usuario_actual === $row['nombre_usuario2'] && $row['made_usuario2'] == 1) {
                                    echo '<a href="leave-match.php?id_partida=' . $row['id_partida'] . '" class="btn btn-danger">SALIR</a>';
                                }

                        echo '  </div>
                            </div>';

                        // Agregar enlace para que el usuario2 salga de la partida
                        
                    } else {
                        echo '<form action="join-match.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id_partida" value="' . $row['id_partida'] . '">
                                <div class="button">
                                    <button class="btn" disabled>UNIRSE</button>
                                </div>
                              </form>';
                    }
                } else {
                    echo '<form action="join-match.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id_partida" value="' . $row['id_partida'] . '">
                            <div class="button">
                                <button class="btn">UNIRSE</button>
                            </div>
                          </form>';
                }
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
            <img src="<?php echo $row['icono2']; ?>" alt="Equipo 2" style="filter: opacity(<?php echo $row['nombre_usuario2'] !== 'N/A' ? '1' : '0.25'; ?>) <?php echo $row['nombre_usuario2'] !== 'N/A' ? 'none' : 'invert(100%)'; ?>;">
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
                    <?php
                        include ("../public/db.php");
                        $id_usuario = $_SESSION['id_usuario'];

                        // Preparar la consulta
                        $sql = "SELECT made FROM usuarios WHERE id_usuario = ?";
                        $stmt = $conn->prepare($sql);

                        if ($stmt) {
                            // Vincular el parámetro
                            $stmt->bind_param("i", $id_usuario);

                            // Ejecutar la consulta
                            $stmt->execute();

                            // Obtener el resultado
                            $result = $stmt->get_result();

                            // Verificar si hay resultados
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $made = $row['made'];
                            } else {
                                $made = 0; // Asignar un valor por defecto si no hay resultados
                            }

                            // Cerrar el statement
                            $stmt->close();
                        } else {
                            // Manejo de error al preparar la consulta
                            echo "Error al preparar la consulta: " . $conn->error;
                        }

                        ?>

                        <?php if (isset($made) && $made != 1): ?>
                            <!-- Mostrar el botón solo si 'made' no es true (1) -->
                            <br><br><br>
                            <p class="text-muted"><span style="font-size: 15px;">O sino, inicia tu propia partida</span></p>
                            <br>
                            <div class="button">
                                <a href="new-match.php"><button class="btn">Nueva Partida</button></a>
                            </div>
                        <?php endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
    

    
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