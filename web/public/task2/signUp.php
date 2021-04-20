<?php

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task2/Repositories/UserRepository.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task2/Models/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task2/AuthManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task2/Validators/RegisterValidator.php';

use function Task2\Validators\RegisterValidator\validate;
use function Task2\Repositories\UserRepository\saveUser;
use function Task2\Models\User\makeUser;
use function Task2\AuthManager\signIn;

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

$errors = validate($login, $password, $passwordConfirmation);

if ($errors !== []) {
    $response['status'] = 'validation error';
    $response['errors'] = $errors;
    http_response_code(422);
    echo json_encode($response);
    exit;
}

$user = makeUser($login, password_hash($password, PASSWORD_DEFAULT));

try {
    saveUser($user);
} catch (\RuntimeException $e) {
    $response['status'] = 'sign up error';
    $response['errors']['signUp'] = 'Пользователь не может быть зарегистрирован';
    http_response_code(422);
    echo json_encode($response);
    exit;
}

signIn($user);

$response['status'] = 'success';
echo json_encode($response);
exit;
