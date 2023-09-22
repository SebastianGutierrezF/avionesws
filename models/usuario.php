<?php
require_once '../connection.php';
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

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
}
?>