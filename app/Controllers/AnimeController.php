<?php

namespace Com\Daw2\Controllers;
/*CONTROLDAOR DE LA PAGINA DE INICIO DE LA WEB - /shironime*/

//Para pasar los animes SIEMPRE los pasaremos mediante $data['animesMostrar] siendo estos un array con los valores de la base de datos

class AnimeController extends \Com\Daw2\Core\BaseController {
    
    //Función que se encarga de mostrar los últimos animes.
    public function index() {
        
        $data = [];
        $data['styles'] = [
            0 =>"/assets/css/headerAndFooter.css",
            1 => "/assets/css/shironime.css"
        ];
        
        
        $data['ocultarNavAnimes'] = true;
        
        if($this->obtenerPage($_GET)){
            $page = $_GET['page'];
        }
        else{
            $page = 1;
        }
        
        
        //llamamos al modelo de Animes para que busque los 9 animes que se añadieron de último
        $modelAnime =  new \Com\Daw2\Models\AnimeModel();
        $ultimosAnimes = $modelAnime->ultimosAnimes($page);
        
        //Guardamos la página actual y calculamos las páginas totales que tenemos para mostrar
        $data['page'] = $page;
        $data['paginas'] = ceil($modelAnime->animesTotal() / $_ENV['animesPerPage']) ;
        
        $data['animesMostrar'] = $ultimosAnimes;
        
        //var_dump($data['animesMostrar']);
        
        $this->view->showViews(array('templates/headerShiro.view.php','/indexShiro.view.php','templates/footerShiro.view.php'), $data);        
    }
    
    
    /*Se accede mediante post*/
    /*Busca todos los animes relacionados con la string*/
    public function animeSerach() {
        $data = [];
        
        $data['styles'] = [
            0 =>"../assets/css/headerAndFooter.css",
            1 => "../assets/css/shironime.css"
        ];
        
        $data['ocultarNavAnimes'] = false;
        
        if($this->checkAnimeName($_POST)){
            $modelAnime =  new \Com\Daw2\Models\AnimeModel();
            
            $animes = $modelAnime->buscarAnimes($_POST['animeNameToSearch']);
        }
        else{
            $animes = $modelAnime->ultimosAnimes($page);
            $data['ocultarNavAnimes'] = true;
        }
        
        //para que no nos falle
        $data['page'] = 1;
        $data['paginas'] = ceil($modelAnime->animesTotal() / $_ENV['animesPerPage']) ;
        
        $data['animesMostrar'] = $animes;
        
        //var_dump($data['animesMostrar']);
        
        $this->view->showViews(array('templates/headerShiro.view.php','/indexShiro.view.php','templates/footerShiro.view.php'), $data); 
    }
    
    
    //Recibe un array como parámetro, $_GET
    //Devuelve true en caso de que el nombre del anime sea válido. Solo conteniendo letras, números, espacios y sin superar la longitud de 100 caracteres.
    private function checkAnimeName($get) : bool{
        
        if(isset($get['animeNameToSearch']) && !empty($get['animeNameToSearch']) && strlen($get['animeNameToSearch']) <= 100){
            
            if(preg_match("[^A-Za-z0-9 ]", $get['animeNameToSearch'])){
                return false;
            }
            
        }
        else{
            return false;
        }
        
        return true;
    }
    
    /*Comprueba si la página que le pasamos en válida y nos devuelve true en caso de estar bien, en caso contrario devolverá false*/
    private function obtenerPage($get){
        
        if(isset($get['page']) && !empty($get['page']) && is_numeric($get['page']) && $get['page'] >= 1){
            return true;
        }
        
        return false;
    }

}
