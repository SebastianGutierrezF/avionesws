<?php
require_once '../models/usuario.php';
require_once '../config/headers.php';

$body = json_decode((file_get_contents('php://input', true)));
$usuario = new Usuario();

switch ($_GET['option']) {
    case 'register':
        echo json_encode($usuario->register($body));
        break;
    case 'accountExists':
        echo json_encode($usuario->accountExists($body));
        break;
    case 'changePsw':
        echo json_encode($usuario->changePsw($body));
        break;
    
}
?>