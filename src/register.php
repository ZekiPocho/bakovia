<?php 
   include "./db.php";
   if( isset($_POST['username'] ) && isset($_POST['email']) && isset($_POST['clave'] ) 
    && isset($_POST['clave2'] )){

        if($_POST['clave'] == $_POST['clave2'] ){
            $name=$_POST['username'];
            $email=$_POST['email'];
            $pass=sha1($_POST['clave']);
            include "./mail_msg.php";
            if($enviado){
                $conexion->query("insert into usuarios (nombre_usuario, correo, contrasena, verificado , token) 
                    values('$name','$email','$pass','no','$codigo')  ")or die($conn->error);
                    echo "Favor de revisar tu email para verificar tu cuenta";
            }else{
                echo "no se pudo enviar el email";
            }
        }else{
            echo "Las contraseñas no coinciden";
        }
    }

?>