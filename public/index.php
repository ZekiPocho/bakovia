<?php
include ('db.php');
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Principal - Bakovia</title>
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

    <style>
        .search-dropdown {
            position: absolute;
            background-color: white;
            border: 1px solid #ccc;
            max-height: 150px; /* Reduce la altura máxima */
            overflow-y: auto; /* Permite desplazamiento si es necesario */
            width: 20%; /* Mantiene el ancho al 100% del contenedor */
            z-index: 1000;
            padding: 5px; /* Reduce el padding */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Agrega una sombra sutil */
        }

        .search-dropdown h5 {
            margin: 0;
            font-size: 14px; /* Reduce el tamaño de fuente */
        }

        .search-dropdown ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .search-dropdown ul li {
            padding: 3px 0; /* Reduce el padding de los elementos de la lista */
        }

        .search-dropdown ul li a {
            text-decoration: none;
            color: #333; /* Color del texto */
            font-size: 12px; /* Tamaño de fuente más pequeño */
        }

        .search-dropdown ul li a:hover {
            color: #ff9800; /* Color al pasar el mouse */
        }

        .navbar-search {
    position: relative; /* Asegúrate de que el contenedor sea relativo */
}

.search-dropdown {
    position: absolute; /* Mantén la posición absoluta para que se alinee correctamente */
    top: 100%; /* Alinea el menú desplegable justo debajo del campo de búsqueda */
    left: 0; /* Alinea a la izquierda del contenedor */
    background-color: #171D25;
    border: 1px solid #6E869D;
    max-height: 150px; /* Reduce la altura máxima */
    overflow-y: auto; /* Permite desplazamiento si es necesario */
    width: 100%; /* Ajusta el ancho al 100% del contenedor */
    z-index: 1000;
    padding: 5px; /* Reduce el padding */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Agrega una sombra sutil */
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
      <a class="active" aria-label="Toggle navigation" href="index.php">PRINCIPAL</a>
    </li>
    <li class="nav-item">
        <a class="nav-link dropdown-toggle" href="product-grids.php"
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
            <input id="search-input" class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
        </div>
        <div class="search-btn">
            <button type="button"><i class="lni lni-search-alt"></i></button>
        </div>
    </div>
    <!-- Aquí se muestra el dropdown de búsqueda -->
    <div id="search-dropdown" class="search-dropdown" style="display: none;"></div>
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
</nav>
</header>
<!--TERMINA HEADER Y NAVBAR PRO-->


    <!-- Start Hero Area -->
    <section class="hero-area">
        <div class="container-sm">
            <div class="row">
                <div class="col-lg-8 col-12 custom-padding-right">
                    <div class="slider-head">
                        <!-- Start Hero Slider -->
                        <div class="hero-slider">
                            <!-- Start Single Slider -->
                            <div class="single-slider"
                                style="background-image: url(assets/images/hero/hero.png);">
                                <div class="content">
                                    <p></p>
                                    <!--<div class="button">
                                        <a href="product-grids.php" class="btn">Shop Now</a>
                                    </div>-->
                                </div>
                            </div>
                            <!-- End Single Slider -->
                            <!-- Start Single Slider -->
                            <div class="single-slider"
                                style="background-image: url(assets/images/hero/productos.png);">
                                <div class="content">
                                    <h1>
                                        EXPLORA NUESTRO CATALOGO
                                    </h1>
                                    <p>Variedad de productos para tus Hobbies favoritos</p>
                                    <div class="button">
                                        <a href="product-grids.php" class="btn">TIENDA</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Slider -->
                        </div>
                        <!-- End Hero Slider -->
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-12 md-custom-padding">
                            <!-- Start Small Banner -->
                            <div class="hero-small-banner">
                                <a href="matches.php" style="display: block; text-decoration: none; color: white;">
                                        <div class="matches-div-mini text-center">
                                            <!-- Partida 1 -->
                                            <div class="match-entry mb-2 text-center">
                                                <div class="row align-items-center">
                                                    <div class="col-2">
                                                        <img src="https://via.placeholder.com/50x50" alt="Foto de perfil usuario1" class="img-fluid" style="width: 20px; height: 20px;">
                                                    </div>
                                                    <div class="col-3">
                                                        <span style="font-size: 8px;">Usuario1</span>
                                                    </div>
                                                    <div class="col-2">
                                                        <img src="assets/images/matches/sword.png" alt="Icono de batalla" class="img-fluid" style="max-width: 15px;">
                                                    </div>
                                                    <div class="col-3">
                                                        <span style="font-size: 8px;">Usuario2</span>
                                                    </div>
                                                    <div class="col-2">
                                                        <img src="https://via.placeholder.com/50x50" alt="Foto de perfil usuario2" class="img-fluid" style="width: 20px; height: 20px;">
                                                    </div>
                                                </div>
                                                <div class="scoreboard">
                                                    <!-- Equipo 1 -->
                                                    <div class="team">
                                                        <img src="https://via.placeholder.com/100x100" alt="Equipo 1" style="width: 55px; height: 55px;">
                                                        <span style="font-size: 10px;">Adeptus Astartes<br>Ultramarines</span>
                                                    </div>
                                                    <!-- Puntaje izquierdo -->
                                                    <div class="score-mini">15</div>
                                                    <!-- Sección central -->
                                                    <div class="middle-section">
                                                        <span style="font-size: 10px;">Warhammer 40.000</span>
                                                        <span style="font-size: 10px;">Ronda Nº1</span>
                                                    <span style="font-size: 10px;"><i class="lni lni-hourglass"></i>00:00:00</span>
                                                        <div class="points-title-mini">PUNTOS DE VICTORIA</div>
                                                    </div>
                                                    <!-- Puntaje derecho -->
                                                    <div class="score-mini">15</div>
                                                    <!-- Equipo 2 -->
                                                    <div class="team">
                                                        <img src="https://via.placeholder.com/100x100" alt="Equipo 2" style="width: 55px; height: 55px;">
                                                        <span style="font-size: 10px;">Adeptus Astartes<br>Ultramarines</span>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                            </a>
                            </div>
                            <!-- End Small Banner -->
                        </div>
                        <div class="col-lg-12 col-md-6 col-12">
                            <!-- Start Small Banner -->
                            <div class="hero-small-banner style2">
                                <div class="content">
                                    <h2>¡Publicaciones!</h2>
                                    <p></p>
                                    <div class="button">
                                        <a class="btn" href="blog-grid-sidebar.php">Ver Publicaciones</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Small Banner -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Area -->

    <?php
// Conexión a la base de datos
include("db.php");

// Obtener los últimos 4 productos según su ID
$query = "SELECT * FROM productos ORDER BY id_producto DESC LIMIT 4"; // Cambia 'id_producto' si el nombre es diferente
$result = mysqli_query($conn, $query);
?>

<!-- Start Trending Product Area -->
<section class="trending-product section">
    <div class="container-sm">
        <div class="row">
            <div class="col-12"> 
                <div class="section-title">
                    <h2>Productos Disponibles</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php while ($product = mysqli_fetch_assoc($result)): ?>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Product -->
                    <div class="single-product">
                        <div class="product-image">
                            <img src="<?php echo $product['imagen_producto']; ?>" alt="<?php echo $product['nombre_producto']; ?>">
                        </div>
                        <div class="product-info">
                            <span class="category"><?php echo $product['tipo']; ?></span>
                            <h4 class="title">
                                <a href="product-grids.php?id=<?php echo $product['id_producto']; ?>"><?php echo $product['nombre_producto']; ?></a>
                            </h4>
                            <div class="price">
                                <span><?php echo $product['precio']; ?> Bs.</span> <!-- Ajusta el símbolo de la moneda según sea necesario -->
                            </div>
                        </div>
                    </div>
                    <!-- End Single Product -->
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<!-- End Trending Product Area -->

    <!-- Start Blog Section Area -->
    <section class="blog-section section">
        <div class="container-sm">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Últimas Publicaciones</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                // Consulta para obtener las últimas 3 publicaciones
                $sql = "SELECT p.id_publicacion, p.titulo, p.contenido, p.imagen_publicacion, p.fecha_publicacion, p.tag, u.nombre_usuario 
                        FROM publicaciones p
                        JOIN usuarios u ON p.id_usuario = u.id_usuario
                        ORDER BY p.fecha_publicacion DESC
                        LIMIT 3";  // Limitar a 3 resultados
                
                $result = $conn->query($sql);
                
                // Verificar si hay resultados
                if ($result->num_rows > 0) {
                    // Generar el HTML para cada publicación
                    while ($row = $result->fetch_assoc()) {
                        $id_publicacion = $row['id_publicacion'];
                        $titulo = $row['titulo'];
                        $imagen = !empty($row['imagen_publicacion']) ? $row['imagen_publicacion'] : 'https://via.placeholder.com/370x215'; // Placeholder si no hay imagen
                        $tag = $row['tag'];
                        
                        echo '
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Start Single Blog -->
                            <div class="single-blog">
                                <div class="blog-img">
                                    <a href="blog-single-sidebar.php?id='.$id_publicacion.'"> <!-- Enlace con el ID de la publicación -->
                                        <img src="'.$imagen.'" alt="#" style="width: 370px; height: 215px; object-fit: cover;">
                                    </a>
                                </div>
                                <div class="blog-content">
                                    <a class="category" href="javascript:void(0)">'.$tag.'</a> <!-- Mostrar el tag -->
                                    <h4>
                                        <a href="blog-single-sidebar.php?id='.$id_publicacion.'">'.$titulo.'</a> <!-- Mostrar el título -->
                                    </h4>
                                    <div class="button">
                                        <a href="blog-single-sidebar.php?id='.$id_publicacion.'" class="btn">Leer más</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Blog -->
                        </div>';
                    }
                } else {
                    echo "No hay publicaciones disponibles.";
                }
                
                $conn->close();
                ?>
            </div>
        </div>
    </section>
    <br>
    <br><br><br><br>
    <!-- End Blog Section Area -->

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
    <a href="#" class="scroll-top" style="display: none;">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/glightbox.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script type="text/javascript">
        //========= Hero Slider 
        tns({
            container: '.hero-slider',
            slideBy: 'page',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 0,
            items: 1,
            nav: false,
            controls: true,
            controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
        });

        //======== Brand Slider
        tns({
            container: '.brands-logo-carousel',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 15,
            nav: false,
            controls: false,
            responsive: {
                0: {
                    items: 1,
                },
                540: {
                    items: 3,
                },
                768: {
                    items: 5,
                },
                992: {
                    items: 6,
                }
            }
        });

    </script>
    <script>
        const finaleDate = new Date("February 15, 2023 00:00:00").getTime();

        const timer = () => {
            const now = new Date().getTime();
            let diff = finaleDate - now;
            if (diff < 0) {
                document.querySelector('.alert').style.display = 'block';
                document.querySelector('.container').style.display = 'none';
            }

            let days = Math.floor(diff / (1000 * 60 * 60 * 24));
            let hours = Math.floor(diff % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
            let minutes = Math.floor(diff % (1000 * 60 * 60) / (1000 * 60));
            let seconds = Math.floor(diff % (1000 * 60) / 1000);

            days <= 99 ? days = `0${days}` : days;
            days <= 9 ? days = `00${days}` : days;
            hours <= 9 ? hours = `0${hours}` : hours;
            minutes <= 9 ? minutes = `0${minutes}` : minutes;
            seconds <= 9 ? seconds = `0${seconds}` : seconds;

            document.querySelector('#days').textContent = days;
            document.querySelector('#hours').textContent = hours;
            document.querySelector('#minutes').textContent = minutes;
            document.querySelector('#seconds').textContent = seconds;

        }
        timer();
        setInterval(timer, 100000);


        
    </script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#search-input').on('input', function() {
        let query = $(this).val();

        // Si la consulta está vacía, limpiar el dropdown
        if (query.length < 1) {
            $('#search-dropdown').empty().hide();
            return;
        }

        // Realizar la búsqueda a través de AJAX
        $.ajax({
            url: 'search.php',
            method: 'GET',
            data: { query: query },
            dataType: 'json',
            success: function(data) {
                $('#search-dropdown').empty(); // Limpiar resultados previos

                if (data.length > 0) {
                    // Mostrar resultados
                    data.forEach(function(item) {
                        $('#search-dropdown').append(
                            `<li><a href="${item.link}">${item.name} (${item.type})</a></li>`
                        );
                    });
                    $('#search-dropdown').show(); // Mostrar el dropdown
                } else {
                    $('#search-dropdown').hide(); // Ocultar si no hay resultados
                }
            },
            error: function(xhr, status, error) {
                console.error("Error en la búsqueda: ", error);
            }
        });
    });

    // Ocultar el dropdown al hacer clic fuera
    $(document).on('click', function(event) {
        if (!$(event.target).closest('.navbar-search').length) {
            $('#search-dropdown').hide();
        }
    });
});
</script>

</body>

</html>