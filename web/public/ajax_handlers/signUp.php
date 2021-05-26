<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/db/init.php';

use App\Validators\SignUpFormValidator;
use App\Mappers\UserMapper;
use App\Models\Users\User;
use App\Auth;

session_start();

$response = [];

header('Content-Type: application/json');

if (
    !isset($_POST['login']) ||
    !isset($_POST['password']) ||
    !isset($_POST['passwordConfirmation'])
) {
    $response['status'] = 'error';
    http_response_code(422);
    echo json_encode($response);
    exit;
}

[
    'login' => $login,
    'password' => $password,
    'passwordConfirmation' => $passwordConfirmation
] = $_POST;

$errors = SignUpFormValidator::validate($login, $password, $passwordConfirmation);

if ($errors !== []) {
    $response['status'] = 'error';
    $response['errors'] = $errors;
    http_response_code(422);
    echo json_encode($response);
    exit;
}

$mapper = new UserMapper($pdo);
$user = new User(null, $login, password_hash($password, PASSWORD_DEFAULT), User::USER_ROLE);

try {
    $mapper->insert($user);
} catch (PDOException $e) {
    $response['status'] = 'error';
    $response['errors'][] = 'Пользователь с таким логином уже существует';
    http_response_code(422);
    echo json_encode($response);
    exit;
}

$authenticableUser = $mapper->getUserByLogin($login);
Auth::signIn($authenticableUser);

$response['status'] = 'success';
echo json_encode($response);
exit;
