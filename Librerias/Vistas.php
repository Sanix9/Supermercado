<?php

class Vistas {

    function render($controlador, $vista) {
        $controladores = get_class($controlador);
        require VIEWS . DFT . "head.html";
        require VIEWS . $controladores . '/' . $vista . '.html';
        require VIEWS . DFT . "footer.html";
    }

}

?>