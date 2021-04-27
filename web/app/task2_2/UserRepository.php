<?php

class UserRepository
{
    public static function getUserByLogin(string $login)
    {
        $rows = Db::getRowsWhere(['login' => $login]);

        if ($rows === []) {
            return null;
        }

        ['login' => $login, 'password' => $password] = $rows[0];

        return new User($login, $password);
    }

    public static function saveUser(User $user): bool
    {
        $login = $user->getLogin();
        $password = $user->getPassword();

        try {
            Db::insertRow(['login' => $login, 'password' => $password]);
        } catch (DbException $e) {
            return false;
        }

        return true;
    }
}
