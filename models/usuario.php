<?php

namespace models;

use main\db_main as db;

class usuario
{
    // Utiliza una transacción para ejectuar dos consultas
    // La primera inserta al usuario y la segunda le da el permiso default de usuario
    public static function register($body)
    {
        $hashPsw = password_hash($body->passU, PASSWORD_DEFAULT);
        $sqls = (object) [
            (object) [
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
            ],
            (object) [
                'query' => 'INSERT INTO usuarioperfil(idUsuario, idPerfil) VALUES(LAST_INSERT_ID(), 14);',
                'params' => []
            ]
        ];
        return db::save_transaction_PDO($sqls);
    }

    // Checa si la cuenta existe
    public static function accountExists($body)
    {
        $sql = (object) [
            'query' => 'SELECT * FROM usuario WHERE correoU = ?;',
            'params' => [$body->correoU]
        ];
        return (count((array)db::queryOne($sql)) > 0);
    }

    public static function changePsw($body)
    {
        $hashPsw = password_hash($body->passU, PASSWORD_DEFAULT);
        $sql = (object) [
            'query' => 'UPDATE usuario SET passU = ? WHERE correoU = ?;',
            'params' => [$hashPsw, $body->correoU]
        ];
        return db::save($sql);
    }
}
