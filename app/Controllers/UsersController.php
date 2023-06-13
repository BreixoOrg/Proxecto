<?php

namespace Com\Daw2\Controllers;

class UsersController extends \Com\Daw2\Core\BaseController{
    
    //Muestra la vista del login
    function login(){
        $this->view->show('loginAndRegister.view.php');
    }
    
    //Proceso de logearse
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
                //Al llegar aqui ya está logeado con éxito
                $_SESSION['usuario'] = $user;
                
                if($this->subsEnVigor($user['username'])){
                    header("location: /shironime");
                }
                else{
                    header("location: /buySub");
                }
                
            }
        }else{
            $data['erroresL'] = "El usuario o la contraseña son incorrectos";
            $this->view->showViews(array('loginAndRegister.view.php'),$data);
        }
        
    }
    
    //Proceso de registro
    function registerProcess(){
        
        //Si intentan logearse con un usuario ya registrado se lanza una excepción. Con este try catch resolvemos la excepción lanzando un mensaje de error.
        try{
        
            $data = [];

            $data['inputR'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            $errores = [];
            //Comprobamos que el usuario y la contraseña esten bien
            $errores = $this->checkUsernamePassword($_POST);

            //Comprobamos el email
            if(!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $errores['email'] = "Email no válido";
            }

            //Comprobamos si es string por si solo falló el email o si es un array por si fallo otro campo del checkUsernamePassword
            if(is_array($errores) && count($errores) == 0){

                //llamar al modelo para que inserte los datos
                $modelUser =  new \Com\Daw2\Models\UsersModel();
                $userAddOk = $modelUser->register($_POST['username'], $_POST['email'], $_POST['password']);

                if($userAddOk){
                    $user = $modelUser->selectUser($_POST['username']);
                    $_SESSION['usuario'] = $user;
                    header("location: /buySub");
                }

            }else{
                //cargamos los errores en $data y mostramos de nuevo el formulario
                $data['errores'] = $errores;
            }

            $this->view->showViews(array('loginAndRegister.view.php') , $data);
        }
        catch(\Exception $e){
            $data['errores']['catch'] = "El usuario ya existe";
            $this->view->showViews(array('loginAndRegister.view.php') , $data);
        }
    }
        
    
    function perfil(){
        
        $data = [];
        $data['styles'] = [
            0 =>"../assets/css/headerAndFooter.css",
            1 => "../assets/css/perfil.css"
        ];
        
        $modelUser = new \Com\Daw2\Models\UsersModel();
        $_SESSION['usuario'] = $modelUser->selectUser($_SESSION['usuario']['username']);
        
        $this->view->showViews(array('templates/headerShiro.view.php','/perfil.view.php','templates/footerShiro.view.php'), $data); 
    }
    
    function darseBaja(){
        $modelUser = new \Com\Daw2\Models\UsersModel();
        $modelUser->darseBaja($_SESSION['usuario']['username']);
        $this->logout();
    }
    
    //ya dejamos la funcion de logout hecha
    function logout(){
        session_destroy();
        header("location: /login");
    }
    
    //Comprueba que el usuario y la contraseña estén correctos
    //Devuelve un array de clave el campo que fallo y de valo el motivo del fallo
    //Si lo devuelve vacío significa que no hay ningún error
    private function checkUsernamePassword($post, bool $checkPass = true) : array{
        
        $errores = [];
        
        //USERNAME
        if(isset($post['username']) && !empty($post['username'])){
            
            if(preg_match("/[^A-Za-z0-9]/", $post['username'])){
                $errores['username'] = "El nombre de ususario debe de estar formado solo por letras y números";
            }
            
        }
        else{
            $errores['username'] = "El nombre de usuario no puede estar en blanco";
        }
        
        //PASSWORD
        //if por si no queremos comprobar la contraseña
        if($checkPass){
        
            if(isset($post['password']) && !empty($post['password'])){

                if(preg_match("/[^A-Za-z0-9.]/", $post['password'])){
                    $errores['password'] = "La contraseña debe estar formada solo por letras, números y \".\"";
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
    
    //Devuelve true en caso de que la subscripción siga en vigor
    //Devuelve falso en caso de que se acabase la subscripción
    //Solo la llamamos cuando sabemos que el username está bien escrito, como por ejemplo en $_SESSION['usuario]
    function subsEnVigor(string $username){
        
        $modelUser =  new \Com\Daw2\Models\UsersModel();
        $user = $modelUser->selectUser($username);

        if(is_null($user['finalSubs'])){
            return false;
        }
        
        return strtotime($user['finalSubs']) >= strtotime(date("Y-m-d",time()));
        
    }
    
}

