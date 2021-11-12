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


    public function insert(array $trainer): void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`firstname`,`lastname`,`phoneNumber`,
        `email`,`gender`) VALUES (:firstname,:lastname,:phoneNumber,:email,:gender)");
        $statement->bindValue('firstname', $trainer['firstname'], \PDO::PARAM_STR);
        $statement->bindValue('lastname', $trainer['lastname'], \PDO::PARAM_STR);
        $statement->bindValue('phoneNumber', $trainer['phoneNumber']);
        $statement->bindValue('email', $trainer['email']);
        $statement->bindValue('gender', $trainer['gender'], \PDO::PARAM_STR);
        $statement->execute();
    }
}
