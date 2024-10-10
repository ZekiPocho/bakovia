<?php
    include "db.php";
    $email =$_POST['email'];
    $codigo =$_POST['codigo'];
    $res = $conn->query("select * from usuarios 
        where correo='$email' 
        and token='$codigo' 
        ")or die($conn->error);
    echo "$res";
    if( $res->num_rows > 0 ){
        $conn->query("update usuarios set verificado = 'si' where correo = '$email' ");
        header('Location: ../valid.html');
    }
    else{
        echo "codigo invalido";
    }
?>