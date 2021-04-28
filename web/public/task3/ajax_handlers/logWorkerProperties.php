<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload.php';

$response = [];

if (!isset($_POST['workerType']) || !isset($_POST['properties'])) {
    http_response_code(422);
    $response['status'] = 'requiredParamsError';
    $response['message'] = 'В запросе отсутствуют обязательные параметры';
    echo json_encode($response);
    exit;
}

['workerType' => $workerType, 'properties' => $properties] = $_POST;

if (!PropertyValidator::validate($properties)) {
    http_response_code(422);
    $response['status'] = 'validationError';
    $response['message'] = 'Заполнены не все поля формы';
    echo json_encode($response);
    exit;
}

try {
    Logger::log([
        'workerType' => $workerType,
        'properties' => $properties
    ]);
} catch (\RuntimeException $e) {
    http_response_code(500);
    $response['status'] = 'serverError';
    $response['message'] = 'При записи данных в лог произошла ошибка сервера';
    echo json_encode($response);
    exit;
}

$response['status'] = 'success';
$response['message'] = 'Данные записаны в лог';
echo json_encode($response);
exit;
