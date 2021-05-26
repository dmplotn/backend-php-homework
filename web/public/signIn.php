<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/db/init.php';

use App\Auth;

session_start();

if (Auth::isUserSignedIn()) {
    header('Location: /index.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация пользователя</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="scripts/signIn.js"></script>
    <script src="scripts/errors.js"></script>
</head>
<body>
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
                        <li class="nav-item">
                            <a class="nav-link" href="/signUp.php">Регистрация</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <section class="mt-5">
        <div class="container-xl">
            <h1 class="mb-5">Авторизация пользователя</h1>
            <form onsubmit="signIn(); return false">
                <div class="mb-3">
                    <label for="login" class="form-label">Логин</label>
                    <input type="text" class="form-control" id="login">
                </div>
                <div class="mb-5">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Войти</button>
            </form>
        </div>
    </section>
</body>
</html>

        
