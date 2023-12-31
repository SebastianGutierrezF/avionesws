<?php
require_once '../config/headers.php';
require "../vendor/autoload.php";

use models\avion;

switch ($URL_PARAMS->option) {
    case 'getAviones':
    case 'getMarcas':
    case 'getAvion':
        echo json_encode(avion::{$URL_PARAMS->option}($PARAMS));
        break;
    case 'addAvion':
        echo json_encode(avion::addAvion($BODY));
        break;
    case 'editAvion':
        echo json_encode(avion::editAvion($BODY));
        break;
    case 'deleteAvion':
        echo json_encode(avion::deleteAvion($PARAMS));
        break;
}