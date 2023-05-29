<?php

namespace Com\Daw2\Controllers;

class SubController extends \Com\Daw2\Core\BaseController{
    
    private const TARGETA_NUM_DIGIT_MIN = 13;
    private const TARGETA_NUM_DIGIT_MAX = 18;
    
    //Array con clave=radioCheckValue y valor=meses_subs
    private const PLAN_PAGO = [
        "1" => 3,
        "2" => 6,
        "3" => 12
    ];
    
    //Array con clave=valorGet y valor=semanas
    private const PLAN_SHIROCOINS = [
        "300" => 1,
        "550" => 2,
        "1000" => 4
    ];
    
    private const CVV_NUM_DIGIT_MIN = 3;
    private const CVV_NUM_DIGIT_MAX = 4;
    
    //Vista del formulario de pago
    function pago(){
        $this->view->show('buySub.view.php');
    }
    
    //Proceso del formulario de pago
    function pagoProcess(){
        
        $data = [];
        
        $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        
        //Comprobamos que todos los datos sean correctos
        $errores = $this->checkDatosTargeta($_POST);
        
        if(count($errores) == 0){
        
            //Procedemos a canjear el plan de pago
            $modelSub = new \Com\Daw2\Models\SubModel();
            $pagoCorrecto = $modelSub->pagoOk($_SESSION['usuario']['username'], self::PLAN_PAGO[$_POST['radioPlanPago']]);
            
            if($pagoCorrecto){
                //Todo correcto
                header("location: /shironime");
            }else{
                //Falló
                $this->view->showViews(array('buySub.view.php'),$data);
               
            }
        }else{
            
                $data['errores'] = $errores;
            $this->view->showViews(array('buySub.view.php'),$data);
        }
        
    }
    
    
    //Proceso del formulario de pago pero en este se hace UPDATE de la fecha de SUB, sino la reescribe perdiendo dias de la misma
    function renovarProcess(){
        
        $data = [];
        
        $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        
        //Comprobamos que todos los datos sean correctos
        $errores = $this->checkDatosTargeta($_POST);
        
        if(count($errores) == 0){
        
            //Procedemos a canjear el plan de pago
            $modelSub = new \Com\Daw2\Models\SubModel();
            $pagoCorrecto = $modelSub->renovarOk($_SESSION['usuario']['username'], self::PLAN_PAGO[$_POST['radioPlanPago']]);
            
            if($pagoCorrecto){
                //Todo correcto
                header("location: /shironime");
            }else{
                //Falló
                $this->view->showViews(array('buySub.view.php'),$data);
               
            }
        }else{
            
                $data['errores'] = $errores;
            $this->view->showViews(array('buySub.view.php'),$data);
        }
        
    }
    
    
    //ZONA DE CANJEAR LAS SHIROCOINS
    
    function showCanjear() {
        $data = [];
        //cargar css
        $data['styles'] = [
            0 =>"../assets/css/headerAndFooter.css",
        ];
        
        $this->view->showViews(array('templates/headerShiro.view.php','/canjearShirocoinsRenovarSub.view.php','templates/footerShiro.view.php'),$data); 
    }
    
