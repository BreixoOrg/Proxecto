<?php

namespace Com\Daw2\Models;

class UsersModel extends \Com\Daw2\Core\BaseModel {
    
    
    function login(string $email, string $pass){
        $sql = "SELECT...";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([$email]);
        
        if($stmt->rowCount() == 1){
            
            $userDates = $stmt->fetchAll()[0];
            //var_dump($userDates);die();
            if(password_verify($pass, $userDates['pass'])){
                unset($userDates['pass']);
                return $userDates;
            }
        }
        
        return null;
    }
    
    //Register Aqui
    
    
}
