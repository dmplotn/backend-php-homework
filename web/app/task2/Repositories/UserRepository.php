<?php

namespace Task2\Repositories\UserRepository;

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task2/Models/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task2/DbManager.php';

use function Task2\Models\User\{makeUser, getLogin, getPassword};
use function Task2\DbManager\{getRowsWhere, insertRow};

function getUserByLogin(string $login)
{
    $rows = getRowsWhere(['login' => $login]);

    if ($rows === []) {
        return null;
    }

    ['login' => $login, 'password' => $password] = $rows[0];

    return makeUser($login, $password);
}

function saveUser(array $user): void
{
    $login = getLogin($user);
    $password = getPassword($user);

    insertRow(['login' => $login, 'password' => $password]);
}
