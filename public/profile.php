<?php
    require_once "../src/validate_session.php";
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
            <li class="nav-item"><a href="login.html">Login</a></li>
            <li class="nav-item"><a href="register.html">Register</a></li>
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
<div class="col-sm-auto"></div>
    <div class="navbar-cart">
        <div class="cart-items">
            <a href="login.html" class="main-btn">
                <i class="lni lni-user"></i>
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
                        <li><a href="index.html"><i class="lni lni-home"></i> INICIO</a></li>
                        <li>¿QUIÉNES SOMOS?</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    <br>
    <br>



    <div class="container-sm px-4">
        <div class="row">
            <div class="d-flex flex-wrap align-items-start">
                <div class="col-auto profile-img" >
                    <img src="https://via.placeholder.com/200" alt="Foto de perfil" class="profile-img">
                </div> 
                <a href="../src/logout.php">CERRAR SESIÓN</a>
                <div class="col-7 profile-info-name" >
                  <h2>Nombre de Usuario</h2>
                  <div class="bio">
                    <p class="text-muted">Esta es la biografía del usuario. Aquí puedes añadir más detalles sobre ti.
                        Esta es la biografía del usuario. Aquí puedes añadir más detalles sobre ti.Esta es la biografía del usuario.
                         Aquí puedes añadir más detalles sobre ti.Esta es la biografía del usuario. Aquí puedes añadir más detalles sobre ti.
                         Esta es la biografía del usuario. Aquí puedes añadir más detalles sobre ti.Esta es la biografía del usuario.
                         Aquí puedes añadir más detalles sobre ti.Esta es la biografía del usuario. Aquí puedes añadir más detalles
                         sobre ti.</p>
                  </div>
                </div>
                <div class="col profile-info mt-3 mt-md-0" style="margin-top: 20px" >
                    <h5>Información</h5>
                    <ul>
                        <li><p class="text-muted">AMOGUS</p></li>
                        <li><p class="text-muted">AMOGUS</p></li>
                        <li><p class="text-muted">AMOGUS</p></li>
                        <li><p class="text-muted">AMOGUS</p></li>
                        <li><p class="text-muted">AMOGUS</p></li>
                    </ul>
                    
                  </div>
              </div>
        </div>
        <!-- Divisiones personalizadas -->
  <div class="row mt-4">
    <!-- Primera columna (2 cuadros) -->
    <div class="col-md-8">
        <div class="profile-cards">
      <div class="card mb-3">
        <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Imagen 1">
        <div class="card-body">
            <h5 class="card-title">ARMY SHOWCASE</h5>
            <p class="card-text">Descripción breve de la sección 1.</p>
          </div>
      </div>
      <div class="card">
        
        <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Imagen 2">
        <div class="card-body">
            <h5 class="card-title">Título de Sección 2</h5>
            <p class="card-text">Descripción breve de la sección 2.</p>
          </div>
      </div>
        </div>
    </div>

    <!-- Segunda columna (1 cuadro más largo) -->
    <div class="col-md-4">
      <div class="card">
        <img src="https://via.placeholder.com/400x400" class="card-img-top" alt="Imagen 3">
        <div class="card-body">
          <h5 class="card-title">Título de Sección 3</h5>
          <p class="card-text">Descripción breve de la sección 3.</p>
        </div>
      </div>
    </div>
  </div>
</div>

      




    <!--
    <div class="profile">
    <div class="container-sm">
        <div class="row justify-content-center">
            <div class="col-3">
                    <div class="profile-image">
                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="content" alt="image" style="width: 16rem;">
                    </div>
            </div>
            <div class="col-lg-9">
                <div class="card" style="width: auto;" style="height: auto;">
                    <div class="card-body">
                        <h2 class="card-title">USUARIO</h2>
                        <h6 class="card-subtitle mb-2 text-muted">Bio</h6>
                        <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quidem consequatur
                         suscipit rerum ullam tempora explicabo, ipsum quas optio? Officia facilis, quibusdam
                          optio sed quae reprehenderit! Quibusdam nam nihil voluptate autem.
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quidem consequatur
                         suscipit rerum ullam tempora explicabo, ipsum quas optio? Officia facilis, quibusdam
                          optio sed quae reprehenderit! Quibusdam nam nihil voluptate autem.
                        </p>
                    </div>
                </div>
            </div>
            <div class="profile-info">
            <div class="container-sm">
                <div class="row">
                    <div class="col-7" ">
                     <div class="card" style="width: auto;" style="height: auto;"">
                        <div class="card-body">
                            <center><h4 class="card-title">ARMY SHOWCASE</h4></center>
                            <img src="https://i.ytimg.com/vi/oKQjZFkbhgU/maxresdefault.jpg" alt="image" height="100%" style="width: 15rem;">
                        </div>
                     </div>
                    </div>
                    <div class="col-5" >
                        <div class="card" style="width: auto;" style="height: auto;"">
                            <div class="card-body">
                                <center><h4 class="card-title">INFORMACIÓN</h4></center>
                            </div>
                         </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div> -->
    
    




















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
                                    <a href="index.html">
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