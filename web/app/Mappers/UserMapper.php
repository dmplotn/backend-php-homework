<?php

namespace App\Mappers;

use App\Models\Department;
use App\Models\Position;
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
        $roleId = $data['role_id'];
        $positionId = $data['position_id'];
        $departmentId = $data['department_id'];

        $roleStmt = $this->pdo->prepare('SELECT name FROM roles WHERE id = ?');
        $roleStmt->execute([(int) $roleId]);
        $roleName = $roleStmt->fetchColumn();
        $role = new Role($roleName);

        if (!$positionId) {
            $position = null;
        } else {
            $positionStmt = $this->pdo->prepare('SELECT name FROM positions WHERE id = ?');
            $positionStmt->execute([(int) $positionId]);
            $positionName = $positionStmt->fetchColumn();
            $position = new Position($positionId, $positionName);
        }

        if (!$departmentId) {
            $department = null;
        } else {
            $departmentStmt = $this->pdo->prepare('SELECT name FROM departments WHERE id = ?');
            $departmentStmt->execute([(int) $departmentId]);
            $departmentName = $departmentStmt->fetchColumn();
            $department = new Department($departmentId, $departmentName);
        }

        return new User($id, $login, $password, $role, $position, $department);
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

        $positionId = $user->getPosition() ? $user->getPosition()->getId() : null;
        $departmentId = $user->getDepartment() ? $user->getDepartment()->getId() : null;

        $stmt = $this->pdo->prepare('INSERT INTO users (login, password, role_id, position_id, department_id) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([
            $user->getLogin(),
            $user->getPassword(),
            $roleId,
            $positionId,
            $departmentId
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

        $positionId = $user->getPosition() ? $user->getPosition()->getId() : null;
        $departmentId = $user->getDepartment() ? $user->getDepartment()->getId() : null;

        $userStmt = $this->pdo->prepare('UPDATE users SET login = ?, password = ?, role_id = ?, position_id = ?, department_id = ? WHERE id = ?');
        $userStmt->execute([
            $user->getLogin(),
            $user->getPassword(),
            $roleId,
            $positionId,
            $departmentId,
            $user->getId()
        ]);
    }

    /**
     * @param string $roleName
     *
     * @return array
     */
    public function findUsersByRoleName(string $roleName, array $filterData = [], $page = 1, $sort = null): array
    {
        $loginFilter = $filterData['login'] ?? null;
        $positionFilter = (int) $filterData['position'] ?? null;
        $departmentFilter = (int) $filterData['department'] ?? null;

        $select = '
            SELECT users.id, users.login, users.password, users.role_id, users.position_id, users.department_id
            FROM users
            JOIN roles ON users.role_id = roles.id
        ';

        $sqlParts = [];
        $sqlParts[] = $select;

        $whereParts = [];
        $whereParts[] = 'roles.name = ?';

        if ($loginFilter !== '') {
            $whereParts[] = "users.login LIKE '%{$loginFilter}%'";
        }

        if ($positionFilter !== 0) {
            $whereParts[] = "users.position_id = {$positionFilter}";
        }

        if ($departmentFilter !== 0) {
            $whereParts[] = "users.department_id = {$departmentFilter}";
        }

        $where = ' WHERE ' . implode(' AND ', $whereParts);
        $sqlParts[] = $where;

        if ($sort === 'asc' || $sort === 'desc') {
            $sqlParts[] = " ORDER BY users.login {$sort}";
        }

        $offset = ($page - 1) * 10;
        $limit = " LIMIT 10 OFFSET {$offset}";
        $sqlParts[] = $limit;

        $sql = implode('', $sqlParts);

        $userStmt = $this->pdo->prepare($sql);
        $userStmt->execute([$roleName]);
        $data = $userStmt->fetchAll();

        $result = [];

        foreach (
            $data as [
                'id' => $id,
                'login' => $login,
                'password' => $password,
                'position_id' => $positionId,
                'department_id' => $departmentId
            ]
        ) {
            if (!$positionId) {
                $position = null;
            } else {
                $positionStmt = $this->pdo->prepare('SELECT name FROM positions WHERE id = ?');
                $positionStmt->execute([(int) $positionId]);
                $positionName = $positionStmt->fetchColumn();
                $position = new Position((int) $positionId, $positionName);
            }

            if (!$departmentId) {
                $department = null;
            } else {
                $departmentStmt = $this->pdo->prepare('SELECT name FROM departments WHERE id = ?');
                $departmentStmt->execute([(int) $departmentId]);
                $departmentName = $departmentStmt->fetchColumn();
                $department = new Department($departmentId, $departmentName);
            }

            $user = new User((int) $id, $login, $password, new Role($roleName), $position, $department);
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

    public function countUsers(): int
    {
        $stmt = $this->pdo->query("
            SELECT COUNT(*)
            FROM users
            JOIN roles ON users.role_id = roles.id
            WHERE roles.name = 'user'
        ");
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }
}
