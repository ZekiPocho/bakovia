<?php
    include "db.php";
    $email =$_GET['email'];
    $codigo =$_GET['codigo'];
    $res = $conn->query("SELECT * FROM usuarios 
        where correo='$email' 
        and token='$codigo' 
        ");
    if( mysqli_num_rows($res) > 0 ){
        header('Location:../public/valid.html');
    }else{
        echo "codigo invalido";
    }
?>