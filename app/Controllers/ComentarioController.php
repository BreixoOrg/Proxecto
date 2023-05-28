<?php

namespace Com\Daw2\Controllers;

class ComentarioController extends \Com\Daw2\Core\BaseController {
    
    //Función que se encarga de escribir un comentario y la llamamos desde la seccion del cap del anime, por eso lo devolvemos al lugar donde estaba
    public function escribirComentario() {
        
        //hacer check
        if($this->checkForm($_POST)){
            //llamar modelo
            $modelComent = new \Com\Daw2\Models\ComentarioModel();
            $ok = $modelComent->escribirComent($_POST['idSerieC'], $_POST['capituloC'], filter_var($_POST['comentarioEscrito'],FILTER_SANITIZE_SPECIAL_CHARS),$_SESSION['usuario']['username']);

            header("location: /shironime/verCap?idSerie=" . $_POST['idSerieC'] . "&capitulo=". $_POST['capituloC']);
        }
        else{
            //si cambió algo lo devolvemos al index
            header("location: /shironime");
        }
    }
    
    
    private function checkForm($post){
        
        if(!isset($_POST['idSerieC']) || !is_numeric($_POST['idSerieC']) || $_POST['idSerieC'] <= 0){
            return false;
        }
        
        if(!isset($_POST['capituloC']) || !is_numeric($_POST['capituloC']) || $_POST['capituloC'] <= 0){
            return false;
        }
        
        if(!isset($_POST['comentarioEscrito']) || !is_string($_POST['comentarioEscrito']) || strlen($_POST['comentarioEscrito']) < 0 || strlen($_POST['comentarioEscrito']) > 200){
            return false;
        }
        
        return true;
    }
    

}
