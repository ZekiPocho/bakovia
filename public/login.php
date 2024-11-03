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
        $password = password_hash($_POST['clave'], PASSWORD_DEFAULT);

        // Consulta SQL para verificar el correo y la contraseña
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
        if ($res && mysqli_num_rows($res) > 0) {
            $userData = $res->fetch_assoc();
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
                setcookie('password', $password, time() + (86400 * 30), "/");
            }
            
            // Redirigir al usuario a la página principal
            header("Location:../public/index.php");
            exit();
        } else {
            $mensaje="<div class='alert alert-danger'>El correo o la contraseña es incorrecto</div>";
        }
    } else {
        $mensaje= "<div class='alert alert-danger'>Faltan datos en el formulario</div>";
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