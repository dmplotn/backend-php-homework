<?php

namespace App\Mappers;

use App\Models\Department;

class DepartmentMapper
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

    public function getDepartmentById(int $id): ?Department
    {
        $stmt = $this->pdo->prepare('SELECT * FROM departments WHERE id = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch();

        if (!$data) {
            return null;
        }

        $id = (int) $data['id'];
        $name = $data['name'];

        return new Department($id, $name);
    }

    /**
     * @return array
     */
    public function getAllDepartments(): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM departments');
        $stmt->execute();
        $data = $stmt->fetchAll();

        $result = [];

        foreach ($data as ['id' => $id, 'name' => $name]) {
            $result[] = new Department((int) $id, $name);
        }

        return $result;
    }
}
