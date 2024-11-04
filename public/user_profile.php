<?php
    include "db.php";
// Iniciar la sesión
session_start();

// Verificar si el nombre de usuario de la sesión y el parámetro GET existen
if (isset($_SESSION['nombre_usuario']) && isset($_GET['usuario'])) {
    $nombreUsuarioSesion = $_SESSION['nombre_usuario'];
    $nombreUsuarioGET = $_GET['usuario'];

    // Verificar si los datos son idénticos
    if ($nombreUsuarioGET === $nombreUsuarioSesion) {
        // Redirigir a profile.php si son idénticos
        header("Location: profile.php");
        exit();
    } 
    // Si no son idénticos, permite el acceso al contenido de la página
} else {
    // Mensaje o acción si la sesión o el parámetro GET no están definidos
    echo "<p>Error: Sesión no iniciada o nombre de usuario no proporcionado.</p>";
}

?>
<!DOCTYPE html>

<html class="no-js" lang="zxx">  
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Perfil    - Bakovia</title>
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=logout" />
    <style>
    .medal-image {
    width: 100px;
    height: 100px;
    
    transition: transform 0.3s ease-in-out, filter 0.3s ease-in-out;
}

   .medal-image:hover {
        transform: scale(1.1);
        -webkit-filter: drop-shadow(10px 10px 10px black);
        filter: drop-shadow(10px 10px 10px black);
    }


    </style>
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

<!--HEADER Y NAVBAR PRO-->
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
      <a aria-label="Toggle navigation" href="index.php">PRINCIPAL</a>
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

<!--PERFIL-->
<div class="col-sm-auto">
    <div class="navbar-nav">
        <div class="nav-item">
            <a aria-label="Toggle navigation" href="logout.php">
            
            </a>
        </div>
    </div>
