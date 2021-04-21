<?php

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task2/AuthManager.php';

use function Task2\AuthManager\{isUserSignedIn, getSignedInUserLogin};

if (!isUserSignedIn()) {
    header('Location: /task2/signInPage.php');
    exit;
}

$login = getSignedInUserLogin();

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/task2/inc/header.php' ?>
    <main class="container mx-auto w-2/5">
        <h1 class="text-4xl font-bold my-4">Привет, <?= htmlspecialchars($login) ?>!</h1>
    </main>
</body>
</html>
