<?php

namespace App\Mappers;

use App\Models\Position;

class PositionMapper
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

    public function getPositionById(int $id): ?Position
    {
        $stmt = $this->pdo->prepare('SELECT * FROM positions WHERE id = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch();

        if (!$data) {
            return null;
        }

        $id = (int) $data['id'];
        $name = $data['name'];

        return new Position($id, $name);
    }

    /**
     * @return array
     */
    public function getAllPositions(): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM positions');
        $stmt->execute();
        $data = $stmt->fetchAll();

        $result = [];

        foreach ($data as ['id' => $id, 'name' => $name]) {
            $result[] = new Position((int) $id, $name);
        }

        return $result;
    }
}
