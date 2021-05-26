<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/db/init.php';

use App\Auth;

if (!isset($_GET['id'])) {
    http_response_code(404);
    exit;
}

session_start();

['id' => $id] = $_GET;

if (!Auth::isUserSignedIn() || Auth::getSignedInUserId() !== $id) {
    header('Location: /index.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Настройки пользователя</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="scripts/signOut.js"></script>
    <script src="scripts/changeUserLogin.js"></script>
    <script src="scripts/changeUserPassword.js"></script>
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
                            <form onsubmit="signOut(); return false"><button class="nav-link btn btn-link" type="submit">Выйти</button></form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <section class="mt-5">
        <div class="container-xl">
            <h1 class="mb-5">Настройки пользователя</h1>
            <form class="mb-5" onsubmit="changeUserLogin(); return false">
                <h2 class="mb-4">Изменить логин</h2>
                <div class="mb-5">
                    <label for="login" class="form-label">Новый логин</label>
                    <input type="text" class="form-control" id="newLogin">
                </div>
                <button type="submit" class="btn btn-primary">Изменить</button>
            </form>
            <form onsubmit="changeUserPassword(); return false">
                <h2 class="mb-4">Изменить пароль</h2>
                <div class="mb-3">
                    <label for="password" class="form-label">Новый пароль</label>
                    <input type="password" class="form-control" id="newPassword">
                </div>
                <div class="mb-5">
                    <label for="passwordConfirmation" class="form-label">Подтверждение пароля</label>
                    <input type="password" class="form-control" id="passwordConfirmation">
                </div>
                <button type="submit" class="btn btn-primary">Изменить</button>
            </form>
        </div>
    </section>
</body>
</html>