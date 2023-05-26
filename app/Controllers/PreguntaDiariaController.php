<?php

namespace Com\Daw2\Controllers;

class PreguntaDiariaController extends \Com\Daw2\Core\BaseController {
    
    public function iniciarPregunta() {
        
        $data = [];
        
        //cargar css
        $data['styles'] = [
            0 =>"../assets/css/headerAndFooter.css",
            1 => "../assets/css/preguntaDiaria.css"
        ];
        
        
        //Primero comprobamos si ya participó el día de hoy mirando en Tabla usuario la ultimaPregRespon
        if(!is_null($_SESSION) && $this->checkFechaParticipar($_SESSION['usuario']['ultimaPregRespond'])){
            //Si aun no participó, registramos en la tabla el día de hoy y pedimos la pregunta para mostrar
            
            $modelPreguntaDiaria = new \Com\Daw2\Models\PreguntaDiariaModel();
            $regPregunta = $modelPreguntaDiaria->preguntaRandom();
            
            var_dump($regPregunta);
            //separamos las preguntas
            $respuestasPosibles = array(
                "r1" => $regPregunta['r1'],
                "r2" => $regPregunta['r2'],
                "r3" => $regPregunta['r3'],
                "r4" => $regPregunta['r4']
            );
            
            //variamos el orden para que nunca sea igual
            shuffle($respuestasPosibles);
            
                        
            //llamamos al modelo de usuarios para que actualice el dia de la pregunta
            $modelUsers = new \Com\Daw2\Models\UsersModel();
            $regUserModificado = $modelUsers->actualizarDiaPregDiaria($_SESSION['usuario']['username']);
            
            //si el usuario fue modificado con éxito guardamos los datos y mostramos
            if($regUserModificado){
                $user = $modelUsers->selectUser($_SESSION['usuario']['username']);
                $_SESSION['usuario']['ultimaPregRespond'] = $user['ultimaPregRespond'];
                
                //guardamos los datos para no perderlos para luego validar
                $_SESSION['respuestaDiariaCorrecta'] = $regPregunta['respuestaCorr'];
                $data['pregunta'] = $regPregunta['pregunta'];
                $data['respuestasPosibles'] = $respuestasPosibles;
            }
            else{
                $data['error'] = 'Vuelva a recargar la página. Si el error persiste póngase en contacto con nosotros.' ;
            }
        }
        else{
            //En caso de que haya participado le mostraremos un mensaje conforme no puede participar hasta mañana
            $data['error'] = 'No tiene acceso hasta mañana debido a que ya entró en otro momento a intentarlo.' ;
        }
        
        $this->view->showViews(array('templates/headerShiro.view.php','/preguntaDiaria.view.php','templates/footerShiro.view.php'), $data);  
        
    }
    
    //devuelve TRUE en caso de que el ultimo dia que participo no es el de hoy o FALSE si ya participó el día de hoy
    private function checkFechaParticipar($ultimaPregRespond) {
        $fecha_actual = strtotime(date("Y-m-d",time()));
        $fecha_user = strtotime($_SESSION['usuario']['ultimaPregRespond']);
        
        if($fecha_actual <= $fecha_user){
            return false;
        }
        return true;
        
    }
    
}
