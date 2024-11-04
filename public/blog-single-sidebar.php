
<?php
// Verificar si el usuario autenticado es el autor del comentario
include 'db.php'; 
session_start();

// Verificar si se ha enviado el comentario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comentar'])) {
    $id_publicacion = $_POST['id_publicacion'];
    $id_usuario = $_SESSION['id_usuario'];
    $comentario = $conn->real_escape_string($_POST['comentario']);
    $fecha_comentario = date('Y-m-d H:i:s');

    // Inserta el comentario
    $sql = "INSERT INTO comentarios (id_publicacion, id_usuario, comentario, fecha_comentario) 
            VALUES ('$id_publicacion', '$id_usuario', '$comentario', '$fecha_comentario')";

    if ($conn->query($sql)) {
        header("Location: blog-single-sidebar.php?id=$id_publicacion&success=1");
        exit(); 
    } else {
        echo "Error al agregar comentario: " . $conn->error;
    }
}

    if (isset($_POST['responder'])) {
        $id_comentario_padre = $_POST['id_comentario_padre'];
        $id_usuario = $_SESSION['id_usuario']; 
        $respuesta = $conn->real_escape_string($_POST['respuesta']);
        $fecha_respuesta = date('Y-m-d H:i:s');
        
        // Falta definir id_publicacion para las respuestas
        $id_publicacion = $_POST['id_publicacion']; // Asegúrate de que id_publicacion esté en el POST
    
        $sql = "INSERT INTO comentarios (id_publicacion, id_usuario, comentario, fecha_comentario, id_comentario_padre)
                VALUES ('$id_publicacion', '$id_usuario', '$respuesta', '$fecha_respuesta', '$id_comentario_padre')";
    
        if ($conn->query($sql)) {
            echo "Respuesta agregada correctamente.";
        } else {
            echo "Error al agregar respuesta: " . $conn->error;
        }
    }
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Publicación - Bakovia</title>
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

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->

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
                        <h1 class="page-title">POST</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.php"><i class="lni lni-home"></i> INICIO</a></li>
                        <li><a href="blog-grid-sidebar.php">PUBLICACIONES</a></li>
                        <li>POST</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Blog Singel Area -->
    <section class="section blog-single">
    <div class="container-sm">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8 col-12">
                <div class="single-inner">
                    <div class="post-details">
                        <?php
                        // Obtener la publicación por ID
                        if (isset($_GET['id'])) {
                            $id_publicacion = $_GET['id'];
                            $sql = "SELECT p.id_publicacion, p.titulo, p.contenido, p.imagen_publicacion, 
                                            p.fecha_publicacion, p.tag, u.nombre_usuario, p.id_usuario 
                                    FROM publicaciones p
                                    JOIN usuarios u ON p.id_usuario = u.id_usuario
                                    WHERE p.id_publicacion = $id_publicacion";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $publicacion = $result->fetch_assoc();
                                $titulo = $publicacion['titulo'];
                                $contenido = $publicacion['contenido'];
                                $imagen = !empty($publicacion['imagen_publicacion']) ? $publicacion['imagen_publicacion'] : 'https://via.placeholder.com/850x460';
                                $usuario = $publicacion['nombre_usuario'];
                                $fecha = date("d M, Y", strtotime($publicacion['fecha_publicacion']));
                                $tag = $publicacion['tag'];
                                $id_usuario_publicacion = $publicacion['id_usuario'];

                                // Mostrar la publicación
                                echo '
                                <div class="main-content-head">
                                    <div class="meta-information">
                                        <ul class="meta-info">
                                            <li style="color: white"><a href="user_profile.php?usuario=' . urlencode($usuario) . '">' . htmlspecialchars($usuario) . '</a></li>    
                                            <li style="color: gray">'. $fecha .'</li>
                                        </ul>
                                        <h3 class="post-title">' . $titulo . '</h3>
                                        <ul class="meta-info">
                                            <li><a href="blog-grid-sidebar.php?filtro=' . urlencode($tag) . '">
                                        <i class="lni lni-tag"></i>' . htmlspecialchars($tag) . '
                                    </a></li>
                                        </ul>
                                        
                                    </div>
                                    
                                    <div class="post-thumbnils text-center">
                                        <img src="' . $imagen . '" alt="#" class="img-fluid rounded">
                                    </div>
                                    
                                    <div class="detail-inner">
                                    <br>
                                        ' . $contenido . '
                                    </div>';

                                // Mostrar el botón de "Eliminar" si el usuario autenticado es el autor de la publicación
                                if (isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] == $id_usuario_publicacion) {
                                    echo '
                                    <form action="delete_publication.php" method="POST" onsubmit="return confirm(\'¿Estás seguro de que deseas eliminar esta publicación?\');" style="border-top: solid 2px #6E869D;">
                                        <input type="hidden" name="id_publicacion" value="' . $id_publicacion . '">
                                        <button type="submit" class="btn btn-danger" style="margin: 10px;">Eliminar publicación</button>
                                    </form>';
                                }

                                echo '</div>';
                            } else {
                                echo "<p>Publicación no encontrada.</p>";
                            }
                        } else {
                            echo "<p>No se ha proporcionado un ID de publicación.</p>";
                        }
                        ?>
                    </div>

                    <!-- Comments Section -->
                    <div class="post-comments">
                        <h3 class="comment-title"><span>Comentarios (últimos primero)</span></h3>
                        <ul class="comments-list">
                        <?php
                        // Verificar si se ha enviado el comentario
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comentar'])) {
                            $id_publicacion = $_POST['id_publicacion'];
                            $id_usuario = $_SESSION['id_usuario'];
                            $comentario = $conn->real_escape_string($_POST['comentario']);
                            $fecha_comentario = date('Y-m-d H:i:s');

                            // Inserta el comentario
                            $sql = "INSERT INTO comentarios (id_publicacion, id_usuario, comentario, fecha_comentario) 
                                    VALUES ('$id_publicacion', '$id_usuario', '$comentario', '$fecha_comentario')";

                            if ($conn->query($sql)) {
                                echo "<p>Comentario agregado correctamente.</p>";
                            } else {
                                echo "Error al agregar comentario: " . $conn->error;
                            }
                        }

                        // Ver comentarios de la publicación
                        $sql_comentarios = "SELECT c.*, u.nombre_usuario, u.foto_perfil 
                                            FROM comentarios c
                                            JOIN usuarios u ON c.id_usuario = u.id_usuario
                                            WHERE c.id_publicacion = $id_publicacion
                                            ORDER BY c.fecha_comentario DESC";

                        $result_comentarios = $conn->query($sql_comentarios);

                        // Mostrar los comentarios
                        if ($result_comentarios->num_rows > 0) {
                            while ($comentario = $result_comentarios->fetch_assoc()) {
                                $nombre_usuario = $comentario['nombre_usuario'];
                                $fecha_comentario = date("d M, Y", strtotime($comentario['fecha_comentario']));
                                $texto_comentario = $comentario['comentario'];
                                $foto_perfil = !empty($comentario['foto_perfil']) ? $comentario['foto_perfil'] : 'https://via.placeholder.com/150';
                                $id_comentario = $comentario['id_comentario'];
                                $id_usuario_comentario = $comentario['id_usuario'];

                                echo '
                                <li class="comment-item">
                                    <div class="comment-img">
                                        <img src="' . $foto_perfil . '" alt="img" style="border-radius: 5px; border: solid 1px #6E869D">
                                    </div>
                                    <div class="comment-desc">
                                        <div class="desc-top">
                                            <a style="color: white;" href="user_profile.php?usuario=' . urlencode($nombre_usuario) . '">' . htmlspecialchars($nombre_usuario) . '</a>
                                            <span style="color: gray;">' . $fecha_comentario . '</span>
                                        </div>
                                        <p>' . $texto_comentario . '</p>';

                                // Mostrar el botón de eliminar si el usuario autenticado es el autor del comentario

                                if (isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] == $id_usuario_comentario) {
                                    echo '
                                    <div style="text-align: right;">
                                        <form action="delete_comment.php" method="POST" onsubmit="return confirm(\'¿Estás seguro de que deseas eliminar este comentario?\');">
                                            <input type="hidden" name="id_comentario" value="' . $id_comentario . '">
                                            <input type="hidden" name="id_publicacion" value="' . $id_publicacion . '">
                                            <button type="submit" class="btn btn-secondary btn-sm" style="border: none; background-color: transparent; color: #6c757d; padding: 0; text-decoration: underline;">Eliminar comentario</button>
                                        </form>
                                    </div>';
                                }
                                


                                echo '</div></li>';
                            }
                        } else {
                            echo "<p style='color:gray;'>No hay comentarios aún. ¡Pero tú puedes ser el primero!</p>";
                        }

                        $conn->close();
                        ?>
                        </ul>
                    </div>

                    <!-- Comment Form -->
                    <?php if (isset($_SESSION['id_usuario'])): ?>
                        <div class="comment-form">
                            <h3 >Deja un comentario</h3>
                            <form action="" method="POST">
                                <input type="hidden" name="id_publicacion" value="<?php echo $id_publicacion; ?>">
                                <div class="form-group">
                                    <textarea name="comentario" class="form-control" placeholder="Tu comentario" required></textarea>
                                </div>
                                <br>
                                <div class="button">
                                    <button type="submit" name="comentar" class="btn btn-primary">Publicar comentario</button>
                                </div>
                            </form>
                        </div>
                    <?php else: ?>
                        <div class="comment-form">
                            <h3 class="comment-reply-title">Deja un comentario</h3>
                            <p class="text-muted">Por favor, <a href="login.php">inicia sesión</a> o <a href="register.php">regístrate</a> para poder publicar un comentario.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- End Blog Singel Area -->
