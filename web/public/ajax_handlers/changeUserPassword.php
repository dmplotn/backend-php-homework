<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/db/init.php';

use App\Validators\ChangePasswordFormValidator;
use App\Mappers\UserMapper;
use App\Auth;

session_start();

header('Content-Type: application/json');

if (
    !isset($_POST['newPassword']) ||
    !isset($_POST['passwordConfirmation'])  ||
    !isset($_POST['id'])
) {
    $response['status'] = 'error';
    http_response_code(422);
    echo json_encode($response);
    exit;
}

[
    'newPassword' => $newPassword,
    'passwordConfirmation' => $passwordConfirmation,
    'id' => $id
] = $_POST;

$mapper = new UserMapper($pdo);

$user = $mapper->getUserById($id);

if (!$user) {
    $response['status'] = 'error';
    http_response_code(422);
    echo json_encode($response);
    exit;
}

$currentPassword = $user->getPassword();

$errors = ChangePasswordFormValidator::validate($currentPassword, $newPassword, $passwordConfirmation);

if ($errors !== []) {
    $response['status'] = 'error';
    $response['errors'] = $errors;
    http_response_code(422);
    echo json_encode($response);
    exit;
}

$user->setPassword($newPassword);
$mapper->update($user);

Auth::signOut();

$response['status'] = 'success';
echo json_encode($response);
exit;
