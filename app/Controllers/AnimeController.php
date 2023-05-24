<?php

namespace Com\Daw2\Controllers;
/*CONTROLDAOR DE LA PAGINA DE INICIO DE LA WEB - /shironime*/

//Para pasar los animes SIEMPRE los pasaremos mediante $data['animesMostrar] siendo estos un array con los valores de la base de datos

class AnimeController extends \Com\Daw2\Core\BaseController {
    
    //Función que se encarga de mostrar los últimos animes.
    public function index() {
        
        $data = [];
        
        //llamamos al modelo de Animes para que busque los 9 animes que se añadieron de último
        $modelAnime =  new \Com\Daw2\Models\AnimeModel();
        $ultimosAnimes = $modelAnime->ultimosAnimes();
        
        $data['animesMostrar'] = $ultimosAnimes;
        
        var_dump($data['animesMostrar']);
        
        $this->view->showViews(array('templates/headerShiro.view.php','/indexShiro.view.php','templates/footerShiro.view.php'), $data);        
    }
    

    public function buscarAnime() {
        $data = [];
        
        //Comprobamos que tenemos un nombre de anime válido
        if($this->checkAnimeName($_GET)){
            //Si está bien buscamos el nombre
            
            //llamamos al modelo de Animes para que busque todos los animes relacionados con lo que puso el usuario
            $modelUser =  new \Com\Daw2\Models\UsersModel();
            $userAddOk = $modelUser->register($_POST['username'], $_POST['email'], $_POST['password']);
            
            
            //AQUI LLAMAMOS A LA VISTA PERO CON LOS RESULTADOS
            var_dump($_SESSION);
            $this->view->showViews(array('templates/headerShiro.view.php','/indexShiro.view.php','templates/footerShiro.view.php'), $data);
            
        }
        //Si no sirve devolvemos a la página de inicio
        
        var_dump($_SESSION);
        $this->view->showViews(array('templates/headerShiro.view.php','/indexShiro.view.php','templates/footerShiro.view.php'), $data);
    }
    
    
    //Recibe un array como parámetro, $_GET
    //Devuelve true en caso de que el nombre del anime sea válido. Solo conteniendo letras, números, espacios y sin superar la longitud de 100 caracteres.
    private function checkAnimeName($get) : bool{
        
        if(isset($get['animeNameToSearch']) && !empty($get['animeNameToSearch']) && strlen($get['animeNameToSearch']) <= 100){
            
            if(preg_match("/[^A-Za-z0-9]/", $get['animeNameToSearch'])){
                return false;
            }
            
        }
        else{
            return false;
        }
        
        return true;
    }

}
