<?php

require 'config.php';
$url = $_GET["url"] ?? "Index/index";
$url = explode("/", $url);
$controlador = "";
$metodo = "";
if (isset($url[0])) {
    $controlador = $url[0];
}
if (isset($url[1])) {
    if ($url[1] != '') {
        $metodo = $url[1];
    }
}

spl_autoload_register(function($class) {
    if (file_exists(LBS . $class . ".php")) {
        require LBS . $class . ".php";
    }
});

require 'Controlador/Error.php';
$error = new Errors();

//obj = new Controladores();
//echo $controlador . " ---- " . $metodo;
// Llamamos a los controladores
$controladoresPath = "Controlador/" . $controlador . ".php";
if (file_exists($controladoresPath)) {
    require $controladoresPath;
    $controlador = new $controlador;
    if (isset($metodo)) {
        if (method_exists($controlador, $metodo)) {
            $controlador->{$metodo}();
        } else {
            $error->error();
        }
    }
} else {
    $error->error();
}
?>