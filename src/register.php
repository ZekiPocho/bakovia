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
