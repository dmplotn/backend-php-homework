<?php

namespace App\Validators;

class SignInFormValidator
{
    /**
     * @param string $login
     * @param string $password
     *
     * @return array
     */
    public static function validate(string $login, string $password): array
    {
        $errors = [];

        if (empty($login)) {
            $errors[] = "Поле 'логин' не должно быть пустым";
        }

        if (empty($password)) {
            $errors[] = "Поле 'пароль' не должно быть пустым";
        }

        return $errors;
    }
}
