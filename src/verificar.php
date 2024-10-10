<?php
    include "db.php";
    $email =$_POST['email'];
    $codigo =$_POST['codigo'];
    $res = $conexion->query("select * from usuarios 
        where correo='$email' 
        and token='$codigo' 
        ")or die($conn->error);
    if( mysqli_num_rows($res) > 0 ){
        $conexion->query("update usuarios set verificado = 'si' where correo = '$email' ");
        header('Location: ../valid.html')
    }else{
        echo "codigo invalido";
    }
?>