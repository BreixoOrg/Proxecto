<?php

namespace Com\Daw2\Core;

use Steampixel\Route;

class FrontController{
    
    static function main(){
        session_start();
        
        //En caso de no estar logeado solo puede ir a las direcciones dentro del if
        if (!isset($_SESSION['usuario'])) {

            //Si quieren registrarse o logearse 
            Route::add('/login',
                    function(){
                        $controlador = new \Com\Daw2\Controllers\UsersController();
                        $controlador->login();
                    }
                    , 'get');
                    
            Route::add('/register',
                    function(){
                        $controlador = new \Com\Daw2\Controllers\UsersController();
                        $controlador->login();
                    }
                    , 'get');

            Route::add('/login',
                    function(){
                        $controlador = new \Com\Daw2\Controllers\UsersController();
                        $controlador->loginProcess();
                    }
                    , 'post');
                    
            Route::add('/register',
                    function(){
                        $controlador = new \Com\Daw2\Controllers\UsersController();
                        $controlador->registerProcess();
                    }
                    , 'post');

            Route::pathNotFound(
                function () {
                    header('location: /login');
                }
            );
        }
        else{
            
            //Comprobamos que la subscripción sigue en vigor
            $userController = new \Com\Daw2\Controllers\UsersController();
            if (!$userController->subsEnVigor($_SESSION['usuario']['username'])) {
                //En caso de no tener subs
                Route::add('/buySub',
                    function(){
                        $controlador = new \Com\Daw2\Controllers\SubController();
                        $controlador->pago();
                    }
                    , 'get');
                    
                Route::add('/buySub',
                    function(){
                        $controlador = new \Com\Daw2\Controllers\SubController();
                        $controlador->pagoProcess();
                    }
                    , 'post');
                    
                Route::pathNotFound(
                    function () {
                        header('location: /buySub');
                    }
                 );
                
            }
            else{
            //En caso de tener dias de subscripción. Previamente ya estamos logeados
                
                Route::add('/shironime', 
                    function(){
                        $controlador = new \Com\Daw2\Controllers\AnimeController();
                        $controlador->index();
                    }
                    , 'get');
                    
                Route::add('/logout', 
                    function(){
                        $controlador = new \Com\Daw2\Controllers\UsersController();
                        $controlador->logout();
                    }
                    , 'get');


                Route::pathNotFound(
                    function(){
                        header('location: /shironime');
                    }
                );

                Route::methodNotAllowed(
                    function(){
                        $controller = new \Com\Daw2\Controllers\ErroresController();
                        $controller->error405();
                    }
                    );
                }
            }
        Route::run();
    }
}

