<?php 
$codigo = rand(1000,9999);
$asunto = "Bakovia - Verificación de Correo Electrónico"; 
$to = "zekimaldonado@gmail.com";
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

$headers = "From: zekimaldonado@gmail.com"; 

$enviado = false;
if(mail($to,$asunto,$cuerpo,$headers)){
    $enviado = true;
}
?>