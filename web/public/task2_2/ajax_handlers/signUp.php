<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload.php';

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
    $response['status'] = 'validation error';
    $response['errors'] = $errors;
    http_response_code(422);
    echo json_encode($response);
    exit;
}

$user = new User($login, password_hash($password, PASSWORD_DEFAULT));

try {
    if (!UserRepository::saveUser($user)) {
        $response['status'] = 'sign up error';
        $response['errors']['signUp'] = 'Пользователь с таким логином уже существует';
        http_response_code(422);
        echo json_encode($response);
        exit;
    }
} catch (\RuntimeException $e) {
    $response['status'] = 'server error';
    $response['errors']['signUp'] = 'При регистрации произошла ошибка сервера';
    http_response_code(500);
    echo json_encode($response);
    exit;
}


Auth::signIn($user);

$response['status'] = 'success';
echo json_encode($response);
exit;
