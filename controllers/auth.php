<?php
require_once '../config/headers.php';
require "../vendor/autoload.php";
use models\auth;

switch ($URL_PARAMS->option) {
    case 'login':
        echo json_encode(auth::login($BODY));
        break;
}
?>