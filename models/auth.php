<?php
require_once '../connection.php';
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
class Auth extends Connection {
    function login($body) {
        $db = parent::db();
        $query = 'SELECT * FROM usuario WHERE correoU = ?;';
        $query = $db->prepare($query);
        $query->bindValue(1, $body->correoU);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        $response['status'] = false;
        if (password_verify($body->passU, $result->passU)) {
            $response['status'] = true;
            $response['nombreU'] = self::makeName($result->nombresU, $result->apellidoUPaterno);
            $response['adminU'] = $result->adminU;
            $response['token'] = parent::encodeJWT($result->idU);
        }
        return $response;
    }

    private function makeName($names, $lastName) {
        $fullName = $names;
        if (str_contains($names, ' ')) {
            $fullName = explode(' ', $names, 1)[0];
        }
        $fullName = $fullName . ' ' . $lastName;
        return $fullName;
    }
}
?>