<?php

namespace Com\Daw2\Controllers;

class UsersController extends \Com\Daw2\Core\BaseController{
    
    function login(){
        $this->view->show('loginAndRegister.view.php');
    }
    
    function loginProcess(){
        
        $data = [];
        
        $modelUser = new \Com\Daw2\Models\UsersModel();
        
        $data['inputL'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        
        //en este caso solo el username dará error
        $errores = $this->checkUsernamePassword($_POST,false);
        
        if(count($errores) == 0){
        
            $user = $modelUser->login($_POST['username'], $_POST['password']);

            if(is_null($user)){
                $data['erroresL'] = "El usuario o la contraseña son incorrectos";
                $this->view->show('loginAndRegister.view.php',$data);

            }else{
                //Poner variable usuario en session y pasar a ver si tiene subscripcion o necesita renovar
                var_dump("Logeado con exito");die();
                $_SESSION['usuario'] = $user;
                $this->view->showViews(array('templates/header.view.php', 'inicio.view.php', 'templates/footer.view.php'));
            }
        }else{
            $data['erroresL'] = "El usuario o la contraseña son incorrectos";
            $this->view->showViews(array('loginAndRegister.view.php'),$data);
        }
        
    }
    
    //Register aqui
    function registerProcess(){
        
        $data = [];
        
        $data['inputR'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        
        $errores = [];
        //Comprobamos que el usuario y la contraseña esten bien
        $errores = $this->checkUsernamePassword($_POST);
        
        //Comprobamos el email
        if(!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errores['email'] = "Email no válido";
        }
        
        if(is_array($errores) && count($errores) == 0){
            
            //llamar al modelo para que inserte los datos
            $modelUser =  new \Com\Daw2\Models\UsersModel();
            $userAddOk = $modelUser->register($_POST['username'], $_POST['email'], $_POST['password']);
            
            if($userAddOk){
                //llevarlo a la pantalla de compra
                var_dump("Añadido exitosamente");die();
            }
            
        }else{
            $data['errores'] = $errores;
        }
        
        $this->view->showViews(array('loginAndRegister.view.php') , $data);
        
    }
    
    //ya dejamos la funcion de logout hecha
    function logout(){
        session_destroy();
        header("location: /login");
    }
    
    //Comprueba que el usuario y la contraseña estén correctos
    //Devuelve un array de clave el campo que fallo y de valo el motivo del fallo
    private function checkUsernamePassword($post, bool $checkPass = true){
        
        $errores = [];
        
        if(isset($post['username']) && !empty($post['username'])){
            
            if(preg_match("/[^A-Za-z0-9]/", $post['username'])){
                $errores['username'] = "El nombre de ususario debe de estar formado solo por letras y números";
            }
            
        }
        else{
            $errores['username'] = "El nombre de usuario no puede estar en blanco";
        }
        
        if($checkPass){
        
            if(isset($post['password']) && !empty($post['password'])){

                if(preg_match("/[^A-Za-z0-9.]/", $post['password'])){
                    $errores['password'] = "La contraseñ debe estar formada solo por letras, números y \".\"";
                }

                if(!preg_match("/[A-Z]{1,}/", $post['password'])){
                    $errores['password'] = "La contraseña debe contener una letra mayúscula mínimo";
                }

                if(!preg_match("/[a-z]{1,}/", $post['password'])){
                    $errores['password'] = "La contraseña debe contener una letra minúscula mínimo";
                }

                if(!preg_match("/[0-9]{1,}/", $post['password'])){
                    $errores['password'] = "La contraseña debe contener un número como mínimo";
                }

            }
            else{
                $errores['password'] = "La contraseña no puede estar en blanco";
            }
        }
        
        return $errores;
    }
    
}

