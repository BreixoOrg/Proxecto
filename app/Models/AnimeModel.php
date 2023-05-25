<?php

namespace Com\Daw2\Models;

class AnimeModel extends \Com\Daw2\Core\BaseModel {
    
    //Busca todos los animes que contengan el String pasado como parámetro.
    //Pasar el String en formato en minúscula OBLIGATORIO para su correcto funcionamiento con la Base de Datos.
    function buscarAnimes(string $animeName){
        $sql = "SELECT * FROM animes WHERE nombre LIKE :animeName";
        
        $stmt = $this->pdo->prepare($sql);
        
        $animeName .= "%";
        
        $stmt->execute([
            "animeName" => $animeName,
        ]);
        
        return $stmt->fetchAll();
    }
    
    
    //Busca los últimos 9 animes que se añadieron en base a su id_serie
    function ultimosAnimes(int $page = 1){
        $sql = "SELECT * FROM animes ORDER BY id_serie DESC";
        
        $sql = $this->limitarQuery($sql,$page);
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    /*Devuelve el número de animes total que existe en la web*/
    function animesTotal(){
        $sql = "SELECT * FROM animes";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute();
        
        return $stmt->rowCount();
    }
    
    //Devuelve la string de la query según la página que se le introduzca. En caso de que no se le diga nada tomará la primera página.
    private function limitarQuery( string $sql, $page = 1){
        
        $offset = ($page - 1) * $_ENV['animesPerPage'];
        
        $sql .= " LIMIT " . $_ENV['animesPerPage'] . " OFFSET " . $offset ;
        
        return $sql;
        
    }
    
    
}
