<?php
include ('db.php');
session_start();
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
.navbar-search {
    position: relative; /* Permite que el dropdown se posicione en relación a este contenedor */
}

#search-dropdown {
    position: absolute; /* Posiciona el dropdown de forma absoluta */
    top: 100%; /* Coloca el dropdown justo debajo del input */
    left: 0; /* Alinea el dropdown a la izquierda del contenedor */
    background: #171D25; /* Fondo blanco para el dropdown */
    border: 1px solid #6E869D; /* Borde gris */
    z-index: 1000; /* Asegúrate de que esté por encima de otros elementos */
    display: none; /* Ocultar por defecto */
    width: 100%; /* Ancho igual al contenedor de búsqueda */
    max-width: 250px; /* Disminuir el ancho máximo si es necesario */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra opcional para el dropdown */
}

#search-dropdown ul {
    list-style-type: none; /* Elimina los puntos de la lista */
    padding: 0; /* Sin padding */
    margin: 0; /* Sin margen */
}

#search-dropdown li {
    padding: 5px 8px; /* Reducir el espaciado interno para los elementos */
}

#search-dropdown li a {
    text-decoration: none; /* Sin subrayado */
    color: #ECBE00; /* Color del texto */
    display: block; /* Hacer que el enlace ocupe toda la área */
    font-size: 14px; /* Cambiar el tamaño de la fuente para que sea más pequeño */
}

