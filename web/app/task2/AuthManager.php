<?php

namespace Task2\AuthManager;

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task2/Models/User.php';

use function Task2\Models\User\{getLogin, getPassword};

function isUserSignedIn(): bool
{
    return array_key_exists('login', $_SESSION);
}

function getSignedInUserLogin(): string
{
    if (!isUserSignedIn()) {
        throw new \RuntimeException("User is not signed in");
    }

    return $_SESSION['login'];
}

function signIn(array $user): void
{
    if (isUserSignedIn()) {
        throw new \RuntimeException("User is already signed in");
    }
    $_SESSION['login'] = getLogin($user);
}

function signOut(): void
{
    unset($_SESSION['login']);
    session_destroy();
}

function canUserSignIn($user, $password): bool
{
    if ($user === null) {
        return false;
    }

    return password_verify($password, getPassword($user));
}
