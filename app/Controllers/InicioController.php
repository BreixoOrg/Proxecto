<?php

namespace Com\Daw2\Controllers;

class InicioController extends \Com\Daw2\Core\BaseController {

    public function index() {
        $data = array(
            'titulo' => 'Página de inicio',
            'breadcrumb' => ['Inicio']
        );
        $data['prueba'] = "Footer";
        $this->view->showViews(array('templates/header2.view.php','templates/prueba.view.php','templates/footer2.view.html'), $data);
    }

}
