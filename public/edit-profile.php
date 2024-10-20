<?php
    require_once "../src/validate_session.php";
    include "db.php";
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Editar Perfil    - Bakovia</title>
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
                        <h1 class="page-title">EDITAR PERFIL</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.html"><i class="lni lni-home"></i> INICIO</a></li>
                        <li><a href="profile.php">PERFIL</a></li>
                        <li>EDITAR PERFIL</li>
                    </ul>
                </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
<br>

<div class="container-sm px-4">
    <div class="row justify-content-between align-items-center mb-4">
        <div class="col-md-12 text-end">
            <input type="submit" form="profileForm" value="Guardar cambios" class="btn btn-primary">
        </div>
    </div>

    <!-- Formulario para editar perfil -->
    <form id="profileForm" action="profile.php" method="POST" enctype="multipart/form-data">
        <div class="row justify-content-center align-items-center">
            <!-- Foto de perfil -->
            <div class="col-md-4 text-center mb-4">
                <div class="d-flex justify-content-center">
                    <div class="profile-image-container" style="width: 200px; height: 200px; overflow: hidden; border-radius: 5px; position: relative;">
                        <input type="file" id="profileImage" name="profileImage" class="form-control" accept="image/*" onchange="handleProfileImage(event)" style="display: none;">
                        <img src="<?php echo $_SESSION['foto_perfil'] ?? '../uploads/user/default.png'; ?>" alt="Foto de perfil" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;" id="profilePreview" onclick="document.getElementById('profileImage').click();">
                    </div>
                </div>
                <p class="mt-2" style="filter: opacity(50%);">Haz clic en la imagen para cambiar la foto de perfil</p>
            </div>

            <!-- Nombre de usuario y biografía -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="username" class="form-label" style="filter: opacity(50%);">Nombre de Usuario</label>
                    <input type="text" id="username" name="username" class="form-control" style="background-color: #171D25; border: solid 2px #6E869D; color: white;" value="<?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?>">
                </div>

                <div class="mb-3">
                    <label for="bio" class="form-label" style="filter: opacity(50%);">Biografía</label>
                    <textarea id="bio" name="bio" class="form-control" maxlength="640" rows="3" style="background-color: #171D25; border: solid 2px #6E869D; color: white;" placeholder="Escribe un poco acerca de ti."><?php echo htmlspecialchars($_SESSION['biografia']); ?></textarea>
                </div>
            </div>
        </div>

        <!-- ARMY SHOWCASE -->
        <div class="row mt-2 justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center">ARMY SHOWCASE</h2>
                <div class="card mb-3 text-center" style="background-color: #171D25; border: solid 2px #6E869D; padding: 15px;">
                    <p class="mt-2" style="filter: opacity(50%);">¡Aquí puedes exhibir uno de tus ejercitos! Si deseas, añade una descripción y cuenta la historia de tus personajes...</p>
                    <input type="file" id="armyShowcaseImage" name="armyShowcaseImage" class="form-control" accept="image/*" onchange="handleArmyShowcaseImage(event)" style="display: none;">
                    
                    <!-- Contenedor de imagen de ARMY SHOWCASE -->
                    <div class="army-image-container" style="width: 100%; height: 400px; overflow: hidden; border-radius: 5px; position: relative; margin: 0 auto;">
                        <img src="<?php echo $_SESSION['army_showcase'] ?? 'https://via.placeholder.com/1900x1100'; ?>" class="card-img-top mt-3" alt="Imagen ARMY SHOWCASE" id="armyImagePreview" onclick="document.getElementById('armyShowcaseImage').click();" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    
                    <p class="mt-2" style="filter: opacity(50%);">Haz clic en la imagen para cambiar el ARMY SHOWCASE</p>
                    <div class="card-body">
                        <textarea id="description1" name="description1" class="form-control" maxlength="640" rows="5" placeholder="Descripción" style="background-color: #171D25; border: solid 2px #6E869D; color: white;"><?php echo htmlspecialchars($_SESSION['army_desc'] ?? ''); ?></textarea>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

<!-- Scripts para previsualización de imagen -->
<script>
    // Funciones JavaScript como en el código original
</script>

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