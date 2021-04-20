<?php

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task2/Validators/AuthValidator.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task2/Repositories/UserRepository.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task2/AuthManager.php';

use function Task2\Validators\AuthValidator\validate;
use function Task2\Repositories\UserRepository\getUserByLogin;
use function Task2\AuthManager\{signIn, canUserSignIn};

$response = [];

header('Content-Type: application/json');

if (!isset($_POST['login']) || !isset($_POST['password'])) {
    $response['status'] = 'error';
    http_response_code(422);
    echo json_encode($response);
    exit;
}

['login' => $login, 'password' => $password] = $_POST;

$errors = validate($login, $password);

if ($errors !== []) {
    $response['status'] = 'validation error';
    $response['errors'] = $errors;
    http_response_code(422);
    echo json_encode($response);
    exit;
}

$user = getUserByLogin($login);

if (!canUserSignIn($user, $password)) {
    $response['status'] = 'sign in error';
    $response['errors']['signIn'] = 'Неверный логин или пароль';
    http_response_code(403);
    echo json_encode($response);
    exit;
}

signIn($user);

$response['status'] = 'success';
echo json_encode($response);
exit;
