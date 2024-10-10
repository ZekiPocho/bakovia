<?php
    include "db.php";
    $email =$_POST['email'];
    $codigo =$_POST['codigo'];
    $res = $conn->query("SELECT * FROM usuarios 
        where correo='zekimaldonado@gmail.com' 
        and token='3436' 
        ");
    if( mysqli_num_rows($res) > 0){
        header('Location:../public/valid.html');
    }else{
        echo "codigo invalido";
    }
?>