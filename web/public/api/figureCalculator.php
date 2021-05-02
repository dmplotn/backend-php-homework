<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';

use FigureCalculator\{FigureFactory, FigureCalculator, RequestParamParser};
use FigureCalculator\Exceptions\{
    MissingRequestParamException,
    ClassExistenceException,
    PropertyExistenceException,
    MethodExistenceException
};

$response = [];

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(404);
    $response['status'] = 'error';
    $response['message'] = 'Ресурс не найден.';
    echo json_encode($response);
    exit;
}

try {
    [
        'figure' => $figureName,
        'operation' => $operationName,
        'properties' => $properties
    ] = RequestParamParser::parse($_GET);

    $figure = FigureFactory::create($figureName, $properties);

    $calculator = new FigureCalculator($figure);

    $result = $calculator->calculate($operationName);
} catch (
    // MissingRequestParamException |
    // ClassExistenceException |
    // PropertyExistenceException |
    // MethodExistenceException |
    // TypeError |
    \DomainException $e
) {
    http_response_code(422);
    $response['status'] = 'error';
    $response['message'] = 'Запрос был отправлен с не правильным набором параметров.';
    echo json_encode($response);
    exit;
}

$response['status'] = 'success';
$response['message'] = 'Запрос успешно выполнен.';
$response['result'] = $result;
echo json_encode($response);
