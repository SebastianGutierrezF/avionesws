<?php
require_once '../config/headers.php';
require "../vendor/autoload.php";
use models\Auth as auth;

// $body = json_decode((file_get_contents('php://input', true)));

switch ($URL_PARAMS->option) {
    case 'login':
        echo json_encode(auth::login($BODY));
        break;
}
?>