<br>
<br>
    <!-- Start Footer Area -->
    <footer class="footer" style="border-top: solid 5px #6E869D;">
        <!-- Start Footer Middle -->
        <div class="footer-middle">
            <div class="container">
                <div class="bottom-inner">
                    <div class="row">
                        
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-contact">
                                <h3>¿QUIÉNES SOMOS?</h3>
                                Bakovia nace del cariño y las ganas de compartir el hobby que amamos: ¡Warhammer! 
                                Deja el mundo atrás, entra al Bunker y aléjate de la maldad del mundo.
                                
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>PÁGINAS</h3>
                                <ul>
                                    <li><a href="matches.php">Partidas</a></li>
                                    <li><a href="blog-grid-sidebar.php">Publicaciones</a></li>
                                    <li><a href="about-us.php">¿Quiénes Somos?</a></li>
                                    <li><a href="faq.php">Preguntas Frecuentes</a></li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>INFORMACIÓN</h3>
                                Nos encontramos en la avenida Arce, edificio Santa Isabel Nº 2529.
                                Atendemos de lunes a viernes, desde las 16:00 hasta las 21:00,
                                 y los sábados de 13:00 a 18:00.
                            </div>
                            <!-- End Single Widget -->
                            
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mt-5">
                            <!--Single Widget-->
                            <div class="footer-logo">
                                    <a href="index.php">
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
</body>

</html>