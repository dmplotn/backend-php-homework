<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload.php';

session_start();

$response = [];

header('Content-Type: application/json');

if (!isset($_POST['login']) || !isset($_POST['password'])) {
    $response['status'] = 'error';
    http_response_code(422);
    echo json_encode($response);
    exit;
}

['login' => $login, 'password' => $password] = $_POST;

$errors = SignInFormValidator::validate($login, $password);

if ($errors !== []) {
    $response['status'] = 'validation error';
    $response['errors'] = $errors;
    http_response_code(422);
    echo json_encode($response);
    exit;
}

try {
    $user = UserRepository::getUserByLogin($login);
} catch (\RuntimeException $e) {
    $response['status'] = 'server error';
    $response['errors']['signIn'] = 'При аутентификации пользователя произошла ошибка сервера';
    http_response_code(500);
    echo json_encode($response);
    exit;
}

if (!Auth::canUserSignIn($user, $password)) {
    $response['status'] = 'sign in error';
    $response['errors']['signIn'] = 'Неверный логин или пароль';
    http_response_code(403);
    echo json_encode($response);
    exit;
}

Auth::signIn($user);

$response['status'] = 'success';
echo json_encode($response);
exit;
