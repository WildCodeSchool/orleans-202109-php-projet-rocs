<?php

namespace App\Model;

class TrainerManager extends AbstractManager
{
    public const TABLE = 'trainer';
    public function update(array $trainer): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `firstname` = :firstname . `lastname` = :lastname . `phoneNumber` = :phoneNumber . 
        `email` = :email .`gender` = :gender WHERE id=:id");
        $statement->bindValue('id', $trainer['id'], \PDO::PARAM_INT);
        $statement->bindValue('firstname', $trainer['firstname'], \PDO::PARAM_STR);
        $statement->bindValue('lastname', $trainer['lastname'], \PDO::PARAM_STR);
        $statement->bindValue('phoneNumber', $trainer['phoneNumber']);
        $statement->bindValue('email', $trainer['email']);
        $statement->bindValue('gender', $trainer['gender'], \PDO::PARAM_STR);
        return $statement->execute();
    }
}
