<?php

session_start();
if(isset($_SESSION['user'])){
    header("Location: ../public/index.php");
}
include "db.php";
$mensaje = "";
if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
    $email = $_COOKIE['email'];
    $password = $_COOKIE['password'];

    // Preparar una consulta segura con prepared statements
    $stmt = $conn->prepare("SELECT id_usuario, nombre_usuario, contrasena, correo, foto_perfil, 
                                   biografia, fecha_registro, verificado, army_showcase, army_desc, 
                                   rango_id, wins, loses, id_rol, token
                            FROM usuarios 
                            WHERE correo=? 
                              AND contrasena=?  
                              AND verificado='si'");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        // Obtener los datos del usuario
        $userData = $res->fetch_assoc();
        
        // Guardar los datos relevantes en la sesión
        $_SESSION['user'] = $userData['correo'];
        $_SESSION['nombre_usuario'] = $userData['nombre_usuario'];
        $_SESSION['id_usuario'] = $userData['id_usuario'];
        $_SESSION['foto_perfil'] = $userData['foto_perfil'];
        $_SESSION['biografia'] = $userData['biografia'] ?? null;
        $_SESSION['fecha_registro'] = $userData['fecha_registro'];
        $_SESSION['army_showcase'] = $userData['army_showcase'];
        $_SESSION['army_desc'] = $userData['army_desc'];
        $_SESSION['rango_id'] = $userData['rango_id'];
        $_SESSION['wins'] = $userData['wins'];
        $_SESSION['loses'] = $userData['loses'];
        $_SESSION['id_rol'] = $userData['id_rol'];
        $_SESSION['token'] = $userData['token'];

        // Redirigir a la página principal
        header("Location:../public/index.php");
        exit();
    } else {
        // Si no se encuentra el usuario, puedes gestionar el error aquí
        echo "Correo o contraseña inválidos, o cuenta no verificada.";
    }

    // Cerrar el statement
    $stmt->close();
}



// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Asegurarse de que las claves 'email' y 'clave' existan en el array $_POST
    if (isset($_POST['email']) && isset($_POST['clave'])) {
    
        $email = $_POST['email'];
        $password = $_POST['clave'];

        // Consulta SQL para verificar el correo y obtener el hash de la contraseña
        $stmt = $conn->prepare("SELECT id_usuario, nombre_usuario, contrasena, correo, foto_perfil, 
                                   biografia, fecha_registro, verificado, army_showcase, army_desc, 
                                   rango_id, wins, loses, id_rol, token
                            FROM usuarios 
                            WHERE correo=? 
                              AND verificado='si'");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res && mysqli_num_rows($res) > 0) {
            $userData = $res->fetch_assoc();
            
            // Verificar la contraseña con password_verify
            if (password_verify($password, $userData['contrasena'])) {
                $_SESSION['user'] = $userData['correo'];
                $_SESSION['nombre_usuario'] = $userData['nombre_usuario'];
                $_SESSION['id_usuario'] = $userData['id_usuario'];
                $_SESSION['foto_perfil'] = $userData['foto_perfil'];
                $_SESSION['biografia'] = $userData['biografia'] ?? null;
                $_SESSION['fecha_registro'] = $userData['fecha_registro'];
                $_SESSION['army_showcase'] = $userData['army_showcase'];
                $_SESSION['army_desc'] = $userData['army_desc'];
                $_SESSION['rango_id'] = $userData['rango_id'];
                $_SESSION['wins'] = $userData['wins'];
                $_SESSION['loses'] = $userData['loses'];
                $_SESSION['id_rol'] = $userData['id_rol'];
                $_SESSION['token'] = $userData['token'];

                if (isset($_POST['remember'])) {
                    // Generar cookies con duración de 30 días
                    setcookie('email', $email, time() + (86400 * 30), "/"); // 86400 = 1 día
                    setcookie('password', $userData['contrasena'], time() + (86400 * 30), "/");
                }
                
                // Redirigir al usuario a la página principal
                header("Location:../public/index.php");
                exit();
            } else {
                $mensaje = "<div class='alert alert-danger'>El correo o la contraseña es incorrecto</div>";
            }
        } else {
            $mensaje = "<div class='alert alert-danger'>El correo o la contraseña es incorrecto</div>";
        }
    } else {
        $mensaje = "<div class='alert alert-danger'>Faltan datos en el formulario</div>";
    }
}


?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Iniciar Sesión - Bakovia</title>
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

    <!-- Start Account Login Area -->
    <div class="account-login section">

            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" action="login.php" method="post">
                        <div class="card-body">
                            <div class="title">
                                <center>
                                <h3>Iniciar Sesión </h3>
                                <?php
                                echo $mensaje;
                                ?>
                            </center>
                            </div>
                            <div class="form-group input-group">
                                <label for="reg-fn">Correo Electrónico</label>
                                <input class="form-control" type="email" name="email" id="reg-email" required>
                            </div>
                            <div class="form-group input-group">
                                <label for="reg-fn">Contraseña</label>
                                <input class="form-control" name="clave" type="password" id="reg-pass" required>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between bottom-content">
                                <div class="form-check">
                                    <input type="checkbox" name="remember" class="form-check-input width-auto" id="exampleCheck1">
                                    <label class="form-check-label">Recuérdame</label>
                                </div>
                            </div>
                            
                                <div class="button">
                                    <button class="btn" type="submit" name="iniciar">Iniciar Sesión</button>
                                </div>
                                    
                                <p class="outer-link">¿Eres nuevo por acá? <a href="register.php">Regístrate aquí </a>
                                </p>
                            
                        </div>
                            
                    </form>
                </div>
            </div>

    </div>



    <!-- End Account Login Area -->

    <!-- ========================= JS here ========================= -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/glightbox.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>