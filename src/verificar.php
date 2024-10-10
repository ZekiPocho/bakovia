<?php
    include "db.php";
    $email =$_POST['email'];
    $codigo =$_POST['codigo'];
    $res = $conn->query("SELECT * FROM usuarios 
        where correo='$_POST['email']' 
        and token='$_POST['codigo']' 
        ");
    if( mysqli_num_rows($res) > 0){
        header('Location:../public/valid.html');
    }else{
        echo "codigo invalido";
    }
?>