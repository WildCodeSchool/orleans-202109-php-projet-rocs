<?php

namespace App\Model;

class AdminManager extends AbstractManager
{
    public const TABLE = 'admin';

    public function addAdmin(array $data)
    {
        $query = 'INSERT INTO ' . self::TABLE . ' (username,password) VALUES (:username, :password)';
        $statement = $this->pdo->prepare($query);

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $statement->bindValue('username', $data['username'], \PDO::PARAM_STR);
        $statement->bindValue('password', $hashedPassword, \PDO::PARAM_STR);

        $statement->execute();
    }

    public function selectOneAdmin(string $username): array
    {
        $query = "SELECT * FROM admin WHERE username = :username";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('username', $username, \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }
}
