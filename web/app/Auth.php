<?php

namespace App;

use App\Models\User;
use App\Exceptions\AuthException;

class Auth
{
    /**
     * @param User $user
     *
     * @return void
     */
    public static function signIn(User $user): void
    {
        if (self::isUserSignedIn()) {
            throw new AuthException("User is already signed in");
        }

        $_SESSION['id'] = $user->getId();
    }

    /**
     * @return void
     */
    public static function signOut(): void
    {
        unset($_SESSION['id']);
        session_destroy();
    }

    /**
     * @param User $user
     * @param string $password
     *
     * @return bool
     */
    public static function canUserSignIn(?User $user, string $password): bool
    {
        if ($user === null) {
            return false;
        }

        return password_verify($password, $user->getPassword());
    }

    /**
     * @return bool
     */
    public static function isUserSignedIn(): bool
    {
        return array_key_exists('id', $_SESSION);
    }

    /**
     * @return string
     */
    public static function getSignedInUserId(): string
    {
        if (!self::isUserSignedIn()) {
            throw new AuthException("User is not signed in");
        }

        return $_SESSION['id'];
    }
}
