<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/db/init.php';

use App\UserFactory;
use App\Mappers\UserMapper;

session_start();

$factory = new UserFactory($pdo);
$user = $factory->getCurrentUser();

if (!$user->isAdmin()) {
    header('Location: /signIn.php');
    exit;
}

$mapper = new UserMapper($pdo);

$users = $mapper->findUsersByRole('user');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <?php require 'inc/bootstrap.php' ?>
    <script src="scripts/signOut.js"></script>
</head>
<body>
    <?php require "inc/header.php"?>
    <section class="mt-5">
        <div class="container-xl">
            <h1 class="mb-5">Администратор</h1>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Логин</th>
                    <th scope="col"></th>
                    <!-- <th scope="col"></th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                    <tr>
                        <th scope="row"><?= $user->getId() ?></th>
                        <td><?= $user->getLogin() ?></td>
                        <td><a href="/userSettings.php?id=<?= $user->getId() ?>">Редактировать</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>