<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/db/init.php';

use App\UserFactory;
use App\Mappers\UserMapper;
use App\Mappers\PositionMapper;
use App\Mappers\DepartmentMapper;

session_start();

$factory = new UserFactory($pdo);
$user = $factory->getCurrentUser();

if (!$user->isAdmin()) {
    header('Location: /signIn.php');
    exit;
}

$mapper = new UserMapper($pdo);

$positionMapper = new PositionMapper($pdo);
$positions = $positionMapper->getAllPositions();

$departmentMapper = new DepartmentMapper($pdo);
$departments = $departmentMapper->getAllDepartments();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <?php require 'inc/bootstrap.php' ?>
    <script src="scripts/signOut.js"></script>
    <script src="scripts/deleteUser.js"></script>
    <script src="scripts/displayUsersTable.js"></script>
</head>
<body onload="displayUsersTable()">
    <?php require "inc/header.php"?>
    <section class="mt-5">
        <div class="container-xl">
            <h1 class="mb-5">Администратор</h1>
            <div class="mb-5">
                <h2 class="mb-3">Фильтрация таблицы</h2>
                <div class="mb-3">
                    <label for="login-filter" class="form-label">Логин</label>
                    <input onkeyup="displayUsersTable()" type="text" class="form-control" id="login-filter">
                </div>
                <div class="mb-3">
                    <label for="position-filter" class="form-label">Должность</label>
                    <select onchange="displayUsersTable()" class="form-select" id="position-filter">
                        <option value="none" selected></option>
                        <?php foreach ($positions as $position) : ?>
                            <option value="<?= $position->getId() ?>"><?= $position->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="department-filter" class="form-label">Отдел</label>
                    <select onchange="displayUsersTable()" class="form-select" id="department-filter">
                        <option value="none" selected></option>
                        <?php foreach ($departments as $department) : ?>
                            <option value="<?= $department->getId() ?>"><?= $department->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mb-5">
                <h2 class="mb-3">Сортировка таблицы</h2>
                <div>
                    <label>
                        <input onchange="displayUsersTable()" type="radio" name="sort" value="asc" id="">
                        Прямая
                    </label>
                </div>
                <div>
                    <label>
                        <input onchange="displayUsersTable()" type="radio" name="sort" value="desc" id="">
                        Обратная
                    </label>
                </div>
                <div>
                    <label>
                        <input onchange="displayUsersTable()" type="radio" name="sort" value="none" id="" checked>
                        Без сортировки
                    </label>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Логин</th>
                    <th scope="col">Должность</th>
                    <th scope="col">Отдел</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="users-tbody"></tbody>
            </table>
            <ul class="pagination" id="pagination"></ul>
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
</body>
</html>
