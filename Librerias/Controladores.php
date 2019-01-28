<?php

class Controladores {

    public function __construct() {
        $this->vista = new Vistas();
        $this->loadClassmodels();
    }

    function loadClassmodels() {
        $model = get_class($this) . '_model';
        $path = 'Modelo/' . $model . '.php';
        if (file_exists($path)) {
            require $path;
            $this->model = new $model();
        }
    }

}

?>
