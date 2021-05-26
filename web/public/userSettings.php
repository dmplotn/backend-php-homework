<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/db/init.php';

use App\UserFactory;

session_start();

$factory = new UserFactory($pdo);
$user = $factory->getCurrentUser();

if (!isset($_GET['id'])) {
    http_response_code(404);
    exit;
}

$id = (int) $_GET['id'];

if ($user->isGuest() || $user->getId() !== $id) {
    header('Location: /index.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Настройки пользователя</title>
    <?php require 'inc/bootstrap.php' ?>
    <script src="scripts/signOut.js"></script>
    <script src="scripts/changeUserLogin.js"></script>
    <script src="scripts/changeUserPassword.js"></script>
    <script src="scripts/errors.js"></script>
</head>
<body>
    <?php require "inc/header.php"?>
    <section class="mt-5">
        <div class="container-xl">
            <h1 class="mb-5">Настройки пользователя</h1>
            <form class="mb-5" onsubmit="changeUserLogin(); return false">
                <h2 class="mb-4">Изменить логин</h2>
                <div class="mb-5">
                    <label for="login" class="form-label">Новый логин</label>
                    <input type="text" class="form-control" id="newLogin">
                </div>
                <button type="submit" class="btn btn-primary">Изменить</button>
            </form>
            <form onsubmit="changeUserPassword(); return false">
                <h2 class="mb-4">Изменить пароль</h2>
                <div class="mb-3">
                    <label for="password" class="form-label">Новый пароль</label>
                    <input type="password" class="form-control" id="newPassword">
                </div>
                <div class="mb-5">
                    <label for="passwordConfirmation" class="form-label">Подтверждение пароля</label>
                    <input type="password" class="form-control" id="passwordConfirmation">
                </div>
                <button type="submit" class="btn btn-primary">Изменить</button>
            </form>
        </div>
    </section>
</body>
</html>