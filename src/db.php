<?php

$servidor ="localhost";
$usuario = "root";
$clave = "";
$nombreDB = "bakoviadb";

$conn = mysqli_connect($servidor,$usuario,$clave,$nombreDB); 

if (mysqli_connect($servidor,$usuario,$clave,$nombreDB)) {
     echo "éxito";
}
else {
    echo "fallo";
}
?>