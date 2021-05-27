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
    <script src="scripts/deleteUser.js"></script>
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
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                    <tr>
                        <th scope="row"><?= $user->getId() ?></th>
                        <td><?= $user->getLogin() ?></td>
                        <td><a href="/userSettings.php?id=<?= $user->getId() ?>">Редактировать</a></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-user-id="<?= $user->getId() ?>">
                                Удалить
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Подтверждение</h5>
            </div>
            <div class="modal-body">
                Вы действительно хотите удалить пользователя?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary" id="delete-confirmation-button">Удалить</button>
            </div>
            </div>
        </div>
    </div>
</body>
<script>
    const buttons = Array.from(document.querySelectorAll('[data-bs-toggle=modal]'));
    buttons.forEach((button) => button.addEventListener('click', () => {
        const id = button.getAttribute('data-user-id');

        // const modal = new bootstrap.Modal(document.getElementById('exampleModal'));

        const deleteConfirmationButton = document.getElementById('delete-confirmation-button');
        const handler = () => {
            deleteUser(id);
            deleteConfirmationButton.removeEventListener('click', handler);
        }
        deleteConfirmationButton.addEventListener('click', handler);
    }));
</script>
</html>