<?php
    require_once "../src/validate_session.php";
    include "db.php";
?>
<?php

// Verifica si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el ID de usuario
    $userId = $_SESSION['id_usuario'];

    // Consulta para obtener los datos actuales del usuario
    $querySelect = "SELECT nombre_usuario, biografia, foto_perfil, army_showcase, army_desc FROM usuarios WHERE id_usuario = ?";
    $stmtSelect = $conn->prepare($querySelect);
    $stmtSelect->bind_param("i", $userId);
    $stmtSelect->execute();
    $stmtSelect->bind_result($currentUsername, $currentBio, $currentProfilePhotoPath, $currentArmyShowcasePath, $currentArmyDesc);
    $stmtSelect->fetch();
    $stmtSelect->close();

    // Procesar datos del formulario y usar valores actuales si los campos están vacíos
    $username = !empty(trim($_POST['username'])) ? trim($_POST['username']) : $currentUsername;
    $bio = isset($_POST['bio']) && trim($_POST['bio']) !== '' ? trim($_POST['bio']) : $currentBio;
    $description = isset($_POST['description1']) && trim($_POST['description1']) !== '' ? trim($_POST['description1']) : $currentArmyDesc;

    // Validación de datos
    $errors = [];
    if (strlen($bio) > 640) {
        $errors[] = "La biografía no puede exceder los 640 caracteres.";
    }

    // Inicializar rutas de las imágenes con los valores actuales
    $targetProfileFile = $currentProfilePhotoPath;
    $targetArmyFile = $currentArmyShowcasePath;

    // Procesar imagen de perfil
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
        $profileImage = $_FILES['profileImage'];
        if (validateImageSize($profileImage)) {
            $uploadDirectory = '../uploads/user/';
            $fileExtension = pathinfo($profileImage['name'], PATHINFO_EXTENSION);
            $newProfileFileName = $userId . '.' . $fileExtension;
            $targetProfileFile = $uploadDirectory . $newProfileFileName;

            if (move_uploaded_file($profileImage['tmp_name'], $targetProfileFile)) {
                $_SESSION['foto_perfil'] = $targetProfileFile; // Actualiza la sesión
            } else {
                $errors[] = "Error al subir la imagen de perfil.";
            }
        } else {
            $errors[] = "La imagen de perfil es demasiado grande (máximo 5MB).";
        }
    }

    // Procesar imagen de Army Showcase
    if (isset($_FILES['armyShowcaseImage']) && $_FILES['armyShowcaseImage']['error'] === UPLOAD_ERR_OK) {
        $armyShowcaseImage = $_FILES['armyShowcaseImage'];
        if (validateImageSize($armyShowcaseImage)) {
            $uploadArmyDirectory = '../uploads/army/';
            $armyFileExtension = pathinfo($armyShowcaseImage['name'], PATHINFO_EXTENSION);
            $newArmyFileName = $userId . '.' . $armyFileExtension;
            $targetArmyFile = $uploadArmyDirectory . $newArmyFileName;

            if (move_uploaded_file($armyShowcaseImage['tmp_name'], $targetArmyFile)) {
                $_SESSION['army_showcase'] = $targetArmyFile; // Actualiza la sesión
            } else {
                $errors[] = "Error al subir la imagen de Army Showcase.";
            }
        } else {
            $errors[] = "La imagen de Army Showcase es demasiado grande (máximo 5MB).";
        }
    }

    // Guardar los cambios en la base de datos si no hay errores
    if (empty($errors)) {
        // Solo actualizar los campos que han cambiado
        $query = "UPDATE usuarios SET nombre_usuario = ?, biografia = ?, army_desc = ?";
        $params = [$username, $bio, $description];
        $types = "sss";

        if ($targetProfileFile !== $currentProfilePhotoPath) {
            $query .= ", foto_perfil = ?";
            $params[] = $targetProfileFile;
            $types .= "s";
        }

        if ($targetArmyFile !== $currentArmyShowcasePath) {
            $query .= ", army_showcase = ?";
            $params[] = $targetArmyFile;
            $types .= "s";
        }

        $query .= " WHERE id_usuario = ?";
        $params[] = $userId;
        $types .= "i";

        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . $conn->error);
        }

        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $stmt->close();

        // Actualiza la sesión con los nuevos datos
        $_SESSION['nombre_usuario'] = $username;
        $_SESSION['biografia'] = $bio;
        $_SESSION['army_desc'] = $description;

        // Redirige a la misma página o a otra después de guardar
        header('Location: profile.php');
        exit;
    }
}

