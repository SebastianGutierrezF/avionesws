<?php

namespace main;

use Exception;

require "../../vendor/autoload.php";

class custom_exceptions extends Exception
{

    private $_options = "unknown_error";

    const MESSAGE_CATALOGUE = [
        /* Login */
        "001" => "fail_to_login",
        "002" => "invalid_credentials",
        /* Registro */
        "003" => "fail_to_register",
        "004" => "user_already_registered",
        /* Generales */
        "005" => "request_data_not_provided",
        /* Peticiones HTTP */
        "006" => "incorrect_request_method",
        "007" => "access_not_allowed",
        "008" => "resource_not_provided"
    ];

    public function __construct(...$errorCode)
    {
        if (!isset($errorCode[0])) return;
        if (!array_key_exists($errorCode[0], self::MESSAGE_CATALOGUE)) return;
        $this->_options = self::MESSAGE_CATALOGUE[$errorCode[0]]; 
    }

    public function GetOptions() { return ["error"=> true, "msg" => $this->_options]; }


}
