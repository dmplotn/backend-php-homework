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
    <script src="scripts/signOut.js"></script>
</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/inc/header.php' ?>
    <h1>Привет, <?= htmlspecialchars($user->getLogin()) ?>!</h1>
</body>
</html>
