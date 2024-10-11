<?php
    include "./db.php";
    $email =$_POST['email'];
    $password = sha1($_POST['clave']);
    $res = $conn->query("select * from usuarios 
        where correo='$email' 
        and contrasena='$password'  and 
        verificado = 'si'
        ")or die($conn->error);
    if( mysqli_num_rows($res) > 0 ){
        header("Location:../index.html");
        
    }else{
        echo "login incorrecto";
    }
?>