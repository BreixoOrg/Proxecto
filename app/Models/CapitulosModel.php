<?php

namespace Com\Daw2\Models;

class CapitulosModel extends \Com\Daw2\Core\BaseModel {
    
    //Deveulve un array con los datos del anime o NULL en caso de que no encuentre el anime
    function buscarDatosCapAnime($idSerie, $capitulo) {
        
        $sql = "SELECT * FROM capitulosAnime c LEFT JOIN animes a ON c.id_serie = a.id_serie  WHERE c.id_serie=:idSerie AND c.capitulo=:capitulo";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            "idSerie" => $idSerie,
            "capitulo" => $capitulo
        ]);
        
        if($stmt->rowCount() == 1){
            
            return $stmt->fetch();
        }
        
        return null;
    }
    
    
    //Devuelve el número de capítulos de una serie en concreto. Si devuelve 0 significa que no existe
    function totalCaps($idSerie){
        $sql = "SELECT count(capitulo) as capsTotales FROM capitulosAnime WHERE id_serie=:idSerie";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            "idSerie" => $idSerie
        ]);
        
        return $stmt->fetch()['capsTotales'];
        
    }
    
    
}
