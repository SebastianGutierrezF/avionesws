<?php
require_once '../models/usuario.php';

$body = json_decode((file_get_contents('php://input', true)));
$usuario = new Usuario();

switch ($_GET['option']) {
    case 'register':
        echo json_encode($usuario->register($body));
        break;
    case 'pswReset':
        break;
    
}
?>