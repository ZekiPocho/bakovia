<?php
    include "db.php";
    $email =$_POST['email'];
    $codigo =$_POST['codigo'];
    $res = $conn->query("select * from usuarios 
        where correo='$email' 
        and token='$codigo'
        ");
    $rta = mysqli_query($conn, $res);
    if(!$rta){
        $conn->query("update usuarios set verificado = 'si' where correo = '$email' ");
        header('Location: ../valid.html');
    }
    else{
        echo "codigo invalido";
    }
?>