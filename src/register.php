<?php 
   include "./db.php";
   if( isset($_POST['registrar'] )) {
        if($_POST['clave'] == $_POST['clave2'] ){
            $name=$_POST['username'];
            $email=$_POST['email'];
            $pass=sha1($_POST['clave']);
            include "./mail_msg.php";
            if($enviado){
                $conn->query("insert into usuarios (nombre_usuario, correo, contrasena, verificado , token) 
                    values('$name','$email','$pass','no','$codigo')  ")or die($conn->error);
                    header('Location: ../public/sent.html');
            }else{
                echo "Error al enviar el Email, intente nuevamente";
            }
        }else{
            echo "ERROR";
        }
    }

?>