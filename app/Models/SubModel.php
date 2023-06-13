<?php

namespace Com\Daw2\Models;

class SubModel extends \Com\Daw2\Core\BaseModel {
    
    //Esta función devuelve true si el pago fue exitoso o false en caso de que falle
    function pagoOk(string $username, string $meses) : bool{
        $sql = "UPDATE usuario SET finalSubs= DATE_ADD(NOW(), INTERVAL :meses MONTH) WHERE username= :username AND baja = 0";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            "meses" => $meses,
            "username" => $username
        ]);
        
        return $stmt->rowCount() == 1;
    }
    
    
    //Esta función devuelve true si la renovación es exitosa o false en caso de que falle
    function renovarOk(string $username, string $meses) : bool{
        $sql = "UPDATE usuario set finalSubs = date_add(finalSubs, interval :meses MONTH) where username = :username and baja=0";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            "meses" => $meses,
            "username" => $username
        ]);
        
        return $stmt->rowCount() == 1;
    }
    
    
    //Esta función devuelve true si el cambio de shirocoins es exitoso o false en caso de que falle
    function changeShirocoinsOk(string $username, string $dias) : bool{
        $sql = "UPDATE usuario set finalSubs = date_add(finalSubs, interval :dias DAY) where username = :username and baja=0";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            "dias" => $dias,
            "username" => $username
        ]);
        
        return $stmt->rowCount() == 1;
    }
    
    
    
    
    
    
}
