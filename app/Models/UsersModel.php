<?php

namespace Com\Daw2\Models;

class UsersModel extends \Com\Daw2\Core\BaseModel {
    
    //Devuelve un array con los datos del usuario
    //En caso de que no exista el usuario o la contraseña esté mal devuelve NULL
    function login(string $username, string $pass){
        $sql = "SELECT * FROM usuario WHERE username = :username AND baja = 0";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            "username" => $username
        ]);
        
        if($stmt->rowCount() == 1){
            
            $userDates = $stmt->fetchAll()[0];
            //var_dump($userDates);die();
            if(password_verify($pass, $userDates['password'])){
                unset($userDates['password']);
                return $userDates;
            }
        }
        
        return null;
    }
    
    
    //Proceso de registro que devuelve TRUE en caso de que se registre exitosamente. Devuelve FALSE en caso de que no se registrase
    function register(string $username, string $email, string $password) : bool{
        
        $registro = [];
        
        $sql = "INSERT INTO proxecto.usuario (email, password, username, shirocoin, finalSubs, baja) VALUES(:email, :password, :username, 0, NULL, 0)" ;

        $encryptPass = password_hash($password, PASSWORD_DEFAULT);

        $registro['password'] = $encryptPass;
        $registro['email'] = $email;
        $registro['username'] = $username;

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute($registro);
    }
    
    //Selecciona los datos de un usuario pasándole un USERNAME
    function selectUser(string $username){
        $sql = "SELECT * FROM usuario WHERE username = :username AND baja = 0";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            "username" => $username
        ]);
        
        return $stmt->fetchAll()[0];
    }
    
    //Selecciona los datos de un usuario pasándole un USERNAME
    function updateShirocoins(int $shirocoins,string $username){
        $sql = "UPDATE usuario set shirocoin = :shirocoins where username = :username and baja=0";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            "shirocoins" => $shirocoins,
            "username" => $username
        ]);
        
        return $stmt->fetchAll()[0];
    }
    
    //Devuelve TRUE en caso de que pudiese actualizar la fecha del usuario o FALSE en caso contrario
    function actualizarDiaPregDiaria($username){
        $sql = "UPDATE usuario SET ultimaPregRespond=NOW() WHERE username=:username AND baja = 0";
        
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([
            "username" => $username
        ]);
    }
    
    //Devuelve TRUE en caso de que pudiese actualizar la cantidad de shirocoins del usuario o FALSE en caso contrario
    function actualizarShirocoins($username,$shirocoins){
        
        $sql = "UPDATE usuario SET shirocoin=:shirocoins WHERE username=:username AND baja = 0";
        
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([
            "shirocoins" => $shirocoins,
            "username" => $username
        ]);
    }
    
    function darseBaja($username){
        $sql = "UPDATE usuario SET baja=1 WHERE username=:username";
        
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([
            "username" => $username
        ]);
    }
    
}
