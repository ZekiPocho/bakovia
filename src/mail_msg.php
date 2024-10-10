<?php 
$destinatario = "user@example.com"; 
$asunto = "Bakovia - Verificación de Correo Electrónico"; 
$cuerpo = ' 
<html> 
<head> 
    <meta charset="UTF8" />
   <title>Gracias por registrarte!</title> 
</head> 

<body> 
<h1>Aqui está el código para tu verificación:</h1> 
<p> 
<b>123123 
</p> 
</body> 
</html> 
'; 

//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//dirección del remitente 
$headers .= "From: Bakovia Battle Bunker <noreply@bakovia.com>\r\n"; 

/*//dirección de respuesta, si queremos que sea distinta que la del remitente 
$headers .= "Reply-To: mariano@desarrolloweb.com\r\n"; 

//ruta del mensaje desde origen a destino 
$headers .= "Return-path: holahola@desarrolloweb.com\r\n"; 

//direcciones que recibián copia 
$headers .= "Cc: maria@desarrolloweb.com\r\n"; 

//direcciones que recibirán copia oculta 
$headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n"; */

if(mail($destinatario,$asunto,$cuerpo,$headers)){
    echo "god";
}else{
    echo "wbda";
}
?>