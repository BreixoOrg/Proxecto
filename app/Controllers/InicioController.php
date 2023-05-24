<?php

namespace Com\Daw2\Controllers;
/*CONTROLADOR DEL INICIO DE LA WEB - /shironime*/
class InicioController extends \Com\Daw2\Core\BaseController {

    public function index() {
        var_dump($_SESSION);
        $this->view->showViews(array('templates/headerShiro.view.php','/indexShiro.view.php','templates/footerShiro.view.php'));
    }

}
