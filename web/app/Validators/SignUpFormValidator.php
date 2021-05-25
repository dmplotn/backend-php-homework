<?php

namespace App\Validators;

class SignUpFormValidator
{
    /**
     * @param string $login
     * @param string $password
     * @param string $passwordConfirmation
     *
     * @return array
     */
    public static function validate(string $login, string $password, string $passwordConfirmation): array
    {
        $errors = [];

        if (empty($login)) {
            $errors[] = "Поле 'логин' не должно быть пустым";
        }

        if (empty($password)) {
            $errors[] = "Поле 'пароль' не должно быть пустым";
        }

        if (empty($passwordConfirmation)) {
            $errors[] = "Поле 'подтверждение' не должно быть пустым";
        }

        if (!self::areEqual($password, $passwordConfirmation)) {
            $errors[] = "Поле 'подтверждение' должно совпадать с паролем";
        }

        return $errors;
    }

    /**
     * @param string $password
     * @param string $passwordConfirmation
     *
     * @return bool
     */
    public static function areEqual(string $password, string $passwordConfirmation): bool
    {
        return !empty($password) && !empty($passwordConfirmation) && $password === $passwordConfirmation;
    }
}
