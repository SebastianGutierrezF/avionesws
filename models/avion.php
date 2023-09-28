<?php
namespace models;
use main\db_main as db;

class avion {
    public static function getAviones() {
        $sql = (object) [
            'query' => 'SELECT * FROM getAviones;',
            'params' => []
        ];
        return db::queryAll($sql);
    }
    
    public static function getAvion($params) {
        $sql = (object) [
            'query' => 'SELECT * FROM getAviones WHERE idA = ?;',
            'params' => [$params->idA]
        ];
        return db::queryOne($sql);
    }
    
    public static function addAvion($body) {
        $sql = (object) [
            'query' => 'INSERT INTO avion(modelo, anio, marca, imgA) VALUES(?, ?, ?, ?);',
            'params' => [$body->modelo, $body->anio, $body->marca, $body->imgA]
        ];
        return db::save($sql);
    }
    
    public static function editAvion($body) {
        $sql = (object) [
            'query' => 'UPDATE avion SET modelo = ?, anio = ?, marca = ?, imgA = ? WHERE idA = ?;',
            'params' => [$body->modelo, $body->anio, $body->marca, $body->imgA, $body->idA]
        ];
        return db::save($sql);
    }
    
    public static function deleteAvion($params) {
        $sql = (object) [
            'query' => 'DELETE FROM avion WHERE idA = ?;',
            'params' => [$params->idA]
        ];
        return db::save($sql);
    }
    
    public static function getMarcas() {
        $sql = (object) [
            'query' => 'SELECT * FROM marca;',
            'params' => []
        ];
        return db::queryAll($sql);
    }

}