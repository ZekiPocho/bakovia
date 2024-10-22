<?php
// Incluir archivos necesarios
include 'db.php'; 
include '../src/validate_session.php';

// Manejar la publicación de un comentario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['comentar'])) {
        publicarComentario($conn);
    } elseif (isset($_POST['responder'])) {
        responderComentario($conn);
    }
}

// Función para publicar un comentario
function publicarComentario($conn) {
    $id_publicacion = $_POST['id_publicacion'];
    $id_usuario = $_SESSION['id_usuario'];
    $comentario = $conn->real_escape_string($_POST['comentario']);
    $fecha_comentario = date('Y-m-d H:i:s');

    // Insertar comentario en la base de datos
    $sql = "INSERT INTO comentarios (id_publicacion, id_usuario, comentario, fecha_comentario) 
            VALUES ('$id_publicacion', '$id_usuario', '$comentario', '$fecha_comentario')";

    if ($conn->query($sql)) {
        header("Location: blog-single-sidebar.php?id=$id_publicacion&success=1");
        exit(); 
    } else {
        echo "Error al agregar comentario: " . $conn->error;
    }
}

// Función para responder a un comentario
function responderComentario($conn) {
    $id_comentario_padre = $_POST['id_comentario_padre'];
    $id_usuario = $_SESSION['id_usuario']; 
    $respuesta = $conn->real_escape_string($_POST['respuesta']);
    $fecha_respuesta = date('Y-m-d H:i:s');
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
<html lang="zxx">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Publicación - Bakovia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logito.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/LineIcons.3.0.css" />
    <link rel="stylesheet" href="assets/css/tiny-slider.css" />
    <link rel="stylesheet" href="assets/css/glightbox.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span><span></span>
            </div>
        </div>
    </div>
    
    <!-- Header y Navbar -->
    <header class="header navbar-area">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="assets/images/logo/mini.png" alt="Logo" width="5">
                </a>
                <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="toggler-icon"></span><span class="toggler-icon"></span><span class="toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a aria-label="Toggle navigation" href="index.php">PRINCIPAL</a></li>
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#submenu-1-2" aria-controls="navbarSupportedContent" aria-expanded="false">TIENDA</a>
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
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#submenu-1-3" aria-controls="navbarSupportedContent" aria-expanded="false">CATEGORÍAS</a>
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
                <div class="navbar-cart">
                    <div class="cart-items">
                        <a href="javascript:void(0)" class="main-btn"><i class="lni lni-cart"></i><span class="total-items">0</span></a>
                    </div>
                </div>
                <div class="navbar-cart">
                    <div class="cart-items">
                        <a href="profile.php" class="main-btn"><i class="lni lni-user"></i></a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Start Blog Single Area -->
    <section class="section blog-single">
        <div class="container-sm">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="single-inner">
                        <div class="post-details">
                            <?php
                            // Consultar la publicación
                            if (isset($_GET['id'])) {
                                $id_publicacion = $_GET['id'];
                                $sql = "SELECT p.id_publicacion, p.titulo, p.contenido, p.imagen_publicacion, p.fecha_publicacion, p.tag, u.nombre_usuario, p.id_usuario 
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
                                    $id_usuario_publicacion = $publicacion['id_usuario'];
                                    $fecha = date("d M, Y", strtotime($publicacion['fecha_publicacion']));
                                    $tag = $publicacion['tag'];

                                    // Mostrar la publicación
                                    echo '
                                    <div class="main-content-head">
                                        <div class="post-thumbnils">
                                            <img src="'.$imagen.'" alt="#">
                                        </div>
                                        <div class="meta-information">
                                            <h2 class="post-title">'.$titulo.'</h2>
                                            <ul class="meta-info">
                                                <li><a href="javascript:void(0)"> <i class="lni lni-user"></i>'.$usuario.'</a></li>
                                                <li><a href="javascript:void(0)"><i class="lni lni-calendar"></i>'.$fecha.'</a></li>
                                                <li><a href="javascript:void(0)"><i class="lni lni-tag"></i>'.$tag.'</a></li>
                                            </ul>
                                        </div>
                                        <div class="detail-inner">
                                            <p>'.$contenido.'</p>
                                        </div>
                                    </div>';
                                } else {
                                    echo "<h4>No se encontró la publicación.</h4>";
                                }
                            }
                            ?>
                        </div>

                        <!-- Sección de Comentarios -->
                        <div class="comment-section">
                            <h3 class="comment-title">Comentarios</h3>
                            <?php
                            // Consultar comentarios
                            $sql_comentarios = "SELECT c.id_comentario, c.comentario, c.fecha_comentario, u.nombre_usuario, c.id_usuario, c.id_comentario_padre 
                                                FROM comentarios c
                                                JOIN usuarios u ON c.id_usuario = u.id_usuario
                                                WHERE c.id_publicacion = $id_publicacion
                                                ORDER BY c.fecha_comentario DESC";

                            $result_comentarios = $conn->query($sql_comentarios);
                            if ($result_comentarios->num_rows > 0) {
                                while ($comentario = $result_comentarios->fetch_assoc()) {
                                    $comentario_padre = $comentario['id_comentario_padre'] ? " (Respuesta a un comentario)" : "";
                                    echo '<div class="single-comment">
                                            <div class="comment-author">
                                                <h4 class="author-name">'.$comentario['nombre_usuario'].'</h4>
                                                <span class="comment-date">'.date("d M, Y H:i", strtotime($comentario['fecha_comentario'])).'</span>
                                            </div>
                                            <div class="comment-content">
                                                <p>'.$comentario['comentario'].'</p>
                                            </div>
                                            <div class="comment-reply">
                                                <button class="btn-reply" data-id="'.$comentario['id_comentario'].'">Responder</button>
                                            </div>
                                        </div>';
                                }
                            } else {
                                echo "<p>No hay comentarios aún.</p>";
                            }
                            ?>
                        </div>

                        <!-- Formulario para agregar un nuevo comentario -->
                        <div class="comment-form">
                            <h3 class="comment-title">Deja un Comentario</h3>
                            <form action="" method="POST">
                                <input type="hidden" name="id_publicacion" value="<?php echo $id_publicacion; ?>">
                                <textarea name="comentario" placeholder="Escribe tu comentario aquí..." required></textarea>
                                <button type="submit" name="comentar" class="btn">Comentar</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Blog Singel Area -->

    <!-- Start Footer Area -->
    <footer class="footer">
        <!-- Start Footer Middle -->
        <div class="footer-middle">
            <div class="container">
                <div class="bottom-inner">
                    <div class="row">
                        
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-contact">
                                <h3>¿QUIÉNES SOMOS?</h3>
                                <p class="phone">Phone: +1 (900) 33 169 7720</p>
                                <ul>
                                    <li><span>Monday-Friday: </span> 9.00 am - 8.00 pm</li>
                                    <li><span>Saturday: </span> 10.00 am - 6.00 pm</li>
                                </ul>
                                <p class="mail">
                                    <a href="mailto:support@shopgrids.com">support@shopgrids.com</a>
                                </p>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>CATEGORÍAS</h3>
                                <ul>
                                    <li><a href="javascript:void(0)">About Us</a></li>
                                    <li><a href="javascript:void(0)">Contact Us</a></li>
                                    <li><a href="javascript:void(0)">Downloads</a></li>
                                    <li><a href="javascript:void(0)">Sitemap</a></li>
                                    <li><a href="javascript:void(0)">FAQs Page</a></li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>INFORMACIÓN</h3>
                                <ul>
                                    <li><a href="javascript:void(0)">Computers & Accessories</a></li>
                                    <li><a href="javascript:void(0)">Smartphones & Tablets</a></li>
                                    <li><a href="javascript:void(0)">TV, Video & Audio</a></li>
                                    <li><a href="javascript:void(0)">Cameras, Photo & Video</a></li>
                                    <li><a href="javascript:void(0)">Headphones</a></li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                            
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
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