    function canjearShirocoins(){
        
        $data = [];
        
        $isOk = $this->checkChangeShirocoins($_GET);
        
        if($isOk){
        
            //Procedemos a canjear las shirocoins
            $modelSub = new \Com\Daw2\Models\SubModel();
            $pagoCorrecto = $modelSub->renovarOk($_SESSION['usuario']['username'], self::PLAN_SHIROCOINS[$_GET['shirocoins']]);
            
            if($pagoCorrecto){
                //Todo correcto
                $this->showDialog(false, "FELICIDADES! ", "Renovación exitosa");
                header("location: /shironime");
            }else{
                //Falló
                $errorModel = new \Com\Daw2\Controllers\ErroresController();
                $errorModel->showDialog(false, "ERROR: ", "No se pudo completar la transacción");
                header("location: /shironime");
               
            }
        }else{
            //Falló
            $errorModel = new \Com\Daw2\Controllers\ErroresController();
            $errorModel->showDialog(false, "ERROR: ", "No se pudo completar la transacción");
            header("location: /shironime");
        }
        
    }
    
    
    //Comprueba que el plan de pago el válido y que el usuario puede permitírselo
    private function checkChangeShirocoins($get){
        
        if(!isset($get['shirocoins']) || empty($get['shirocoins']) || !array_key_exists($get['shirocoins'], self::PLAN_SHIROCOINS)){
            return false;
        }
        
        if($_SESSION['usuario']['shirocoin'] < $get['shirocoins']){
            return false;
        }
        
        return true;
        
    }
    
    
    //Comprueba que el formulario de pago con targeta esté correcto
    //Devuelve un array con los campos y sus errores. Si está vacío significa que no existen errores.
    private function checkDatosTargeta($post) : array{
        
        $errores = [];
        
        //NOMBRE TITULAR
        if(isset($post['nombreTitular']) && is_string($post['nombreTitular'])){
            if(preg_match("/[^A-Za-z ]/", $post['nombreTitular'])){
                $errores['nombreTitular'] = "Solo se permiten letras y espacios";
            }
        }
        else{
            $errores['nombreTitular'] = "Inserte un nombre";
        }
        
        //NUMERO DE TARGETA
        if(isset($post['numeroTargeta']) && is_numeric($post['numeroTargeta'])){
            if(strlen($post['numeroTargeta']) < self::TARGETA_NUM_DIGIT_MIN || strlen($post['numeroTargeta']) > self::TARGETA_NUM_DIGIT_MAX){
                $errores['numeroTargeta'] = "La longitud de la targeta debe ser de " . self::TARGETA_NUM_DIGIT_MIN . " a " . self::TARGETA_NUM_DIGIT_MAX . " dígitos";
            }
        }
        else{
            $errores['numeroTargeta'] = "Inserte un numero de targeta";
        }
        
        //CVV
        if(isset($post['cvv']) && is_numeric($post['cvv'])){
            if(strlen($post['cvv']) < self::CVV_NUM_DIGIT_MIN || strlen($post['cvv']) > self::CVV_NUM_DIGIT_MAX){
                $errores['cvv'] = "La longitud del cvv debe ser de " . self::CVV_NUM_DIGIT_MIN . " a " . self::CVV_NUM_DIGIT_MAX . " dígitos";
            }
        }
        else{
            $errores['cvv'] = "Inserte su número de seguridad(CVV)";
        }
        
        //FECHA DE EXPIRACION
        if(isset($post['fechaExp']) && is_string($post['fechaExp'])){
            
            $arrFecha = explode("/",$post['fechaExp'] );
            
            if(is_array($arrFecha) && count($arrFecha) == 2){
                $strMes = $arrFecha[0];
                $strAnho = $arrFecha[1];
                
                if(is_numeric($strAnho) && is_numeric($strMes) && checkdate($strMes, 1, $strAnho)){
                    //Si el mes año es igual, pasamos a ver el mes. Si es menor lanzamos error. Si es mayor estaría bien por lo que no necesitamos comprobar mas
                    if((int)$strAnho == (int)date("y")){
                        if((int)$strMes < (int)date("m")){
                            $errores['fechaExp'] = "Fecha de expiració caducada";
                        }
                    }
                    else if((int)$strAnho < (int)date("y")){
                        $errores['fechaExp'] = "Fecha de expiració caducada";
                    }
                }
                else{
                    $errores['fechaExp'] = "Introduzca una fecha de expiración";
                }
                
            }
            else{
                $errores['fechaExp'] = "Introduzca una fecha de expiración";
            }
        }
        else{
            $errores['fechaExp'] = "Introduzca una fecha de expiración";
        }
        
        
        //PLAN DE PAGO
        if(!isset(self::PLAN_PAGO[$post['radioPlanPago']])){
            $errores['radioPlanPago'] = "Plan no válido";
        }
        
        
        return $errores;
    }
    
}

