<?php
namespace main;
require './../vendor/autoload.php';
require_once "config.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use DateTimeImmutable;

class Token {
    static function getAuthorization() {
        $token = getallheaders()['Authorization'];
        if (!empty($token)) {
            if(preg_match('/Bearer\s(\S+)/', $token, $matches)) {
                return $matches[1];
            }
        }
        return '';
    }

    static function encodeJWT($id) {
        $time = new DateTimeImmutable();
        $payload = [
            'exp' => $time->modify('+1 month')->getTimestamp(),
            'iat' => $time->getTimestamp(),
            'idU' => $id
        ];
        return JWT::encode($payload, key, 'HS256');
    }

    // Getter para el id del usuario
    static function decodeJWT() {
        $token = JWT::decode(self::getAuthorization(), new Key(key, 'HS256'));
        return $token->idU;
    }
}