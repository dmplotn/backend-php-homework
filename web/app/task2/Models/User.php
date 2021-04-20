<?php

namespace Task2\Models\User;

function makeUser($login, $password)
{
    return [
        'login' => $login,
        'password' => $password
    ];
}

function getLogin($user)
{
    return $user['login'];
}

function getPassword($user)
{
    return $user['password'];
}
