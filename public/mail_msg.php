<?php 
$codigo = rand(1000,9999);
$destinatario = "zekimaldonado@gmail.com"; 
$asunto = "Bakovia - Verificación de Correo Electrónico"; 
$cuerpo = ' 
<html> 
<head> 
        <meta charset="utf-8" />
   <title>Gracias por registrarte!</title> 
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

$headers .= "From: Bakovia Battle Bunker <noreply@bakovia.com>\r\n"; 

$enviado = false;
if(mail($destinatario,$asunto,$cuerpo,$headers)){
    $enviado = true;
}
?>