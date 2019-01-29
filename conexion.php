<?php

$host = "85.10.205.173:3306";
$user = "diegopalacios";
$password = "DHpc1996";
$db = "proyecto_compras";

$conection = @mysqli_connect($host, $user, $password, $db);

if (!$conection) {
    echo 'Error en la Conexion';
}
?>