#search-dropdown li a:hover {
    color: #aa8c13; /* Color de fondo en hover */
}
@media (max-width: 720px) {
    /*.navbar-toggler {
        order: 2; 
    }*/
    
    .navbar-brand {
        order: 1; /* Mantiene el logo en la parte superior */
    }
    
    .navbar-cart {
        order: 2; /* Coloca el ícono de perfil al final */
    }
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
                    <?php
                    // Comprobar si existe la sesión de la foto de perfil
                    if (isset($_SESSION['id_rol']) && $_SESSION['id_rol'] === 1) {
                        // Mostrar la foto de perfil
                        echo '<a style="color: yellow;" href="../admin/admin-dashboard.php">ADMIN</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- TERMINA HEADER Y NAVBAR PRO -->


    <!-- Start Hero Area -->
<section class="hero-area">
    <div class="container-sm">
        <div class="row">
            <div class="col-lg-8 col-12 custom-padding-right">
                <div class="slider-head">
                    <!-- Start Hero Slider -->
                    <div class="hero-slider">
                        <!-- Start Single Slider -->
                        <div class="single-slider" style="background-image: url(assets/images/hero/hero.png);">
                            <div class="content">
                                <p></p>
                                <!--<div class="button">
                                    <a href="product-grids.php" class="btn">Shop Now</a>
                                </div>-->
                            </div>
                        </div>
                        <!-- End Single Slider -->

                        <!-- Start Single Slider -->
                        <div class="single-slider" style="background-image: url(assets/images/hero/productos.png);">
                            <div class="content">
                                <h1>EXPLORA NUESTRO CATÁLOGO</h1>
                                <p>¡Variedad de productos para tu hobby favorito!</p>
                                <div class="button">
                                    <a href="product-grids.php" class="btn">Explorar</a>
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
                        <!-- Start Small Banner: Partidas -->
                        <div class="hero-small-banner style2">
                            <div class="content">
                                <h2>En Bakovia hay comida, odio y ¡GUERRA!</h2><p></p>
                                <br>
                                <br>
                                <br>
                                <br>
                                <span></span>
                                    <a href="matches.php">>Partidas en Progreso<</a>
                            </div>
                        </div>
                        <!-- End Small Banner -->

                        <!-- Start Small Banner: Publicaciones -->
                        <div class="hero-small-banner style3">
                            <div class="content">
                                <h2>Conoce los rumores del Bunker...</h2><p></p>
                                <br>
                                <br>
                                <br>
                                <br>
                                    <a href="blog-grid-sidebar.php">>Explorar Publicaciones<</a>
                            </div>
                        </div>
                        <!-- End Small Banner -->
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
<br>
<br>
<!-- Start Trending Product Area -->
<section class="trending-product section">
    <div class="container-sm">
        <div class="row">
            <div class="col-12"> 
                <div class="section-title">
                    <a href="product-grids.php"><h2>> Productos Disponibles <</h2></a> 
                </div>
            </div>
        </div>
        <div class="row">
            <?php while ($product = mysqli_fetch_assoc($result)): ?>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Product -->

                    <div class="single-product">
                        <a href="product-details.php?id=<?= $product['id_producto'] ?>" style="text-decoration: none; color: inherit;">
                            <div class="product-image">
                                <img src="<?= htmlspecialchars($product['imagen_producto']) ?>" 
                                     alt="<?= htmlspecialchars($product['nombre_producto']) ?>" 
                                     class="first-image">
                                <img src="<?= htmlspecialchars($product['imagen_producto2']) ?>" 
                                     alt="<?= htmlspecialchars($product['nombre_producto']) ?>" 
                                     class="second-image">
                            </div>
                            <div class="product-info">
                                <span class="category"><?= htmlspecialchars($product['tipo']) ?></span>
                                <span class="title"><?= htmlspecialchars($product['nombre_producto']) ?></span>
                                <div class="price">
                                    <span>Bs. <?= number_format($product['precio'], 2) ?></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- End Single Product -->
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<!-- End Trending Product Area -->
<br>
<br>
    <!-- Start Blog Section Area -->
    <section class="blog-section section">
        <div class="container-sm">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                    <a href="blog-grid-sidebar.php"><h2>> Últimas Publicaciones <</h2></a> 
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
                                    <h4><a href="blog-single-sidebar.php?id='.$id_publicacion.'">'.(strlen($titulo) > 75 ? substr($titulo, 0, 75) . '...' : $titulo).'</a></h4>
                                    <br>
                                    <a class="category" href="javascript:void(0)"><i class="lni lni-tag"></i>'.$tag.'</a>
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
    <br>
    <!-- End Blog Section Area -->

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
    const searchInput = document.getElementById("search-input");
    const searchDropdown = document.getElementById("search-dropdown");

    searchInput.addEventListener("input", function() {
    const query = searchInput.value;

    if (query.length > 0) {
        fetch(`search.php?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                searchDropdown.innerHTML = ""; // Limpiar resultados anteriores

                if (data.productos.length > 0 || data.publicaciones.length > 0) {
                    const ul = document.createElement("ul");

                    // Sección de Productos Encontrados
                    if (data.productos.length > 0) {
                        const productosHeader = document.createElement("li");
                        productosHeader.textContent = "Productos Encontrados";
                        productosHeader.style.fontWeight = "bold"; // Hacer el encabezado más visible
                        ul.appendChild(productosHeader);

                        data.productos.forEach(item => {
                            const li = document.createElement("li");
                            const a = document.createElement("a");
                            a.href = item.link; // Enlace al producto
                            a.textContent = item.name; // Nombre del producto
                            li.appendChild(a);
                            ul.appendChild(li);
                        });
                    }

                    // Sección de Publicaciones Encontradas
                    if (data.publicaciones.length > 0) {
                        const publicacionesHeader = document.createElement("li");
                        publicacionesHeader.textContent = "Publicaciones Encontradas";
                        publicacionesHeader.style.fontWeight = "bold"; // Hacer el encabezado más visible
                        ul.appendChild(publicacionesHeader);

                        data.publicaciones.forEach(item => {
                            const li = document.createElement("li");
                            const a = document.createElement("a");
                            a.href = item.link; // Enlace a la publicación
                            a.textContent = item.name; // Nombre de la publicación
                            li.appendChild(a);
                            ul.appendChild(li);
                        });
                    }

                    searchDropdown.appendChild(ul);
                    searchDropdown.style.display = "block"; // Mostrar el dropdown
                } else {
                    searchDropdown.style.display = "none"; // No hay resultados
                }
            })
            .catch(error => {
                console.error("Error fetching search results:", error);
            });
    } else {
        searchDropdown.style.display = "none"; // Si el input está vacío, ocultar el dropdown
    }
});
</script>


</body>

</html>