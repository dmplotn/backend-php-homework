<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';

use Task2\EditorCommandFactory;
use Task2\EditorController;

header('Content-Type: application/json');

$response = [];

if (!isset($_POST['commands'])) {
    http_response_code(422);
    $response['status'] = 'error';
    $response['message'] = 'Отсуствуют параметры запроса.';
    echo json_encode($response);
    exit;
}

$rawCommands = $_POST['commands'];

try {
    $commands = EditorCommandFactory::create($rawCommands);
    $controller = new EditorController();
    $controller->process($commands);
    $result = $controller->getEditorContent();
} catch (\Exception $e) {
    http_response_code(422);
    $response['status'] = 'error';
    $response['message'] = "Команды не выполнены. Одна или несколько команд являются невалидным ({$e->getMessage()}).";
    echo json_encode($response);
    exit;
}

$response['status'] = 'ok';
$response['message'] = 'Команды успешно выполнены.';
$response['result'] = $result;
echo json_encode($response);
