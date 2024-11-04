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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        <h1 class="page-title">PANEL DE CONTROL</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.php"><i class="lni lni-home"></i> INICIO</a></li>
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

        // Nueva consulta adaptada para obtener todos los datos de la partida, incluyendo id_reserva
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
                        p.puntaje_usuario2 AS puntaje_jugador2,
                        p.id_reserva AS id_reserva,
                        p.ronda AS ronda -- Extraer ronda directamente de partida
                    FROM partida p
                    LEFT JOIN faccion f1 ON p.id_faccion_usuario1 = f1.id_faccion
                    LEFT JOIN faccion f2 ON p.id_faccion_usuario2 = f2.id_faccion
                    LEFT JOIN usuarios u1 ON p.nombre_usuario1 = u1.nombre_usuario
                    LEFT JOIN usuarios u2 ON p.nombre_usuario2 = u2.nombre_usuario
                    LEFT JOIN juego j ON p.id_juego = j.id_juego -- Aquí seleccionas el nombre del juego
                    LEFT JOIN horarios h1 ON p.hora_inicio = h1.id_hora
                    LEFT JOIN horarios h2 ON p.hora_final = h2.id_hora
                    WHERE p.id_partida = ?; -- Se utiliza el id_partida para filtrar la consulta
                "; // No es necesario unir con reserva_mesa aquí
        
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
                $id_reserva = $partida['id_reserva'] ?? null; // Asignar id_reserva directamente de partida
                $ronda = $partida['ronda'] ?? null; // Asignar id_reserva directamente de partida
        
                // Ahora puedes usar las variables para mostrar los datos en tu HTML
            } else {
                echo "No se encontró la partida con el ID proporcionado.";
            }    
            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta.";
        }
        
        
    ?>

<div class="container-sm mt-4 p-3">
    <div class="row justify-content-center">
        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4"> <!-- Columna para el Jugador 1 -->
            <div class="team">
                <h4 id="nombre_jugador1" class="text-center"><?php echo htmlspecialchars($nombre_jugador1); ?></h4>
                <br>
                <img id="icono_jugador1" src="<?php echo htmlspecialchars($icono1); ?>" alt="Facción Jugador 1" class="img-fluid" style="height: 150px;">
                <br>
                <br>
                <div class="team-name">
                <p id="faccion_jugador1"><?php echo htmlspecialchars($faccion1); ?></p>
                <h3 id="subfaccion_jugador1"><?php echo htmlspecialchars($subfaccion1); ?></h3>
                </div>
                <br>
                    <input type="hidden" name="id_partida" value="<?php echo htmlspecialchars($id_partida); ?>">
                    <input type="hidden" name="jugador" value="1">
                    <div class="mb-3">
                        <center>
                        <input id="puntaje_jugador1" type="number" style="width: 100px; height: 100px; font-size: xxx-large;align-content: center;" name="puntaje_jugador1" class="form-control" value="<?php echo htmlspecialchars($puntaje_jugador1); ?>">
                        </center>                    
                    </div>
            </div>
        </div>

        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4"> <!-- Columna central -->
    <div class="matches-div text-center">
        <div class="middle-section text-center">
            <!-- Información del Juego -->
            <p style="font-size: 1.50rem;"><?php echo htmlspecialchars($nombre_juego); ?></p> <!-- Nombre del juego -->
            <br>
            <!-- Puntos -->
            <p id="puntos" style="font-size: 1.2rem; filter: opacity(50%);"><?php echo htmlspecialchars($puntos); ?> Pts.</p> <!-- Puntos -->
            <br>
            <!-- Horarios -->
            <h4 style="font-size: 1rem;">Horario Reservado:</h4>
            <p style="font-size: 1rem;">
                Inicio: <?php echo htmlspecialchars(date("H:i", strtotime($hora_inicio))); ?> <br>
                Finalización: <?php echo htmlspecialchars(date("H:i", strtotime($hora_final))); ?>
            </p> <!-- Horas de inicio y finalización -->   
            <br>

                <input type="hidden" name="id_partida" value="<?php echo htmlspecialchars($id_partida); ?>">
                <div class="mb-3">
                    <h3 for="rondas">Ronda Nº:</h3>
                    <center>
                    <input id="ronda" type="number" style="width: 80px;" name="rondas" class="form-control" value="<?php echo htmlspecialchars($ronda); ?>"> <!-- Cambia este valor al número de rondas actual -->
                    </center>
                </div>
                <button type="button" id="iniciar-btn" class="btn btn-primary" disabled>
                    INICIAR
                </button>
                <!-- Botón para finalizar la partida (inicialmente oculto) -->
                <button type="button" id="finalizar-btn" class="btn btn-danger" style="display: none;">
                    FINALIZAR
                </button>
                
            <form action="delete_match.php" method="POST" onsubmit="return confirmDelete();">
                <input type="hidden" name="id_partida" value="<?php echo htmlspecialchars($id_partida); ?>">
                <input type="hidden" name="id_reserva" value="<?php echo htmlspecialchars($id_reserva); ?>">
                <br>
                <button type="submit" class="btn btn-danger">BORRAR PARTIDA</button>
            </form>
        </div>
    </div>
