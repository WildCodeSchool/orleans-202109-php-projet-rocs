<?php

namespace App\Model;

class OfficeManager extends AbstractManager
{
    public const TABLE = 'office';
    public function adminSelectAll(): array
    {
        $query = "SELECT role, CONCAT(firstname, ' ', lastname) AS personnel FROM " . static::TABLE;
        return $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }
}
