<?php

namespace App\Model;

class TrainerManager extends AbstractManager
{
    public const TABLE = 'trainer';

    public function adminSelectAll(): array
    {
        $query = "SELECT * FROM " . self::TABLE;
        return $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }
}
