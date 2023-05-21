<?php

namespace Com\Daw2\Core;

use Steampixel\Route;

class FrontController{
    
    static function main(){
        session_start();
        
        if (!isset($_SESSION['usuario'])) {
            //login

            Route::add('/login',
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

            Route::pathNotFound(
                function () {
                    header('location: /login');
                }
            );
        }
        else{
        
            Route::add('/', 
                    function(){
                        $controlador = new \Com\Daw2\Controllers\InicioController();
                        $controlador->index();
                    }
                    , 'get');


            Route::pathNotFound(
                function(){
                    $controller = new \Com\Daw2\Controllers\ErroresController();
                    $controller->error404();
                }
            );

            Route::methodNotAllowed(
                function(){
                    $controller = new \Com\Daw2\Controllers\ErroresController();
                    $controller->error405();
                }
                );
            }
        Route::run();
    }
}

