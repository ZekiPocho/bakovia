<?php 
   include "./db.php";
   $error_message = "";  // Variable para almacenar el mensaje de error

   if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['clave']) && isset($_POST['clave2'])) {

       if ($_POST['clave'] == $_POST['clave2']) {
           $name = $_POST['username'];
           $email = $_POST['email'];
           $pass = sha1($_POST['clave']);
           include "./mail_msg.php";
           if ($enviado) {
               $conn->query("INSERT INTO usuarios (nombre_usuario, correo, contrasena, verificado, token) 
                             VALUES ('$name', '$email', '$pass', 'no', '$codigo')") or die($conn->error);
               header('Location: ../public/sent.html');
           } else {
               $error_message = "Error al enviar el Email, intente nuevamente";
           }
       } else {
           $error_message = "Las contraseñas no coinciden.";
       }
   }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>

    <h2>Formulario de Registro</h2>

    <!-- Mostrar el mensaje de error en la misma página -->
    <?php if (!empty($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <!-- Formulario de registro -->
    <form action="register.php" method="POST">
        <label for="username">Usuario:</label>
        <input type="text" name="username" required><br>

        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" required><br>

        <label for="clave">Contraseña:</label>
        <input type="password" name="clave" required><br>

        <label for="clave2">Repetir contraseña:</label>
        <input type="password" name="clave2" required><br>

        <input type="submit" value="Registrarse">
    </form>

</body>
</html>
