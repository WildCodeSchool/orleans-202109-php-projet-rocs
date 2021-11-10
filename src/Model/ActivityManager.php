<?php

namespace App\Model;

class ActivityManager extends AbstractManager
{
    public const TABLE = 'activity';

    public function activityById(int $id): array
    {
        $query = 'SELECT *, t.image AS trainer_image FROM ' . static::TABLE .
            ' AS a LEFT JOIN trainer AS t ON t.id = a.trainer_id WHERE a.id = :id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function selectAllAdmin(): array
    {
        $query = "SELECT a.id AS id, a.name AS name, CONCAT(t.firstname, ' ', t.lastname) AS  trainer FROM "
            . static::TABLE . " AS a LEFT JOIN trainer AS t ON t.id = a.trainer_id";
        return $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function addActivity(array $newActivity): void
    {
        $query = "INSERT INTO activity (`name`,`description`,`schedule`,`days`,`who`,`trainer`) 
            VALUES (:name,:description,:schedule,:days,:who,:trainer_id)";
            $statement = $this->pdo->prepare($query);

            $statement->bindValue('name', $newActivity['name'], \PDO::PARAM_STR);
            $statement->bindValue('description', $newActivity['description'], \PDO::PARAM_STR);
            $statement->bindValue('schedule', $newActivity['schedule'], \PDO::PARAM_STR);
            $statement->bindValue('days', $newActivity['days'], \PDO::PARAM_STR);
            $statement->bindValue('who', $newActivity['who'], \PDO::PARAM_STR);
            $statement->bindValue('trainer_id', $newActivity['trainer_id'], \PDO::PARAM_INT);

            $statement->execute();
    }
}