</div>


        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4"> <!-- Columna para el Jugador 2 -->
            <div class="team">
                <h4 id="nombre_jugador2" class="text-center"><?php echo htmlspecialchars($nombre_jugador2); ?></h4>
                <br>
                <img id="icono_jugador2" src="<?php echo htmlspecialchars($icono2); ?>" alt="Facción Jugador 2" class="img-fluid" style="height: 150px;">
                <br>
                <br>
                <div class="team-name">
                    <p id="faccion_jugador2"><?php echo htmlspecialchars($faccion2); ?></p>
                    <h3 id="subfaccion_jugador2"><?php echo htmlspecialchars($subfaccion2); ?></h3>
                </div>
                <br>
                <form action="adjust_score.php" method="POST" id="scoreFormJugador2">
                    <input type="hidden" name="id_partida" value="<?php echo htmlspecialchars($id_partida); ?>">
                    <input type="hidden" name="jugador" value="2">
                    <div class="mb-3">
                        <center>
                        <input id="puntaje_jugador2" type="number" style="width: 100px; height: 100px; font-size: xxx-large;align-content: center;" name="puntaje_jugador2" class="form-control" value="<?php echo htmlspecialchars($puntaje_jugador2); ?>">
                        </center>                    
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // ID de la partida en curso (lo obtienes desde PHP)
    const idPartida = "<?php echo $id_partida; ?>";
    const nombreJugador2 = "<?php echo $nombre_jugador2; ?>";
    const iniciarBtn = document.getElementById('iniciar-btn');
    const finalizarBtn = document.getElementById('finalizar-btn');

    // Carga inicial de la partida
    cargarPartida();

    // Cargar datos de la partida cada 5 segundos
    setInterval(cargarPartida, 5000); // Cambiar a 5000 ms para evitar carga excesiva

    function cargarPartida() {
        fetch(`actualizar_partida.php?id_partida=${idPartida}`)
            .then(response => response.json())
            .then(data => {
                if (!data.error) {
                    // Actualizar información del jugador 1
                    document.getElementById('puntaje_jugador1').value = data.puntaje_usuario1;
                    document.getElementById('nombre_jugador1').textContent = data.nombre_jugador1;
                    document.getElementById('icono_jugador1').src = data.icono1;
                    document.getElementById('faccion_jugador1').textContent = data.faccion1;
                    document.getElementById('subfaccion_jugador1').textContent = data.subfaccion1;

                    // Actualizar información del jugador 2
                    document.getElementById('puntaje_jugador2').value = data.puntaje_usuario2;
                    document.getElementById('nombre_jugador2').textContent = data.nombre_jugador2;
                    document.getElementById('icono_jugador2').src = data.icono2;
                    document.getElementById('faccion_jugador2').textContent = data.faccion2;
                    document.getElementById('subfaccion_jugador2').textContent = data.subfaccion2;

                    // Actualizar información del juego
                    document.getElementById('nombre_juego').textContent = data.nombre_juego;
                    document.getElementById('puntos').textContent = `${data.puntos} Pts.`;
                    document.getElementById('ronda').value = data.ronda;
                    document.getElementById('tiempo-transcurrido').textContent = data.tiempo_transcurrido;

                    // Actualizar cronómetro (hora de inicio)
                    actualizarCronometro(data.hora_inicio, 'tiempo-transcurrido');
                } else {
                    console.error(data.error);
                }
            })
            .catch(error => console.error('Error al cargar la partida:', error));
    }



    // Detectar cambios en los inputs de puntaje y actualizar la base de datos
    document.querySelector('input[name="puntaje_jugador1"]').addEventListener('change', function() {
        actualizarPuntaje(1, this.value);
    });

    document.querySelector('input[name="puntaje_jugador2"]').addEventListener('change', function() {
        actualizarPuntaje(2, this.value);
    });

    // Función para actualizar el puntaje del jugador en la base de datos
    function actualizarPuntaje(jugador, puntaje) {
        const formData = new FormData();
        formData.append('id_partida', idPartida);
        formData.append('jugador', jugador);
        formData.append('puntaje', puntaje);

        fetch('../public/actualizar_partida.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log(`Puntaje del jugador ${jugador} actualizado correctamente.`);
            } else {
                console.error('Error al actualizar el puntaje:', data.error);
            }
        })
        .catch(error => console.error('Error al actualizar el puntaje:', error));
    }

    document.querySelector('input[name="rondas"]').addEventListener('change', function () {
        actualizarRonda(this.value);
    });

    function actualizarRonda(ronda) {
        const formData = new FormData();
        formData.append('id_partida', idPartida);
        formData.append('ronda', ronda);

        fetch('../public/actualizar_partida.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Ronda actualizada correctamente.');
                } else {
                    console.error('Error al actualizar la ronda:', data.error);
                }
            })
            .catch(error => console.error('Error al actualizar la ronda:', error));
    }

    // Verificar el estado del botón constantemente cada segundo
    setInterval(verificarEstadoBoton, 1000);

    // Función para verificar el estado del botón
    function verificarEstadoBoton() {
        iniciarBtn.disabled = (nombreJugador2 === 'N/A');
    }

        // Al hacer clic en el botón de iniciar, cambiar el estado a 'en progreso'
    iniciarBtn.addEventListener('click', function (e) {
        e.preventDefault();
        actualizarEstadoPartida('en progreso');
    });

    // Función para actualizar el estado de la partida
    function actualizarEstadoPartida(nuevoEstado) {
        fetch('actualizar_estado.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id_partida: idPartida,
                estado: nuevoEstado,
                id_jugador1: nombre_jugador1,
                id_jugador2: nombreJugador2
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (nuevoEstado === 'en progreso') {
                    iniciarBtn.style.display = 'none'; // Ocultar botón de iniciar
                    finalizarBtn.style.display = 'inline-block'; // Mostrar botón de finalizar
                    alert('Partida en: PROGRESO');
                } else if (nuevoEstado === 'finalizado') {
                    finalizarBtn.disabled = true; // Deshabilitar el botón de finalizar
                    alert('La partida ha sido finalizada.');
                    window.location.href = 'matches.php'; // Redirigir al usuario a matches.php
                }
            } else {
                alert('Error al actualizar el estado de la partida.');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Al hacer clic en el botón de finalizar, mostrar confirmación antes de cambiar el estado
    finalizarBtn.addEventListener('click', function () {
        const confirmacion = confirm("¿Estás seguro de que deseas finalizar la partida?");
        if (confirmacion) {
            actualizarEstadoPartida('finalizado');
        }
    });
</script>



<script>
function confirmDelete() {
    return confirm("¿Estás seguro de que deseas borrar la partida?");
}
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
     <script>
        // Función para cargar las partidas en progreso
        function cargarPartidas() {
            $.ajax({
                url: 'matches.php',  // Archivo PHP que devuelve las partidas
                type: 'GET',         // Tipo de solicitud (GET)
                success: function(data) {
                    let partidasHtml = '';
                    data.forEach(function(partida) {
                        // Convertir la hora de inicio a un objeto Date
                        const horaInicio = new Date(partida.hora_inicio); 
                        const partidaId = `partida-${partida.id_partida}`; // ID único para cada cronómetro

                        // Crear el HTML para la partida y su cronómetro
                        partidasHtml += `<div>
                            <p>Partida: ${partida.nombre_usuario1} vs ${partida.nombre_usuario2} - Estado: ${partida.estado}</p>
                            <p>Tiempo transcurrido: <span id="${partidaId}"></span></p>
                        </div>`;

                        // Iniciar el cronómetro para cada partida
                        setInterval(function() {
                            actualizarCronometro(horaInicio, partidaId);
                        }, 1000); // Actualiza cada segundo
                    });

                    // Actualizar el contenido de la sección de partidas
                    $('#partidas-en-progreso').html(partidasHtml);
                },
                error: function(err) {
                    console.error('Error al cargar las partidas:', err);
                }
            });
        }

    </script>
</body>

</html>

