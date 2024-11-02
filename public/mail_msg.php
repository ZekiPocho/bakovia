
<?php 
$codigo = rand(1000,9999);
$destinatario = "user@example.com"; 
$asunto = "Bakovia - Verificación de Correo Electrónico"; 
$cuerpo = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Gracias por registrarte!</title>
</head>
<body>
    <h1>Aqui está el código para tu verificación:</h1> 
<p> 
<h2>'.$codigo.'</h2>
<p><a href="http://localhost/bakovia/public/confirm.php?email='.$email.'">Verificar cuenta</a></p>
</p> 
</body>
</html>
'; 

//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//dirección del remitente 
$headers .= "From: Bakovia Battle Bunker <noreply@bakovia.com>\r\n"; 

$enviado = false;
if(mail($destinatario,$asunto,$cuerpo,$headers)){
    $enviado = true;
}
?>