// Función para validar el tamaño de la imagen
function validateImageSize($file) {
    return $file['size'] <= 5 * 1024 * 1024; // 5MB
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
            CERRAR SESIÓN <span class="material-symbols-outlined">logout</span>
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


    <div class="container-sm p-3">
    <div class="row">
        <div class="d-flex flex-wrap align-items-start">
            <div class="col-auto profile-img">
                <img src="<?php echo $_SESSION['foto_perfil'] ?? 'https://via.placeholder.com/200'; ?>" alt="Foto de perfil" class="profile-img" loading="lazy">
            </div>

            <div class="col-7 profile-info-name">
                <a href="edit-profile.php" style="text-decoration: none;"
                   onmouseover="this.style.textDecoration='underline';"
                   onmouseout="this.style.textDecoration='none';">
                    <h2><?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#ffffff" xmlns="http://www.w3.org/2000/svg" transform="rotate(0 0 0)">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.3028 3.7801C18.4241 2.90142 16.9995 2.90142 16.1208 3.7801L14.3498 5.5511C14.3442 5.55633 14.3387 5.56166 14.3333 5.5671C14.3279 5.57253 14.3225 5.57803 14.3173 5.58359L5.83373 14.0672C5.57259 14.3283 5.37974 14.6497 5.27221 15.003L4.05205 19.0121C3.9714 19.2771 4.04336 19.565 4.23922 19.7608C4.43508 19.9567 4.72294 20.0287 4.98792 19.948L8.99703 18.7279C9.35035 18.6203 9.67176 18.4275 9.93291 18.1663L20.22 7.87928C21.0986 7.0006 21.0986 5.57598 20.22 4.6973L19.3028 3.7801ZM14.8639 7.15833L6.89439 15.1278C6.80735 15.2149 6.74306 15.322 6.70722 15.4398L5.8965 18.1036L8.56029 17.2928C8.67806 17.257 8.7852 17.1927 8.87225 17.1057L16.8417 9.13619L14.8639 7.15833ZM17.9024 8.07553L19.1593 6.81862C19.4522 6.52572 19.4522 6.05085 19.1593 5.75796L18.2421 4.84076C17.9492 4.54787 17.4743 4.54787 17.1814 4.84076L15.9245 6.09767L17.9024 8.07553Z" fill="#ffffff"/>
                        </svg>
                    </h2>
                </a>
                <div class="bio">
                    <p class="text-muted"><?php echo htmlspecialchars($_SESSION['biografia']); ?></p>
                </div>
            </div>
            <div class="col profile-info mt-3 mt-md-0" style="margin-top: 20px">
                <ul>
                    <center>
                        <li><p class="text-muted">RANGO</p></li>
                        <li><img src="<?php echo $_SESSION['rango_id'] ?? 'https://via.placeholder.com/500'; ?>" alt="rango" style="width: 80px; height: 80px;"></li>
                        <li><p class="text-muted"><?php echo htmlspecialchars($_SESSION['nombre_rango'] ?? 'Nombre de rango'); ?></p></li>
                        <br>
                        <li><p class="text-muted">MIEMBRO DESDE</p></li>
                        <li><p class="text-muted"><?php echo htmlspecialchars($_SESSION['fecha_registro']); ?></p></li>
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
                    <img src="<?php echo $_SESSION['army_showcase'] ?? '../uploads/army/placeholder.png'; ?>" class="card-img-top" alt="Imagen ARMY SHOWCASE" style="max-width: 800px;max-height: 400px;object-fit: cover;border: solid 2px;border-radius: 5px;" loading="lazy">
                    <div class="card-body">
                        <p class="card-text"><?php echo htmlspecialchars($_SESSION['army_desc'] ?? 'Descripción breve de tu Showcase.'); ?></p>
                    </div>
                </div>
                <div class="card p-3">
                    
                <div class="card-body">
    <center><h5 class="card-title">PUBLICACIONES</h5></center>
    <div class="row">
        <?php
        $id_usuario = $_SESSION['id_usuario'];
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