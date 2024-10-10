<?php
    include "db.php";
    $email =$_POST['email'];
    $codigo =$_POST['codigo'];
    $res = $conn->query("SELECT * FROM usuarios 
        where correo='$email' 
        and token='$codigo' 
        ");
    if( $res ){
        header('Location:../public/valid.html');
    }else{
        echo "codigo invalido";
    }
?>