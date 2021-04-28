<?php

class SignUpFormValidator
{
    public static function validate(string $login, string $password, string $passwordConfirmation): array
    {
        $errors = [];

        if (empty($login)) {
            $errors['login'][] = "Поле 'логин' не должно быть пустым";
        }

        if (empty($password)) {
            $errors['password'][] = "Поле 'пароль' не должно быть пустым";
        }

        if (empty($passwordConfirmation)) {
            $errors['passwordConfirmation'][] = "Поле 'подтверждение' не должно быть пустым";
        }

        if (!self::areEqual($password, $passwordConfirmation)) {
            $errors['passwordConfirmation'][] = 'Подтверждение должно совпадать с паролем';
        }

        return $errors;
    }

    public static function areEqual(string $password, string $passwordConfirmation): bool
    {
        return !empty($password) && !empty($passwordConfirmation) && $password === $passwordConfirmation;
    }
}
