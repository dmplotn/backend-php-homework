<?php

use App\Utils\Page;

?>
<header id="displayErrorsTarget">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
                    <li class="nav-item">
                        <a class="nav-link" href="/index.php">Главная</a>
                    </li>

                    <?php if (!$user->isGuest()) : ?>
                        <?php if ($user->isAdmin()) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin.php">Администратор</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/userSettings.php?id=<?= $user->getId() ?>">Настройки пользователя</a>
                        </li>
                    <?php elseif (Page::isSignIn()) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/signUp.php">Регистрация</a>
                        </li>
                    <?php elseif (Page::isSignUp()) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/signIn.php">Авторизация</a>
                        </li>
                    <?php endif; ?>
                
                </ul>

                <?php if (!$user->isGuest()) : ?>
                    <form onsubmit="signOut(); return false"><button class="text-secondary nav-link btn btn-link" type="submit">Выйти</button></form>
                <?php endif; ?>
            </div>
        
        </div>
    </nav>
</header>