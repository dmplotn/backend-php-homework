<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/db/init.php';

use App\Mappers\UserMapper;

[
    'login' => $login,
    'position' => $position,
    'department' => $department,
    'sort' => $sort,
    'page' => $page,
] = $_GET;


$mapper = new UserMapper($pdo);

$users = $mapper->getUsers([
    'login' => $login,
    'position' => (int) $position,
    'department' => (int) $department
], $sort, $page);

$result = [];
$result['userData'] = [];

foreach ($users as $user) {
    $userData['id'] = $user->getId();
    $userData['login'] = $user->getLogin();
    $userData['position'] = $user->getPosition() ? $user->getPosition()->getName() : 'Отсутствует';
    $userData['department'] = $user->getDepartment() ? $user->getDepartment()->getName() : 'Отсутствует';

    $result['userData'][] = $userData;
}

$usersCount = $mapper->countUsers([
    'login' => $login,
    'position' => (int) $position,
    'department' => (int) $department
], $sort);

$pagesCount = ceil($usersCount / 10);

$result['pagesCount'] = $pagesCount;

echo json_encode($result);
