<?php

class SignInFormValidator
{
    public static function validate(string $login, string $password): array
    {
        $errors = [];

        if (empty($login)) {
            $errors['login'][] = "Поле 'логин' не должно быть пустым";
        }

        if (empty($password)) {
            $errors['password'][] = "Поле 'пароль' не должно быть пустым";
        }

        return $errors;
    }
}
