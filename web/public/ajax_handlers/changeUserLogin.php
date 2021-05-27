<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/db/init.php';

use App\Validators\ChangeLoginFormValidator;
use App\Mappers\UserMapper;
use App\Auth;
use App\UserFactory;

session_start();

header('Content-Type: application/json');

if (!isset($_POST['newLogin']) || !isset($_POST['id'])) {
    $response['status'] = 'error';
    http_response_code(422);
    echo json_encode($response);
    exit;
}

$newLogin = $_POST['newLogin'];
$id = (int) $_POST['id'];

$mapper = new UserMapper($pdo);

$user = $mapper->getUserById($id);

if (!$user) {
    $response['status'] = 'error';
    http_response_code(422);
    echo json_encode($response);
    exit;
}

$currentLogin = $user->getLogin();

$errors = ChangeLoginFormValidator::validate($currentLogin, $newLogin);

if ($errors !== []) {
    $response['status'] = 'error';
    $response['errors'] = $errors;
    http_response_code(422);
    echo json_encode($response);
    exit;
}

$user->setLogin($newLogin);

try {
    $mapper->update($user);
} catch (PDOException $e) {
    $response['status'] = 'error';
    $response['errors'][] = 'Пользователь с таким логином уже существует';
    http_response_code(422);
    echo json_encode($response);
    exit;
}

$factory = new UserFactory($pdo);
$currentUser = $factory->getCurrentUser();

if ($currentUser->getId() === $id) {
    Auth::signOut();
}

$response['status'] = 'success';
echo json_encode($response);
exit;
