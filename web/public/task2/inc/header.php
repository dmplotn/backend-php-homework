<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task2/Utils.php';

use function Task2\Utils\getCurrentPath;

$currentPath = getCurrentPath();

?>
<header class="bg-blue-100">
    <div class="container mx-auto w-2/5">
        <div class="flex justify-end">
            <?php if ($currentPath === '/task2/index.php') : ?>
                <form action="/task2/signOut.php" method="POST">
                    <button class="hover:underline p-3 text-lg font-bold" type="submit">Выйти</button>
                </form>
            <?php elseif ($currentPath === '/task2/signInPage.php') : ?>
                <a class="hover:underline p-3 text-lg font-bold" href="/task2/signUpPage.php">Регистрация</a>
            <?php elseif ($currentPath === '/task2/signUpPage.php') : ?>
                <a class="hover:underline p-3 text-lg font-bold" href="/task2/signInPage.php">Войти</a>
            <?php endif; ?>
        </div>
    </div>
</header>
