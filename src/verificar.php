<?php
    include "db.php";
    $email =$_POST['email'];
    $codigo =$_POST['codigo'];
    $res = $conn->query("select * from usuarios 
        where correo='$email' 
        and token='$codigo'
        ")or die($conn->error);
    if( $conn->query($res) = TRUE ){
        $conn->query("update usuarios set verificado = 'si' where correo = '$email' ");
        header('Location: ../valid.html');
    }
    else{
        echo "codigo invalido";
    }
?>