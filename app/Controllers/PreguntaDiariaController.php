<?php

namespace Com\Daw2\Controllers;

class PreguntaDiariaController extends \Com\Daw2\Core\BaseController {
    
    //Cuando entramos a la pregunta se hace mediante esta función
    function iniciarPregunta() {
        
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
                //Actualizamos en la variale _SESSION la fecha de la pregunta para que no pueda salir y entrar repetidas veces
                $user = $modelUsers->selectUser($_SESSION['usuario']['username']);
                $_SESSION['usuario']['ultimaPregRespond'] = $user['ultimaPregRespond'];
                
                //guardamos los datos para no perderlos para luego validar
                $_SESSION['respuestaDiariaCorrecta'] = $regPregunta['respuestaCorr'];
                $_SESSION['premio'] = $regPregunta['premio'];
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
    
    function comprobarPregunta() {
        
        $data = [];
        
        //cargar css
        $data['styles'] = [
            0 =>"../assets/css/headerAndFooter.css",
            1 => "../assets/css/shironime.css"
        ];
        
        
        if($this->checkRespuestaUser($_POST)){
            //La respuesta es válida para ser procesada
            if($_SESSION['respuestaDiariaCorrecta'] == $_POST['respuestaDiaria']){
                //Calculamos la nueva cantidad de Shirocins que posee
                $shirocoinsAct = $_SESSION['usuario']['shirocoin'] + $_SESSION['premio'];
                
                //Llamar al modelo para introducir las shirocoins en la cuenta                
                $modelUser = new \Com\Daw2\Models\UsersModel();
                $actOk = $modelUser->actualizarShirocoins($_SESSION['usuario']['username'], $shirocoinsAct);
                
                if($actOk){
                    //actualizamos en la variable SESSION las shirocoins que posee
                    $_SESSION['usuario']['shirocoin'] = $shirocoinsAct;
                    
                    //Devolver dialog con mensaje de éxito
                    $txtNormal = ' ganaste ' . $_SESSION['premio'] . ' Shirocoins';
                    
                    $errorModel = new \Com\Daw2\Controllers\ErroresController();
                    $errorModel->showDialog( true, 'FELICIDADES!', $txtNormal);
                    
                }
                else{
                    //Devolver dialog con mensaje
                    $errorModel = new \Com\Daw2\Controllers\ErroresController();
                    $errorModel->showDialog(false, "ERROR: ", "No se pudo completar la transacción");
                }
                
            }
            else{
                //Mostrar dialog con mensaje
                $errorModel = new \Com\Daw2\Controllers\ErroresController();
            $errorModel->showDialog(false, "FALLASTE: ", "Vuelva a intentarlo mañana");
            }
        }
        else{
            //Respuesta no válida, mostrar mensaje dialog
            $errorModel = new \Com\Daw2\Controllers\ErroresController();
            $errorModel->showDialog(false, "ERROR: ", "No se pudo completar la transacción");
        }
        
        //Eliminamos estas variables de SESSION ay que ya no harán falta
        unset($_SESSION['respuestaDiariaCorrecta']);
        unset($_SESSION['premio']);
        
        //devolvemos al index
        header("location: /shironime");
    }
    
    
    //Devuelve TRUE en caso de que el ultimo dia que participo no es el de hoy o FALSE si ya participó el día de hoy
    private function checkFechaParticipar($ultimaPregRespond) {
        $fecha_actual = strtotime(date("Y-m-d",time()));
        $fecha_user = strtotime($_SESSION['usuario']['ultimaPregRespond']);
        
        if($fecha_actual <= $fecha_user){
            return false;
        }
        return true;
        
    }
    
    //Devuelve TRUE en caso de que en el array exista la posicion respuestaDiaria y esta solo tenga letras, espacios y números
    //Devuelve FALSE en caso de uqe no exista o de que encuentre algo distinto a letras, números y espacios
    private function checkRespuestaUser($post){
        
        //El count es necesario ya que podrían cambiar el nombre de los 4 checks y tener más probabilidad de acertar
        if(isset($post['respuestaDiaria']) && !empty($post['respuestaDiaria']) && count($post) == 1 && is_string($post['respuestaDiaria'])){
            if(preg_match("/[^A-Za-z0-9 ]/", $post['respuestaDiaria'])){
                return false;
            }
        }
        else{
            return false;
        }
        
        return true;
    }
    
}
