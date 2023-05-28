<?php

namespace Com\Daw2\Controllers;
/*CONTROLDAOR DE LA PAGINA DE INICIO DE LA WEB - /shironime*/

//Para pasar los animes SIEMPRE los pasaremos mediante $data['animesMostrar] siendo estos un array con los valores de la base de datos

class CapitulosController extends \Com\Daw2\Core\BaseController {
    
    //Llamamos a esta función cuando cargamos un vídeo por el método GET
    function mostrarCap(){
        
        $data = [];
        //cargar css
        $data['styles'] = [
            0 =>"/assets/css/headerAndFooter.css",
            1 => "/assets/css/reproducirCapAnime.css"
        ];
        
        
        //comprobar que nos pasan parámetros válidos
        if($this->checkCapituloIdserie($_GET)){
            
            //llamamos al modelo de los capítulos
            $modelCapitulos = new \Com\Daw2\Models\CapitulosModel();
            
            //obtenemos el número de capítulos totales
            $numeroCapsTotal = $modelCapitulos->totalCaps($_GET['idSerie']);
            
            //si no tiene capítulos significa que buscaron algo distinto a lo presentado, se devuelve al index en caso de fallo
            if($numeroCapsTotal !== 0){
                
                //buscamos el capítulo con sus datos
                $datosCap = $modelCapitulos->buscarDatosCapAnime($_GET['idSerie'], $_GET['capitulo']);
                
                if(!is_null($datosCap)){
                    //si llegamos aqui tenemos los caps totales y los datos del capítulo
                    $data['capsTotales'] = $numeroCapsTotal;
                    $data['capMostrar'] = $datosCap;
                    
                    
                    //QUEDA HACER LA PARTE DE LOS COMENTARIOS
                    //llamamos al modelo de los comentarios
                    $modelComentarios = new \Com\Daw2\Models\ComentarioModel();
                    $coments = $modelComentarios->comentariosRecientes($_GET['idSerie'], $_GET['capitulo']);
                    
                    if(!is_null($coments)){
                        $data['coments'] = $coments; 
                    }
                    
                    
                }
                else{
                    //si falla encontrando capítulo lo devolvemos al index
                    header('location: /shironime');
                }
                
            }
            else{
                //si nos pasan un parámetro no deseado los redirigimos al index
                header('location: /shironime');
            }
            
            //obtener el numero total de caps de la serie(para la paginacion)
        }else{
            //si nos pasan un parámetro no deseado los redirigimos al index
            header('location: /shironime');
        }
        
                
        $this->view->showViews(array('templates/headerShiro.view.php','/reproducirCapAnime.view.php','templates/footerShiro.view.php'), $data); 
    }
    
    /*Devuelve TRUE en caso de que el capitulo y el id sean números válidos*/
    private function checkCapituloIdserie($get) {
        if(!isset($get['idSerie']) || empty($get['idSerie']) || !is_numeric($get['idSerie']) || $get['idSerie'] <= 0){
            return false;
        }
        
        if(!isset($get['capitulo']) || empty($get['capitulo']) || !is_numeric($get['capitulo']) || $get['capitulo'] <= 0){
            return false;
        }
        
        return true;
    }

}
