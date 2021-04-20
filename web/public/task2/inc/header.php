<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task2/Utils.php';

use function Task2\Utils\getCurrentPath;

$currentPath = getCurrentPath();

?>
<header>
    <?php if ($currentPath === '/task2/index.php') : ?>
        <form action="/task2/signOut.php" method="POST">
            <button type="submit">Выйти</button>
        </form>
    <?php elseif ($currentPath === '/task2/signInPage.php') : ?>
        <a href="/task2/signUpPage.php">Регистрация</a>
    <?php elseif ($currentPath === '/task2/signUpPage.php') : ?>
        <a href="/task2/signInPage.php">Войти</a>
    <?php endif; ?>
</header>
