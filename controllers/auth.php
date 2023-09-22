<?php
require_once '../models/auth.php';

$body = json_decode((file_get_contents('php://input', true)));
$auth = new Auth();

switch ($_GET['option']) {
    case 'login':
        echo json_encode($auth->login($body));
        break;
    case 'pswReset':
        break;
    
}
?>