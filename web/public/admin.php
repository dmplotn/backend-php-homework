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

$filterData = $_GET['filter'] ?? [];

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$page = $page > 0 ? $page : 1;

$pagesCount = ceil($mapper->countUsers() / 10);

$sort = $_GET['sort'] ?? $sort;

$positionMapper = new PositionMapper($pdo);
$positions = $positionMapper->getAllPositions();

$departmentMapper = new DepartmentMapper($pdo);
$departments = $departmentMapper->getAllDepartments();

$users = $mapper->findUsersByRoleName('user', $filterData, $page, $sort);

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
            <form class="mb-5" action="/admin.php">
                <h2 class="mb-3">Фильтрация таблицы</h2>
                <div class="mb-3">
                    <label for="login-filter" class="form-label">Логин</label>
                    <input type="text" class="form-control" id="login-filter" name="filter[login]">
                </div>
                <div class="mb-3">
                    <label for="position-filter" class="form-label">Должность</label>
                    <select class="form-select" id="position-filter" name="filter[position]">
                        <option value="" selected>Выберите должность</option>
                        <?php foreach ($positions as $position) : ?>
                            <option value="<?= $position->getId() ?>"><?= $position->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="department-filter" class="form-label">Отдел</label>
                    <select class="form-select" id="department-filter" name="filter[department]">
                        <option value="" selected>Выберите отдел</option>
                        <?php foreach ($departments as $department) : ?>
                            <option value="<?= $department->getId() ?>"><?= $department->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Фильтровать</button>
            </form>
            <div class="mb-5">
                <h2 class="mb-3">Сортировка таблицы</h2>
                <form class="mb-2" action="/admin.php">
                    <input class="form-control" id="sort" name="sort" value="desc" type="hidden">
                    <button type="submit" class="btn btn-primary">Сортировать по убыванию</button>
                </form>
                <form class="mb-2" action="/admin.php">
                    <input class="form-control" id="sort" name="sort" value="asc" type="hidden">
                    <button type="submit" class="btn btn-primary">Сортировать по возрастанию</button>
                </form>
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
                <tbody>
                    <?php foreach ($users as $user) : ?>
                    <tr>
                        <th scope="row"><?= $user->getId() ?></th>
                        <td><?= $user->getLogin() ?></td>
                        <td><?= $user->getPosition() ? $user->getPosition()->getName() : 'Отсутствует' ?></td>
                        <td><?= $user->getDepartment() ? $user->getDepartment()->getName() : 'Отсутствует' ?></td>
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
            <ul class="pagination">
                <?php for ($i = 1; $i <= $pagesCount; $i += 1) : ?>
                    <li class="page-item"><a class="page-link" href="/admin.php?page=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor; ?>
            </ul>
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
        const deleteConfirmationButton = document.getElementById('delete-confirmation-button');
        const handler = () => {
            deleteUser(id);
            deleteConfirmationButton.removeEventListener('click', handler);
        }
        deleteConfirmationButton.addEventListener('click', handler);
    }));
</script>
</html>
