<?php

class Auth
{
    public static function signIn(User $user): void
    {
        if (self::isUserSignedIn()) {
            throw new AuthException("User is already signed in");
        }

        $_SESSION['login'] = $user->getLogin();
    }

    public static function signOut(): void
    {
        unset($_SESSION['login']);
        session_destroy();
    }

    public static function canUserSignIn($user, string $password): bool
    {
        if ($user === null) {
            return false;
        }

        return password_verify($password, $user->getPassword());
    }

    public static function isUserSignedIn(): bool
    {
        return array_key_exists('login', $_SESSION);
    }

    public static function getSignedInUserLogin(): string
    {
        if (!self::isUserSignedIn()) {
            throw new AuthException("User is not signed in");
        }

        return $_SESSION['login'];
    }
}
