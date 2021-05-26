<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/db/init.php';

use App\UserFactory;

session_start();

$factory = new UserFactory($pdo);
$user = $factory->getCurrentUser();

if (!$user->isGuest()) {
    header('Location: /index.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация пользователя</title>
    <?php require 'inc/bootstrap.php' ?>
    <script src="scripts/signIn.js"></script>
    <script src="scripts/errors.js"></script>
</head>
<body>
    <?php require "inc/header.php"?>
    <section class="mt-5">
        <div class="container-xl">
            <h1 class="mb-5">Авторизация пользователя</h1>
            <form onsubmit="signIn(); return false">
                <div class="mb-3">
                    <label for="login" class="form-label">Логин</label>
                    <input type="text" class="form-control" id="login">
                </div>
                <div class="mb-5">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Войти</button>
            </form>
        </div>
    </section>
</body>
</html>

        
