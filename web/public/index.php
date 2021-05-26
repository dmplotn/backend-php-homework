<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/db/init.php';

use App\UserFactory;

session_start();

$factory = new UserFactory($pdo);
$user = $factory->getCurrentUser();

if ($user->isGuest()) {
    header('Location: /signIn.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
    <?php require 'inc/bootstrap.php' ?>
    <script src="scripts/signOut.js"></script>
</head>
<body>
    <?php require "inc/header.php"?>
    <section>
        <div class="container-xl">
            <h1 class="mb-5">Привет, <?= htmlspecialchars($user->getLogin()) ?>!</h1>
        </div>
    </section>
</body>
</html>