</div>
</div>
</nav>
</header>
<!--TERMINA HEADER Y NAVBAR PRO-->

    <!-- Start Breadcrumbs
    <div class="breadcrumbs">
        <div class="container-sm">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">¿QUIÉNES SOMOS?</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.php"><i class="lni lni-home"></i> INICIO</a></li>
                        <li>¿QUIÉNES SOMOS?</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    <br>
    <br>
    <?php
    
    if (isset($_GET['usuario'])) {
    
        // Consulta SQL para verificar el correo y obtener el hash de la contraseña
        $stmt = $conn->prepare("SELECT id_usuario, nombre_usuario, contrasena, correo, foto_perfil, 
                                   biografia, fecha_registro, verificado, army_showcase, army_desc, 
                                   rango_id, wins, loses, id_rol, token
                            FROM usuarios 
                            WHERE nombre_usuario=? ");
        $stmt->bind_param("s", $_GET['usuario']);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res && mysqli_num_rows($res) > 0) {
            $userData = $res->fetch_assoc();
            
            $mail = $userData['correo'];
            $nombre = $userData['nombre_usuario'];
            $id = $userData['id_usuario'];
            $foto_perfil = $userData['foto_perfil'];
            $bio = $userData['biografia'] ?? null;
            $registro = $userData['fecha_registro'];
            $army = $userData['army_showcase'];
            $army_desc = $userData['army_desc'];
            $rango = $userData['rango_id'];
            $wins = $userData['wins'];
            $loses = $userData['loses'];
            $id_rol = $userData['id_rol'];
            $token = $userData['token'];
        }        
    }
    ?>
    <div class="container-sm p-3">
    <div class="row">
        <div class="d-flex flex-wrap align-items-start">
            <div class="col-auto profile-img">
                <img src="<?php echo $foto_perfil ?? 'https://via.placeholder.com/200'; ?>" alt="Foto de perfil" class="profile-img" loading="lazy">
            </div>

            <div class="col-7 profile-info-name">
                <a href="edit-profile.php" style="text-decoration: none;"
                   onmouseover="this.style.textDecoration='underline';"
                   onmouseout="this.style.textDecoration='none';">
                    <h2><?php echo htmlspecialchars("$nombre"); ?>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#ffffff" xmlns="http://www.w3.org/2000/svg" transform="rotate(0 0 0)">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.3028 3.7801C18.4241 2.90142 16.9995 2.90142 16.1208 3.7801L14.3498 5.5511C14.3442 5.55633 14.3387 5.56166 14.3333 5.5671C14.3279 5.57253 14.3225 5.57803 14.3173 5.58359L5.83373 14.0672C5.57259 14.3283 5.37974 14.6497 5.27221 15.003L4.05205 19.0121C3.9714 19.2771 4.04336 19.565 4.23922 19.7608C4.43508 19.9567 4.72294 20.0287 4.98792 19.948L8.99703 18.7279C9.35035 18.6203 9.67176 18.4275 9.93291 18.1663L20.22 7.87928C21.0986 7.0006 21.0986 5.57598 20.22 4.6973L19.3028 3.7801ZM14.8639 7.15833L6.89439 15.1278C6.80735 15.2149 6.74306 15.322 6.70722 15.4398L5.8965 18.1036L8.56029 17.2928C8.67806 17.257 8.7852 17.1927 8.87225 17.1057L16.8417 9.13619L14.8639 7.15833ZM17.9024 8.07553L19.1593 6.81862C19.4522 6.52572 19.4522 6.05085 19.1593 5.75796L18.2421 4.84076C17.9492 4.54787 17.4743 4.54787 17.1814 4.84076L15.9245 6.09767L17.9024 8.07553Z" fill="#ffffff"/>
                        </svg>
                    </h2>
                </a>
                <div class="bio">
                    <p class="text-muted"><?php echo htmlspecialchars($bio); ?></p>
                </div>
                <?php
                if (isset($id)) {
                    $user_id = $id;
                
                    // Consulta para obtener el rango_id del usuario
                    $query = "SELECT rango_id FROM usuarios WHERE id_usuario = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $stmt->bind_result($rango_id);
                    $stmt->fetch();
                    $stmt->close();
                
                    // Si se encuentra el rango_id, buscar la información del rango
                    if ($rango_id) {
                        $query_rango = "SELECT nombre_rango, medalla_imagen FROM rangos WHERE id = ?";
                        $stmt_rango = $conn->prepare($query_rango);
                        $stmt_rango->bind_param("i", $rango_id);
                        $stmt_rango->execute();
                        $stmt_rango->bind_result($nombre_rango, $imagen_rango);
                        $stmt_rango->fetch();
                        $stmt_rango->close();
                
                        // Guardar la información en las variables de sesión
                        $rango = $imagen_rango;
                        $nombre_rango = $nombre_rango;
                    }
                }
                ?>
            </div>
                <div class="col profile-info mt-3 mt-md-0" style="margin-top: 20px">
                    <ul>
                    <center>
                        <li><p>RANGO</p></li>
                        <div class="medal-container">
                            <img class="medal-image" src="<?php echo $rango ?? 'https://via.placeholder.com/500'; ?>" alt="rango">
                        </div>
                        <li style="text-decoration: underline;"><p><?php echo htmlspecialchars($nombre_rango ?? 'Nombre de rango'); ?></p></li>
                        <li><p class="text-muted">MIEMBRO DESDE</p></li>
                        <li><p class="text-muted"><?php echo htmlspecialchars($registro); ?></p></li>
                    </center>
                    </ul>
                </div>
        </div>
    </div>
    <!-- ARMY SHOWCASE -->
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="profile-cards">
                <div class="card mb-3 p-3">
                    <center><h5 class="card-title">ARMY SHOWCASE</h5></center>
                    <img src="<?php echo $army ?? '../uploads/army/placeholder.png'; ?>" class="card-img-top" alt="Imagen ARMY SHOWCASE" style="max-width: 800px;max-height: 400px;object-fit: cover;border: solid 2px;border-radius: 5px;" loading="lazy">
                    <div class="card-body">
                        <p class="card-text"><?php echo htmlspecialchars($army_desc ?? 'Descripción breve de tu Showcase.'); ?></p>
                    </div>
                </div>
                <div class="card p-3">
                    
                <div class="card-body">
    <center><h5 class="card-title">PUBLICACIONES</h5></center>
    <div class="row">
        <?php
        $id_usuario = $id;
        $query = $conn->prepare("SELECT * FROM publicaciones WHERE id_usuario = ?");
        $query->bind_param("i", $id_usuario);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            // Generar el HTML para cada publicación
            while ($row = $result->fetch_assoc()) {
                $id_publicacion = $row['id_publicacion'];
                $titulo = $row['titulo'];
                $imagen = !empty($row['imagen_publicacion']) ? $row['imagen_publicacion'] : 'https://via.placeholder.com/370x215'; // Placeholder si no hay imagen
                $tag = $row['tag'];

                echo '
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card h-100">
                        <img src="'.$imagen.'" class="card-img-top" alt="Imagen de la publicación" style="height: 215px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><a href="blog-single-sidebar.php?id='.$id_publicacion.'">'.(strlen($titulo) > 75 ? substr($titulo, 0, 75) . '...' : $titulo).'</a></h5>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<div class="col-12"><p class="text-center">No hay publicaciones disponibles.</p></div>';
        }
        ?>
    </div>
</div>

                </div>
            </div>
        </div>

        <!-- Segunda columna (1 cuadro más largo) -->
        <div class="col-md-4">
            <div class="card">
                <img src="<?php echo $_SESSION['tercera_imagen'] ?? 'https://via.placeholder.com/400x400'; ?>" class="card-img-top" alt="Imagen 3">
                <div class="card-body">
                    <h5 class="card-title">Título de Sección 3</h5>
                    <p class="card-text">Descripción breve de la sección 3.</p>
                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>