<?php

require './../vendor/autoload.php';
require_once "config/config.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Connection
{
    private $link;

    // Getter function to get link to the db
    protected function db() {
        if (!(isset($this->link))) {
            try {
                $dsn = 'mysql:host='.host.';dbname='.db;
                $this->link = new PDO($dsn, user, psw);
                $this->link->query("SET NAMES ".charset);
                return $this->link;
            } catch (PDOException $e) {
                echo 'Connection to the database failed with the following error: '.$e;
            }
        } else {
            return $this->link;
        }
    }

    protected function getAuthorization() {
        $token = getallheaders()['Authorization']; 
        if (!empty($token)) {
            if(preg_match('/Bearer\s(\S+)/', $token, $matches)) {
                return $matches[1];
            }
        }
        return '';
    }

    protected function encodeJWT($id) {
        $time = new DateTimeImmutable();
        $payload = [
            'exp' => $time->modify('+1 month')->getTimestamp(),
            'iat' => $time->getTimestamp(),
            'token' => $id
        ];
        return JWT::encode($payload, key, 'HS256');
    }

    protected function authorize() {
        try {
            JWT::decode($this->getAuthorization(), new Key(key, 'HS256'));
            return true;
        } catch (RuntimeException $e) {
            http_response_code(401);
            return false;
        }
    }

    // Should be used after an authorize function so no need to verify token validity
    protected function decodeJWT() {
        $token = JWT::decode($this->getAuthorization(), new Key(key, 'HS256'));
        return $token->id;
    }
}