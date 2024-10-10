<?php
// Varios destinatarios
$para  = 'Papercut@user.com' . ', '; // atención a la coma
//$para .= 'wez@example.com';

// título
$título = 'Bakovia Battle Bunker - Verificación de Correo Electrónico';

// mensaje
$mensaje = '
<html>
<head>
  <title>Gracias por registrarte en el Bunker!</title>
</head>
<body>
  <p>lorem ipsum</p>
  <h2></h2>
</body>
</html>
';

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
/*
// Cabeceras adicionales
$cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
$cabeceras .= 'From: Recordatorio <cumples@example.com>' . "\r\n";
$cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
$cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";*/

mail($para, $título, $mensaje, $cabeceras);
?>