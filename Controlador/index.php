<?php

class Index extends Controladores {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->vista->render($this, "index");
    }

}
?>

