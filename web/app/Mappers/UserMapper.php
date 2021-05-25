<?php

namespace App\Mappers;

use App\Models\User;

class UserMapper
{
    /**
     * @var \PDO
     */
    private \PDO $pdo;

    /**
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param int $id
     *
     * @return User|null
     */
    public function getUserById(int $id): ?User
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();

        if (!$result) {
            return null;
        }

        [
            'id' => $id,
            'login' => $login,
            'password' => $password
        ] = $result;

        return new User($id, $login, $password);
    }

    /**
     * @param User $user
     *
     * @return void
     */
    public function save(User $user): void
    {
        $sql = "INSERT INTO users (login, password) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user->getLogin(), $user->getPassword()]);
    }
}
