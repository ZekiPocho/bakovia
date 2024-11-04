<?php
include ('../src/validate_session.php'); // Asegúrate de que el usuario esté autenticado
include ('../public/db.php');
$mensaje = "";

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $conn->real_escape_string($_POST['titulo']);
    $contenido = $conn->real_escape_string($_POST['contenido']);
    $tag = $conn->real_escape_string($_POST['tag']); // Capturamos el tag seleccionado
    $id_usuario = $_SESSION['id_usuario']; // Asumimos que tienes la sesión del usuario

    // Manejo de imagen subida
    $upload_dir = '../uploads/posts/';
    $imagen_publicacion = '';

    if (!empty($_FILES['imagenes']['name'][0])) {
        $image_name = basename($_FILES['imagenes']['name'][0]);
        $image_tmp_name = $_FILES['imagenes']['tmp_name'][0];
        $image_path = $upload_dir . $image_name;

        // Crear la carpeta si no existe
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        if (move_uploaded_file($image_tmp_name, $image_path)) {
            $imagen_publicacion = $image_path; // Guardamos la ruta de la imagen
        } else {
            echo "Error al subir la imagen.";
        }
    }

    // Insertar la publicación en la base de datos con la imagen
    $sql = "INSERT INTO publicaciones (id_usuario, titulo, contenido, fecha_publicacion, imagen_publicacion, tag) 
            VALUES ('$id_usuario', '$titulo', '$contenido', NOW(), '$imagen_publicacion', '$tag')";

    if ($conn->query($sql) === TRUE) {
        // Obtener el ID de la publicación recién creada
        $id_publicacion = $conn->insert_id;

        // Redirigir al detalle de la publicación recién creada
        header("Location: blog-single-sidebar.php?id=$id_publicacion");
        exit(); // Importante: salir después de la redirección
    } else {
        echo "Error al crear la publicación: " . $conn->error;
    }
}

// Si hay un parámetro de éxito, mostrar el mensaje
if (isset($_GET['success'])) {
    $mensaje = "<div class='alert-success'>La publicación se creó correctamente</div>";
}

$conn->close();
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
    <script src="https://cdn.tiny.cloud/1/ygwkt7hwy11qzbk8uc4veikmopkjbvolxix57q02vpkn8sif/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: 'textarea[name=contenido]',  // change this value according to your HTML
        menubar: 'edit insert format tools table help'
        });
    </script>
</head>

<body>

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

<!-- Start Breadcrumbs -->
<div class="breadcrumbs">
        <div class="container-sm">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">PUBLICAR</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.php"><i class="lni lni-home"></i> INICIO</a></li>
                        <li><a href="blog-grid-sidebar.php">PUBLICACIONES</a></li>
                        <li>PUBLICAR</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

<br>
<section class="post">
    <div class="container-sm mt-6 p-4" style="max-width: 600px;">
        <h2 class="text-center mb-4">CREAR PUBLICACIÓN</h2>

        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Subir Imágenes -->
            <div class="mb-4 text-center">
                <h5>Imagen de tu publicación:</h5>
                <br>
                <label for="imagenes" class="image-upload-label" style="cursor: pointer;">
                    <div class="image-upload-placeholder d-flex align-items-center justify-content-center" style="height: 100%; width: 300px; background-color: black;" id="image-upload">
                        <img id="image-preview" src="" alt="Previsualización" class="img-fluid d-none" style="max-height: 200px; object-fit: scale-down;">
                        <span id="image-text" class="text-muted">Haz clic aquí para subir una imagen</span>
                    </div>
                    <input type="file" id="imagenes" name="imagenes[]" accept="image/*" class="d-none" onchange="previewImage()" required>
                </label>
            </div>

            <!-- Título -->
            <div class="mb-4">
    <h5 for="titulo">Título:</h5>
    <br>
    <textarea class="form-control" name="titulo" id="titulo" placeholder="Escribe el título de tu publicación" maxlength="100" rows="2" style="resize: none; overflow-y: auto;" oninput="contarCaracteres()" required></textarea>
    <small id="contador-titulo" class="form-text text-muted">0/100 caracteres</small>
</div>

            <!-- Cuerpo de la publicación -->
            <div class="mb-4">
                <h5 for="contenido">Cuerpo de la publicación:</h5>
                <br>
                <textarea class="form-control" name="contenido" rows="5" placeholder="¡Siéntete libre de escribir en el formato que quieras!"></textarea>
            </div>

            <!-- Selección de Tags -->
            <div class="mb-4">
                <h5 for="tags">Selecciona el Tag de tu publicación. ¿De qué trata tu publicación?:</h5>
                <br>
                <select class="form-control" name="tag" id="tags" required>
                    <option value="" selected disabled>Selecciona Tag</option>
                    <option value="Showcase Ejército">Showcase Ejército</option>
                    <option value="Showcase Miniatura">Showcase Miniatura</option>
                    <option value="Pintura">Pintura</option>
                    <option value="Armado">Armado</option>
                    <option value="Juego">Juego</option>
                    <option value="Lore">Lore</option>
                    <option value="Arte/Dibujo">Arte/Dibujo</option>
                    <option value="Meme">Meme</option>
                    <option value="Noticias">Noticias</option>
                    <option value="Discusiones">Discusiones</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>

            <!-- Botón de Publicar -->
            <div class="text-center">
                <input class="btn btn-primary" type="submit" value="Publicar">
            </div>
        </form>
    </div>
</section>

<!-- Script para contar caracteres y previsualización de imagen -->
<script>
    function contarCaracteres() {
        var titulo = document.getElementById('titulo');
        var contador = document.getElementById('contador-titulo');
        contador.textContent = titulo.value.length + "/100 caracteres";
    }

    function previewImage() {
    const fileInput = document.getElementById('imagenes');
    const imagePreview = document.getElementById('image-preview');
    const imageText = document.getElementById('image-text');

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.classList.remove('d-none'); // Mostrar la imagen
            imageText.classList.add('d-none'); // Ocultar el texto
        }
        
        reader.readAsDataURL(fileInput.files[0]);
    }
}
</script>


<center>
<?php
echo $mensaje;
?>
</center>

</body>

</html>
