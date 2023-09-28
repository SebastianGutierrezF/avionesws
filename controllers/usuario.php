<?php
require_once '../config/headers.php';
require "../vendor/autoload.php";

use models\usuario;

switch ($_GET['option']) {
    case 'register':
        echo json_encode(usuario::register($BODY));
        break;
    case 'accountExists':
        echo json_encode(usuario::accountExists($BODY));
        break;
    case 'changePsw':
        echo json_encode(usuario::changePsw($BODY));
        break;
}
?>