<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/db/init.php';

use App\Mappers\UserMapper;
use App\Mappers\PositionMapper;
use App\Auth;
use App\UserFactory;

session_start();

header('Content-Type: application/json');

$factory = new UserFactory($pdo);
$currentUser = $factory->getCurrentUser();

if ($currentUser->isGuest()) {
    $response['status'] = 'error';
    http_response_code(401);
    echo json_encode($response);
    exit;
}

if (
    !isset($_POST['positionId']) ||
    !isset($_POST['id'])
) {
    $response['status'] = 'error';
    http_response_code(422);
    echo json_encode($response);
    exit;
}

$id = (int) $_POST['id'];
$positionId = (int) $_POST['positionId'];

$positionMapper = new PositionMapper($pdo);
$position = $positionMapper->getPositionById($positionId);

if (!$position) {
    $response['status'] = 'error';
    http_response_code(422);
    echo json_encode($response);
    exit;
}

$userMapper = new UserMapper($pdo);
$user = $userMapper->getUserById($id);

if (!$user) {
    $response['status'] = 'error';
    http_response_code(422);
    echo json_encode($response);
    exit;
}

$user->setPosition($position);

$userMapper->update($user);

$response['status'] = 'success';
echo json_encode($response);
exit;
