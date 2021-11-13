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
    public function insert(array $office): void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (`role`,`lastname`, `firstname`) VALUES (:role, :lastname, :firstname)");
        $statement->bindValue('role', $office['role'], \PDO::PARAM_STR);
        $statement->bindValue('lastname', $office['lastname'], \PDO::PARAM_STR);
        $statement->bindValue('firstname', $office['firstname'], \PDO::PARAM_STR);
        $statement->execute();
    }
}
