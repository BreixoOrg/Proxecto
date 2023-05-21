<?php

namespace Com\Daw2\Controllers;

class UsersController extends \Com\Daw2\Core\BaseController{
    
    function login(){
        $this->view->show('loginAndRegister.view.php');
    }
    
    function loginProcess(){
        $modelUser = new \Com\Daw2\Models\UsersModel();
        
        $user = $modelUser->login($_POST['username'], $_POST['pass']);
        
        if(is_null($user)){
            $data['loginError'] = "Datos introducidos oncorrectos";
            $this->view->show('login.view.php',$data);
            
        }else{
            
            $_SESSION['usuario'] = $user;
            $this->view->showViews(array('templates/header.view.php', 'inicio.view.php', 'templates/footer.view.php'));
        }
        
    }
    
    //Register aqui
    
    function logout(){
        session_destroy();
        header("location: /login");
    }
    
}

