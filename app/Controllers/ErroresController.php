<?php
declare(strict_types = 1);
namespace Com\Daw2\Controllers;

class ErroresController extends \Com\Daw2\Core\BaseController {
    
    function error404() : void{
       http_response_code(404);
       $data = ['titulo' => 'Error 404'];
       $data['texto'] = '404. File not found';
       $this->view->showViews(array('templates/header.view.php', 'error.php', 'templates/footer.view.php') , $data);
    }
    
    function error405() : void{
       http_response_code(405);
       $data = ['titulo' => 'Error 405'];
       $data['texto'] = '405. Method not allowed';
       
       $this->view->showViews(array('templates/header.view.php', 'error.php', 'templates/footer.view.php') , $data);
    }
    
    //Rellena la variable $_SESSION con los campo s necesarios para mostrar el dialog
    function showDialog(bool $isExito, string $txtColor, string $txtNormal){
        $_SESSION['mostrarDialog']['isExito'] = $isExito;
        $_SESSION['mostrarDialog']['txtColor'] = $txtColor;
        $_SESSION['mostrarDialog']['txtNormal'] = $txtNormal;
    }
    
}