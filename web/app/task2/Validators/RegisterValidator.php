<?php

namespace Task2\Validators\RegisterValidator;

function validate(string $login, string $password, string $passwordConfirmation): array
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

    if (!areEqual($password, $passwordConfirmation)) {
        $errors['passwordConfirmation'][] = 'Подтверждение должно совпадать с паролем';
    }

    return $errors;
}

function areEqual(string $password, string $passwordConfirmation): bool
{
    return !empty($password) && !empty($passwordConfirmation) && $password === $passwordConfirmation;
}
