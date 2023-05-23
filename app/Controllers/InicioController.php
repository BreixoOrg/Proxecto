<?php

namespace Com\Daw2\Controllers;
/*CONTROLDAOR DE LA PAGINA DE INICIO DE LA WEB - /shironime*/
class InicioController extends \Com\Daw2\Core\BaseController {

    public function index() {
        $data = array(
            'titulo' => 'Página de inicio',
            'breadcrumb' => ['Inicio']
        );
        $data['prueba'] = "Footer";
        $this->view->showViews(array('templates/headerShiro.view.php','/indexShiro.view.php','templates/footerShiro.view.php'), $data);
    }

}
