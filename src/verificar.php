<?php
    include "db.php";
    $email =$_POST['email'];
    $codigo =$_POST['codigo'];
    $res = $conn->query("SELECT * FROM usuarios 
        where correo='$email' 
        and token='$codigo' 
        ");
    if( mysqli_num_rows($res) > 0){
        $conn->query("update usuarios set verificado = 'si' where correo = '$email' ");
        header('Location:../public/valid.html');
    }else{
        echo "codigo invalido";
    }
?>