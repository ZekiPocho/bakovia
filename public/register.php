<?php 
session_start();
if (isset($_SESSION['user'])) {
    header("Location: ../public/profile.php");
    exit(); // Detener la ejecución para evitar que continúe cargando
}

include "db.php"; // Asegúrate de que no haya espacios antes de esta línea

$mensaje = "";

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['clave']) && isset($_POST['clave2'])) {
    if ($_POST['clave'] == $_POST['clave2']) {
        $name = $_POST['username'];
        $email = $_POST['email'];
        $pass = sha1($_POST['clave']);

        // Verificar si el correo o el nombre de usuario ya existen y si la cuenta está verificada
        $checkUserQuery = $conn->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ? OR correo = ?");
        $checkUserQuery->bind_param("ss", $name, $email);
        $checkUserQuery->execute();
        $result = $checkUserQuery->get_result();

        if ($result->num_rows > 0) {
            $userData = $result->fetch_assoc();
            if ($userData['verificado'] === 'no') {
                // Si la cuenta existe pero no está verificada
                $mensaje = "<div class='alert alert-warning'>Ya tienes una cuenta registrada, pero necesita ser verificada. Por favor, revisa tu correo electrónico para completarlo.</div>";
            } else {
                // Si la cuenta ya existe y está verificada
                $mensaje = "<div class='alert alert-danger'>El nombre de usuario o correo ya está en uso. Por favor, elige otro.</div>";
            }
        } else {
            // Incluir el archivo para enviar el correo solo si no hay errores
            include "mail_msg.php";

            if ($enviado) {
                // Inserción en la base de datos si el correo fue enviado
                $conn->query("INSERT INTO usuarios (nombre_usuario, correo, contrasena, verificado, token) 
                              VALUES ('$name', '$email', '$pass', 'no', '$codigo')") 
                              or die($conn->error);
                
                // Redirigir a la página de confirmación
                header("Location: ./sent.html");
                exit(); // Asegúrate de detener la ejecución después del header
            } else {
                $mensaje = "Error al enviar el Email, intente nuevamente";
            }
        }
    } else {
        $mensaje = "<div class='alert alert-danger'>Las contraseñas no coinciden</div>";
    }
}
?>


<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Registro - Bakovia</title>
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



    <!-- Start Account Register Area -->
    <div class="account-login section">
        <div class="container-sm-register-login">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="register-form">
                        <div class="title">
                            <center>
                            <h3>Registro</h3>
                            <p>Llena el formulario para ingresar al Bunker</p>
                            <?php
                            echo $mensaje;
                            ?>
                        </center>
                        </div>
                        <form class="row" action="register.php" method="post" enctype="multipart/form-data">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-fn">Nombre de Usuario</label>
                                    <input class="form-control" type="text" name="username" id="reg-fn" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-email">Correo Electrónico </label>
                                    <input class="form-control" type="email" name="email" id="reg-email" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-pass">Contraseña</label>
                                    <input class="form-control" type="password" name="clave" id="reg-pass" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-pass">Confirme su Contraseña</label>
                                    <input class="form-control" type="password" name="clave2" id="reg-pass" required>
                                </div>
                            </div>
                            <div class="button">
                                <button class="btn" name="registrar "type="submit">Registrarse</button>
                            </div>
                            <p class="outer-link">¿Ya eres un ciudadano? <a href="login.php"> Inicia Sesión Aquí</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Register Area -->



    <!-- ========================= JS here ========================= -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/glightbox.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>