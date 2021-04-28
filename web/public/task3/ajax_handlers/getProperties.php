<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload.php';

$response = [];

if (!isset($_GET['workerType'])) {
    http_response_code(422);
    $response['status'] = 'requiredParamsError';
    $response['message'] = 'Заполнены не все поля формы';
    echo json_encode($response);
    exit;
}

['workerType' => $className] = $_GET;

if (!ClassExistenceValidator::validate($className)) {
    http_response_code(422);
    $response['status'] = 'unknownParamError';
    $response['message'] = 'Невозможно отобразить свойства профессии';
    echo json_encode($response);
    exit;
}

$properties = $className::getPropertyNames();

$response['status'] = 'success';
$response['properties'] = $properties;

echo json_encode($response);
