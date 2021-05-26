<?php

namespace App\Mappers;

use App\Models\Users\User;

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
        $sql = 'SELECT * FROM users WHERE id = ?';
        return $this->getUser($id, $sql);
    }

    /**
     * @param string $login
     *
     * @return User|null
     */
    public function getUserByLogin(string $login): ?User
    {
        $sql = 'SELECT * FROM users WHERE login = ?';
        return $this->getUser($login, $sql);
    }

    /**
     * @param mixed $attr
     * @param string $sql
     *
     * @return User|null
     */
    private function getUser($attr, string $sql): ?User
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$attr]);
        $result = $stmt->fetch();

        if (!$result) {
            return null;
        }

        [
            'id' => $id,
            'login' => $login,
            'password' => $password,
            'role_id' => $roleId
        ] = $result;

        return new User($id, $login, $password, $roleId);
    }

    /**
     * @param User $user
     *
     * @return void
     */
    public function insert(User $user): void
    {
        $sql = 'INSERT INTO users (login, password, role_id) VALUES (?, ?, ?)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $user->getLogin(),
            $user->getPassword(),
            $user->getRoleId()
        ]);
    }

    /**
     * @param User $user
     *
     * @return void
     */
    public function update(User $user): void
    {
        $sql = 'UPDATE users SET login = ?, password = ?, role_id = ? WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $user->getLogin(),
            $user->getPassword(),
            $user->getRoleId(),
            $user->getId()
        ]);
    }
}
