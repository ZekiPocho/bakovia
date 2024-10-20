<?php
include("../src/validate_session.php");
include("../public/db.php");

// Verifica si el usuario ha iniciado sesión y si tiene el rol de administrador (id_rol = 1)
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    header('Location: ../public/index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página Principal del Administrador</title>
    <style>
        body {
            background-color: #1e1e1e;
            color: #ffffff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        h1 {
            color: #ff9800;
            text-align: center;
        }
        .button-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin: 20px;
        }
        .admin-button {
            background-color: #ff9800;
            color: #000;
            border: none;
            padding: 15px 30px;
            margin: 10px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
        }
        .admin-button:hover {
            background-color: #e68900;
        }
    </style>
</head>
<body>
    <h1>Página Principal del Administrador</h1>

    <div class="button-container">
        <a href="admin-products.php" class="admin-button">Administrar Productos</a>
        <a href="admin-matches.php" class="admin-button">Administrar Partidas</a>
        <a href="admin-posts.php" class="admin-button">Administrar Publicaciones</a>
        <a href="admin-index.php" class="admin-button">Modificar Contenido del Index</a>
        <a href="admin-about-us.php" class="admin-button">Modificar Contenido de About Us</a>
        <a href="admin-faq.php" class="admin-button">Modificar Contenido de FAQ</a>
    </div>
</body>
</html>
