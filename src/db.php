<?php
    $conn = new mysqli('localhost','root','','bakoviadb');
    if($conn-> connect_error){
        die('error de conexion');
    }
?>