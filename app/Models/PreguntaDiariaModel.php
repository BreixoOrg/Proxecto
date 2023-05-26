<?php

namespace Com\Daw2\Models;

class PreguntaDiariaModel extends \Com\Daw2\Core\BaseModel {
    
    //Devuelve una pregunta al azar
    function preguntaRandom(){
        $sql = "SELECT * FROM preguntas ORDER BY rand() LIMIT 1";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    
}
