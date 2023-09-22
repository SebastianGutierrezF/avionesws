<?php
require_once '../connection.php';

class Avion extends Connection {
    function getAviones() {
        $db = parent::db();
        $query = $db->prepare('SELECT * FROM getAviones;');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    function getAvion($body) {
        $db = parent::db();
        $query = $db->prepare('SELECT * FROM getAviones WHERE id = ?;');
        $query->bindValue(1, $body->id);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    function addAvion($body) {
        $db = parent::db();
        $query = $db->prepare('INSERT INTO avion(modelo, anio, marca, imgA) VALUES(?, ?, ?, ?);');
        $query->bindValue(1, $body->modelo);
        $query->bindValue(2, $body->anio);
        $query->bindValue(3, $body->marca);
        $query->bindValue(4, $body->img);
        return $query->execute();
    }
    
    function editAvion($body) {
        $db = parent::db();
        $query = $db->prepare('UPDATE avion SET modelo = ?, anio = ?, marca = ? WHERE idA = ?;');
        $query->bindValue(1, $body->modelo);
        $query->bindValue(2, $body->anio);
        $query->bindValue(3, $body->marca);
        $query->bindValue(4, $body->id);
        return $query->execute();
    }
    
    function deleteAvion($body) {
        $db = parent::db();
        $query = $db->prepare('DELETE FROM avion WHERE idA = ?;');
        $query->bindValue(1, $body->id);
        return $query->execute();
    }
    
    function getMarcas() {
        $db = parent::db();
        $query = $db->prepare('SELECT * FROM marca;');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}