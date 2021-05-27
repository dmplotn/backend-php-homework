<?php

namespace App\Mappers;

use App\Models\Users\User;
use App\Models\Role;

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
        $userStmt = $this->pdo->prepare($sql);
        $userStmt->execute([$attr]);
        $data = $userStmt->fetch();

        if (!$data) {
            return null;
        }

        $id = (int) $data['id'];
        $login = $data['login'];
        $password = $data['password'];
        $roleId = (int) $data['role_id'];

        $roleStmt = $this->pdo->prepare('SELECT name FROM roles WHERE id = ?');
        $roleStmt->execute([$roleId]);
        $roleName = $roleStmt->fetchColumn();

        return new User($id, $login, $password, new Role($roleName));
    }

    /**
     * @param User $user
     *
     * @return void
     */
    public function insert(User $user): void
    {
        $roleName = $user->getRole()->getName();
        $stmt = $this->pdo->prepare('SELECT id FROM roles WHERE name = ?');
        $stmt->execute([$roleName]);
        $roleId = (int) $stmt->fetchColumn();

        $sql = 'INSERT INTO users (login, password, role_id) VALUES (?, ?, ?)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $user->getLogin(),
            $user->getPassword(),
            $roleId
        ]);
    }

    /**
     * @param User $user
     *
     * @return void
     */
    public function update(User $user): void
    {
        $roleName = $user->getRole()->getName();
        $roleStmt = $this->pdo->prepare('SELECT id FROM roles WHERE name = ?');
        $roleStmt->execute([$roleName]);
        $roleId = (int) $roleStmt->fetchColumn();

        $userStmt = $this->pdo->prepare('UPDATE users SET login = ?, password = ?, role_id = ? WHERE id = ?');
        $userStmt->execute([
            $user->getLogin(),
            $user->getPassword(),
            $roleId,
            $user->getId()
        ]);
    }

    /**
     * @param string $roleName
     *
     * @return array
     */
    public function findUsersByRoleName(string $roleName): array
    {
        $sql = '
            SELECT users.id, users.login, users.password, users.role_id
            FROM users JOIN roles ON users.role_id = roles.id
            WHERE roles.name = ?
        ';

        $userStmt = $this->pdo->prepare($sql);
        $userStmt->execute([$roleName]);
        $data = $userStmt->fetchAll();

        $result = [];

        foreach (
            $data as [
                'id' => $id,
                'login' => $login,
                'password' => $password,
            ]
        ) {
            $user = new User((int) $id, $login, $password, new Role($roleName));
            $result[] = $user;
        }

        return $result;
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function delete(int $id): void
    {
        $sql = 'DELETE FROM users WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
