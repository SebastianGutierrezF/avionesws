<?php

namespace main;

require_once 'config.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Throwable;
use Exception;
use PDO;

class db_main
{

    public static function connect() {
        return new PDO('mysql:host=' . host . ';dbname=' . db, user, psw);
    }

    /**
        Método para hacer un simple save con la estructura PDO
        (INSERT, UPDATE, DELETE)
     **/
    public static function save($obj)
    {
        $array = [];
        try {
            $db = self::connect();
            $stmt = $db->prepare($obj->query);
            $stmt->execute($obj->params);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            if ($stmt->fetchColumn()) {
                throw new Exception("query_error");
            }
            $db = null;
            $array = ["error" => false, "msg" => "querys_executed"];

        } catch (Exception $e) {
            $array = ["error" => true, "msg" => $e->getMessage()];
        }
        return $array;
    }

    /**
        Método para hacer consultas de solo un registro con la estructura PDO 
        (SELECT)
     */
    public static function queryOne($obj)
    {
        try {
            $db = self::connect();
            $stmt = $db->prepare($obj->query);
            $stmt->execute($obj->params);
            $results = $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Throwable $th) {
            return $th->getMessage();
        }
        return $results;
    }
    
    /**
        Método para hacer consultas con la estructura PDO
        (SELECT)
     */
    public static function queryAll($obj)
    {
        try {
            $db = self::connect();
            $stmt = $db->prepare($obj->query);
            $stmt->execute($obj->params);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
        } catch (Throwable $th) {
            return $th->getMessage();
        }
        return @$results;
    }

    /**
        Método para hacer transacciones con la estructura PDO
        (INSERT, UPDATE, DELETE)
     **/
    public static function save_transaction_PDO($querys)
    {
        try {
            $db = self::connect();
            $db->beginTransaction();
            foreach ($querys as $obj) {
                $stmt = $db->prepare($obj->query);
                $stmt->execute($obj->params);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $array[] = $stmt->fetchColumn();
                if (in_array(true, $array)) {
                    throw new Exception("error_in_one_of_the_queries");
                }

            }
            $db->commit();
            $array = ["error" => false, "msg" => "querys_executed!"];
        } catch (Exception $e) {
            $array = ["error" => true, "msg" => $e->getMessage()];
        }
        return $array;
    }

}
?>
