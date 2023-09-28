<?php
namespace models;
use main\db_main as db;
class usuario {

    public static function register($body) {
        $hashPsw = password_hash($body->passU, PASSWORD_DEFAULT);
        $sql = (object) [
            'query' => 'INSERT INTO usuario(nombresU, apellidoUPaterno, apellidoUMaterno, correoU, passU, sexo, fechaNacimientoU) VALUES(?, ?, ?, ?, ?, ?, ?);',
            'params' => [
                $body->nombresU, 
                $body->apellidoUPaterno, 
                $body->apellidoUMaterno, 
                $body->correoU, 
                $hashPsw, 
                $body->sexo,
                $body->fechaNacimientoU
                ]
        ];
        return db::save($sql);
    }
    
    public static function accountExists($body) {
        $sql = (object) [
            'query' => 'SELECT * FROM usuario WHERE correoU = ?;',
            'params' => [$body->correoU]
        ];
        return (db::queryOne($sql)->rowCount() > 0);
    }
    
    public static function changePsw($body) {
        $hashPsw = password_hash($body->passU, PASSWORD_DEFAULT);
        $sql = (object) [
            'query' => 'UPDATE usuario SET passU = ? WHERE correoU = ?;',
            'params' => [$hashPsw, $body->correoU]
        ];
        return db::save($sql);
    }
}
?>