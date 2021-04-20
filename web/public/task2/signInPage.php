<?php

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task2/AuthManager.php';

use function Task2\AuthManager\{isUserSignedIn};

if (isUserSignedIn()) {
    header('Location: /task2/index.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация пользователя</title>
    <script src="scripts/errorMessages.js"></script>
    <script src="scripts/signIn.js"></script>
</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/task2/inc/header.php' ?>
    <main>
        <h1>Авторизация пользователя</h1>
        <form onsubmit="signIn(); return false">
            <div>
                <label for="login">Логин:</label>
                <input type="text" id="login" name="login">
                <ul class="errorContainer"></ul>
            </div>
            <div>
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password">
                <ul class="errorContainer"></ul>
            </div>
            <ul class="errorContainer" id="signIn"></ul>
            <p>
                <button type="submit">Войти</button>
            </p>
        </form>
    </main>
</body>
</html>
