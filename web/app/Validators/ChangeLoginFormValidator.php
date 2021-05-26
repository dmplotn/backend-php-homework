<?php

namespace App\Validators;

class ChangeLoginFormValidator
{

    /**
     * @param string $currentLogin
     * @param string $newLogin
     *
     * @return array
     */
    public static function validate(string $currentLogin, string $newLogin): array
    {
        $errors = [];

        if (empty($newLogin)) {
            $errors[] = "Поле 'новый логин' не должно быть пустым";
        }

        if ($newLogin === $currentLogin) {
            $errors[] = "Новый логин не должен совпадать с текущим логином";
        }

        return $errors;
    }
}
