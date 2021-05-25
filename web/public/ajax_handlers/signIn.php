<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/db/init.php';

use App\Validators\SignInFormValidator;
use App\Mappers\UserMapper;
use App\Auth;

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
    $response['status'] = 'error';
    $response['errors'] = $errors;
    http_response_code(422);
    echo json_encode($response);
    exit;
}

$mapper = new UserMapper($pdo);
$user = $mapper->getUserByLogin($login);

if (!Auth::canUserSignIn($user, $password)) {
    $response['status'] = 'error';
    $response['errors'][] = 'Неверный логин или пароль';
    http_response_code(403);
    echo json_encode($response);
    exit;
}

Auth::signIn($user);

$response['status'] = 'success';
echo json_encode($response);
exit;
