<?php

namespace App\Model;

class ActivityManager extends AbstractManager
{
    public const TABLE = 'activity';

    public function activityById(int $id): array
    {
        $query = 'SELECT * FROM ' . static::TABLE .
            ' AS a LEFT JOIN trainer AS t ON t.id = a.trainer_id WHERE a.id = :id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }
}
