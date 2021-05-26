<?php

namespace App;

use App\Exceptions\AuthException;
use App\Mappers\UserMapper;
use App\Models\Users\Guest;
use App\Models\Users\UserInterface;

class UserFactory
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getCurrentUser(): UserInterface
    {
        try {
            $id = Auth::getSignedInUserId();
        } catch (AuthException $e) {
            return new Guest();
        }

        $mapper = new UserMapper($this->pdo);
        return $mapper->getUserById($id);
    }
}
