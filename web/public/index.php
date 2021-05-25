<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/db/init.php';

use App\Auth;
use App\Mappers\UserMapper;

session_start();

if (!Auth::isUserSignedIn()) {
    header('Location: /signIn.php');
    exit;
}

$id = Auth::getSignedInUserId();
$mapper = new UserMapper($pdo);
$user = $mapper->getUserById($id);

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="scripts/signOut.js"></script>
</head>
<body>
    <header class="mb-5">
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
    <section>
        <div class="container-xl">
            <h1 class="mb-5">Привет, <?= htmlspecialchars($user->getLogin()) ?>!</h1>
        </div>
    </section>
</body>
</html>
