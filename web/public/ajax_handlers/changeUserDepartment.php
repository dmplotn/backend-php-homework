<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/db/init.php';

use App\Mappers\UserMapper;
use App\Mappers\DepartmentMapper;
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
    !isset($_POST['departmentId']) ||
    !isset($_POST['id'])
) {
    $response['status'] = 'error';
    http_response_code(422);
    echo json_encode($response);
    exit;
}

$id = (int) $_POST['id'];
$departmentId = (int) $_POST['departmentId'];

$departmentMapper = new DepartmentMapper($pdo);
$department = $departmentMapper->getDepartmentById($departmentId);

if (!$department) {
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

$user->setDepartment($department);

$userMapper->update($user);

$response['status'] = 'success';
echo json_encode($response);
exit;
