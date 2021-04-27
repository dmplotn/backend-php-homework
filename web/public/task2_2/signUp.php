<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload.php';

session_start();

if (Auth::isUserSignedIn()) {
    header('Location: /task2_2/index.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация пользователя</title>
    <script src="scripts/errorMessages.js"></script>
    <script src="scripts/signUp.js"></script>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/task2_2/inc/header.php' ?>
    <main class="container mx-auto w-2/5">
        <h1 class="text-4xl font-bold my-4">Регистрация пользователя</h1>
        <form class="py-5" onsubmit="signUp(); return false">
            <div class="my-5">
                <label for="login">Логин:</label>
                <input class="border-2 border-gray-300" type="text" id="login" name="login">
                <ul class="errorContainer m-4 text-sm text-red-600"></ul>
            </div>
            <div class="my-5">
                <label for="password">Пароль:</label>
                <input class="border-2 border-gray-300" type="password" id="password" name="password">
                <ul class="errorContainer m-4 text-sm text-red-600"></ul>
            </div>
            <div class="my-5">
                <label for="passwordConfirmation">Подтверждение пароля:</label>
                <input
                    class="border-2 border-gray-300"
                    type="password"
                    id="passwordConfirmation"
                    name="passwordConfirmation"
                >
                <ul class="errorContainer m-4 text-sm text-red-600"></ul>            
            </div>
            <ul class="errorContainer m-4 text-sm text-red-600" id="signUp"></ul>
            <p>
                <button
                    class="bg-blue-200 p-2 rounded-md hover:bg-blue-400 focus:outline-none"
                    type="submit"
                >Зарегистрироваться</button>
            </p>
        </form>
    </main>
</body>
</html>
