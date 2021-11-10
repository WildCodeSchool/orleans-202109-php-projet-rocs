<?php

namespace App\Model;

class AdminManager extends AbstractManager
{
    public const TABLE = 'admin';

    public function addAdmin(array $data)
    {
        $query = 'INSERT INTO ' . self::TABLE . ' (username,password) VALUES (:username, :password)';
        $statement = $this->pdo->prepare($query);

        $statement->bindValue('username', $data['username'], \PDO::PARAM_STR);
        $statement->bindValue('password', $data['password'], \PDO::PARAM_STR);

        $statement->execute();
    }
}
