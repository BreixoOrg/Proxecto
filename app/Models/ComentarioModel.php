<?php

namespace Com\Daw2\Models;

class ComentarioModel extends \Com\Daw2\Core\BaseModel {
    
    //Deveulve un array con los 5 últimos comenatrios del capitulo de una serie en concreto
    //Si no encuentra comenatrios devolverá NULL
    function comentariosRecientes($idSerie, $capitulo, $page = 1) {
        
        $sql = "SELECT * FROM comentario WHERE codCap =:idSerie AND capitulo =:capitulo ORDER BY fechaTxt desc,idComentario desc";
        
        $sql = $this->limitarQuery($sql,$page);
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            "idSerie" => $idSerie,
            "capitulo" => $capitulo
        ]);
        
        if($stmt->rowCount() >= 1){
            
            return $stmt->fetchAll();
        }
        
        return null;
    }
    
    //Añade en la tabla comentarios un nuevo comentario
    function escribirComent($idSerie, $capitulo,$txtC,$username){
        
        $sql = "INSERT INTO comentario (codCap, capitulo, txt, username) VALUES(:idSerie, :capitulo, :comentario, :username)";
        
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([
            "idSerie" => $idSerie,
            "capitulo" => $capitulo,
            "comentario" => $txtC,
            "username" => $username
        ]);
    }
    
    //Devuelve la string de la query según la parte de los comenatrios que que le pasemos
    private function limitarQuery( string $sql, $page = 1){
        
        $offset = ($page - 1) * $_ENV['comentariosPerPage'];
        
        $sql .= " LIMIT " . $_ENV['comentariosPerPage'] . " OFFSET " . $offset ;
        
        return $sql;
        
    }
    
    
}
