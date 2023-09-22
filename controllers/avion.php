<?php
require_once '../models/avion.php';
require_once '../config/headers.php';

$body = json_decode((file_get_contents('php://input', true)));
$avion = new Avion();

switch ($_GET['option']) {
    case 'getAviones':
        echo json_encode($avion->getAviones());
        break;
    case 'getAvion':
        echo json_encode($avion->getAvion($body));
        break;
    case 'addAvion':
        echo $avion->addAvion($body);
        break;
    case 'editAvion':
        echo $avion->editAvion($body);
        break;
    case 'deleteAvion':
        echo $avion->deleteAvion($body);
        break;
    case 'getMarcas':
        echo json_encode($avion->getMarcas());
        break;
}