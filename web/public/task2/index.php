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
</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/task2/inc/header.php' ?>
    <main>
        <h1>Привет, <?= htmlspecialchars($login) ?>!</h1>
    </main>
</body>
</html>
