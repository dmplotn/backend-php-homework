<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/db/init.php';

use App\Mappers\UserMapper;
use App\UserFactory;

session_start();

if (!isset($_POST['id'])) {
    $response['status'] = 'error';
    http_response_code(422);
    echo json_encode($response);
    exit;
}

$id = (int) $_POST['id'];

$factory = new UserFactory($pdo);
$currenUser = $factory->getCurrentUser();

if (!$currenUser->isAdmin()) {
    $response['status'] = 'error';
    http_response_code(401);
    echo json_encode($response);
    exit;
}

$mapper = new UserMapper($pdo);
$mapper->delete($id);

$response['status'] = 'success';
echo json_encode($response);
exit;
