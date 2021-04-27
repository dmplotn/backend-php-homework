<?php

$currentPath = Utils::getCurrentPagePath();

?>
<header class="bg-blue-100">
    <div class="container mx-auto w-2/5">
        <div class="flex justify-end">
            <?php if ($currentPath === '/task2_2/index.php') : ?>
                <form onsubmit="signOut(); return false">
                    <button class="hover:underline p-3 text-lg font-bold" type="submit">Выйти</button>
                </form>
            <?php elseif ($currentPath === '/task2_2/signIn.php') : ?>
                <a class="hover:underline p-3 text-lg font-bold" href="/task2_2/signUp.php">Регистрация</a>
            <?php elseif ($currentPath === '/task2_2/signUp.php') : ?>
                <a class="hover:underline p-3 text-lg font-bold" href="/task2_2/signIn.php">Войти</a>
            <?php endif; ?>
        </div>
    </div>
</header>
