<?php
require_once '../connection.php';

class Usuario extends Connection {

    function register($body) {
        $db = parent::db();
        $query = 'INSERT INTO usuario(nombresU, apellidoUPaterno, apellidoUMaterno, correoU, passU) VALUES(?, ?, ?, ?, ?);';
        $query = $db->prepare($query);
        $query->bindValue(1, $body->nombresU);        
        $query->bindValue(2, $body->apellidoUPaterno);        
        $query->bindValue(3, $body->apellidoUMaterno);        
        $query->bindValue(4, $body->correoU);
        $query->bindValue(5, password_hash($body->passU, PASSWORD_DEFAULT));
        return $query->execute();
    }
    
    function accountExists($body) {
        $db = parent::db();
        $query = 'SELECT * FROM usuario WHERE correoU = ?;';
        $query = $db->prepare($query);
        $query->bindValue(1, $body->correoU);
        $query->execute();
        return ($query->rowCount() > 0);
    }
    
    function changePsw($body) {
        $db = parent::db();
        $query = 'UPDATE usuario SET passU = ? WHERE correoU = ?;';
        $query = $db->prepare($query);
        $query->bindValue(1, password_hash($body->passU, PASSWORD_DEFAULT));
        $query->bindValue(2, $body->correoU);
        return $query->execute();
    }
}
?>