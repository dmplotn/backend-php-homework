<?php

namespace App\Utils;

class Page
{
    public static function isSignUp()
    {
        return self::getCurrentPagePath() === '/signUp.php';
    }

    public static function isSignIn()
    {
        return self::getCurrentPagePath() === '/signIn.php';
    }

    private static function getCurrentPagePath(): string
    {
        return $_SERVER['PHP_SELF'];
    }
}