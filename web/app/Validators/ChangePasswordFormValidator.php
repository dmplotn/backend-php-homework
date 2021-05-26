<?php

namespace App\Validators;

class ChangePasswordFormValidator
{

    /**
     * @param string $currentPassword
     * @param string $newPassword
     * @param string $passwordConfirmation
     *
     * @return array
     */
    public static function validate(string $currentPassword, string $newPassword, string $passwordConfirmation): array
    {
        $errors = [];

        if (empty($newPassword)) {
            $errors[] = "Поле 'новый пароль' не должно быть пустым";
        }

        if (empty($passwordConfirmation)) {
            $errors[] = "Поле 'подтвержение пароля' не должно быть пустым";
        }

        if ($newPassword === $currentPassword) {
            $errors[] = "Новый пароль не должен совпадать с текущим паролем";
        }

        if (!self::areEqual($newPassword, $passwordConfirmation)) {
            $errors[] = "Поле 'подтверждение пароля' должно совпадать с новым паролем";
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
