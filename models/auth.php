<?php
namespace models;
use main\db_main as db;
use main\Token as token;

class Auth {

    static function login($body) {
        $sql = (object) [
            'query' => 'SELECT * FROM usuario WHERE correoU = ?;',
            'params' => [$body->correoU]
        ];
        $result = db::queryOne($sql);
        $response = [];
        if (password_verify($body->passU, $result->passU)) {
            $response['status'] = true;
            $response['nombreU'] = self::makeName($result->nombresU, $result->apellidoUPaterno);
            $response['token'] = token::encodeJWT($result->idU);
            $response['modulos'] = self::getModulos($result->idU);
        } else { $response['status'] = false; }
        return $response;
    }

    private static function makeName($names, $lastName) {
        $fullName = $names;
        if (str_contains($names, ' ')) {
            $fullName = explode(' ', $names, 1)[0];
        }
        $fullName = $fullName . ' ' . $lastName;
        return $fullName;
    }

    public static function getPermissions($idU) {
        $sql = (object)[
            "query"     =>  "SELECT * FROM getpermissions WHERE idU = ?;",
            "params"    =>  [$idU]
        ];
        return db::queryAll($sql);
    }
    
    private static function getModulos($idU) {
        $sql = (object)[
            "query"     =>  "SELECT * FROM getmodulos WHERE idU = ? ORDER BY orden;",
            "params"    =>  [$idU]
        ];
        return db::queryAll($sql);

    }
}
?>