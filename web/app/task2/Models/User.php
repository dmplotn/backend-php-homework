<?php

namespace Task2\Models\User;

function makeUser(string $login, string $password): array
{
    return [
        'login' => $login,
        'password' => $password
    ];
}

function getLogin(array $user): string
{
    return $user['login'];
}

function getPassword(array $user): string
{
    return $user['password'];
}
