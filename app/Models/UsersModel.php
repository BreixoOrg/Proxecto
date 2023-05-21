<?php

namespace Com\Daw2\Models;

class UsersModel extends \Com\Daw2\Core\BaseModel {
    
    
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
    
    
    //Register Aqui
    function register(string $username, string $email, string $password){
        
        $registro = [];
        
        $sql = "INSERT INTO proxecto.usuario (email, password, username, shirocoin, finalSubs, baja) VALUES(:email, :password, :username, 0, NULL, 0)" ;

        $encryptPass = password_hash($password, PASSWORD_DEFAULT);

        $registro['password'] = $encryptPass;
        $registro['email'] = $email;
        $registro['username'] = $username;

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute($registro);
    }
    
    
}
