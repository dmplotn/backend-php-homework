<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload.php';

session_start();

if (!Auth::isUserSignedIn()) {
    header('Location: /task2_2/signIn.php');
    exit;
}

$login = Auth::getSignedInUserLogin();

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
    <script src="scripts/signOut.js"></script>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/task2_2/inc/header.php' ?>
    <main class="container mx-auto w-2/5">
        <h1 class="text-4xl font-bold my-4">Привет, <?= htmlspecialchars($login) ?>!</h1>
    </main>
</body>
</html>
