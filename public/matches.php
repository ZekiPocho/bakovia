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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    <div id="matchesContainer">
                        <!-- Aquí se cargarán las partidas programadas mediante AJAX -->
                    </div>
    
            <!-- Columna de partidas abiertas para jugar -->
            <div class="col-xxl-6">
                <div class="matches-div text-center">
                    <h3 style="border-bottom: solid 1px #6E869D;">¡A JUGAR!</h3>
                    <br>
                    
                    

                    <script>
$(document).ready(function() {
    function fetchMatches() {
        $.ajax({
            url: 'fetch_matches.php', // Cambia esto por la ruta a tu nuevo archivo PHP
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#matchesContainer').empty(); // Limpia el contenedor antes de agregar nuevos datos
                if (data.length > 0) {
                    data.forEach(function(row) {
                        $('#matchesContainer').append(`
                            <div class="match-entry mb-2 text-center">
                                <div class="row align-items-center player">
                                    <div class="col-2">
                                        <img src="${row.foto_perfil_usuario1}" alt="Foto de perfil" class="img-fluid" style="object-fit: cover; border-radius: 5px; border: solid 2px #ECBE00;">
                                    </div>
                                    <div class="col-3">
                                        <span><a class="category" href="user_profile.php?usuario=${encodeURIComponent(row.nombre_usuario1)}">${row.nombre_usuario1}</a></span>
                                    </div>
                                    <div class="col-2">
                                        ${row.nombre_usuario2 !== 'N/A' ? '<img src="assets/images/matches/sword.png" alt="Icono de batalla" class="img-fluid" style="max-width: 25px;">' : '<h7>PARTIDA ABIERTA</h7>'}
                                    </div>
                                    <div class="col-5">
                                        ${row.nombre_usuario2 !== 'N/A' ? `
                                            <span><a class="category" href="user_profile.php?usuario=${encodeURIComponent(row.nombre_usuario2)}">${row.nombre_usuario2}</a></span>
                                        ` : 'ESPERANDO'}
                                    </div>
                                </div>
                                <div class="scoreboard">
                                    <div class="team">
                                        <img src="${row.icono1}" alt="Equipo 1">
                                        <div class="team-name">${row.faccion1}<br>${row.subfaccion1}</div>
                                    </div>
                                    <div class="score">${row.puntaje_usuario1}</div>
                                    <div class="middle-section">
                                        <h1>${row.id_juego}</h1>
                                        <h1>${row.puntos} Pts.</h1>
                                        <div class="timer">${row.hora_inicio} - ${row.hora_final}</div>
                                        <h1>MESA - ${row.id_mesa}</h1>
                                    </div>
                                    <div class="score">${row.puntaje_usuario2}</div>
                                    <div class="team">
                                        <img src="${row.icono2}" alt="Equipo 2">
                                        <div class="team-name">${row.faccion2}<br>${row.subfaccion2}</div>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                } else {
                    $('#matchesContainer').append("No hay partidas programadas.");
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                $('#matchesContainer').append("Error al cargar las partidas.");
            }
        });
    }

    // Llama a la función para obtener las partidas al cargar la página
    fetchMatches();
    
    // Puedes configurar intervalos para refrescar las partidas
    // setInterval(fetchMatches, 5000); // Por ejemplo, cada 5 segundos
});
</script>

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