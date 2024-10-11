<?php
    include "./db.php";
    $user =$_POST['email'];
    $password = sha1($_POST['clave']);
    $res = $conn->query("select * from usuarios 
        where correo='$email' 
        and password='$password'  and 
        verificado = 'si'
        ")or die($conn->error);
    if( mysqli_num_rows($res) > 0 ){
        header("Location:../index.html");
        
    }else{
        echo "login incorrecto";
    }
?>