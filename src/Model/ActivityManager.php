<?php

namespace App\Model;

use PDO;

class ActivityManager extends AbstractManager
{
    public const TABLE = 'activity';

    public function activityById(int $id): array
    {
        $query = 'SELECT *, t.image AS trainer_image, t.id AS trainer FROM ' . static::TABLE .
            ' AS a LEFT JOIN trainer AS t ON t.id = a.trainer_id WHERE a.id = :id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function selectAllAdmin(): array
    {
        $query = "SELECT a.id AS id, a.name AS name, CONCAT(t.firstname, ' ', t.lastname) AS  trainer FROM "
            . static::TABLE . " AS a LEFT JOIN trainer AS t ON t.id = a.trainer_id ORDER BY trainer ASC";
        return $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function addActivity(array $newActivity): void
    {

        $query = "INSERT INTO activity (`name`,`description`,`schedule`,`days`,`who`,`trainer_id`) 
            VALUES (:name,:description,:schedule,:days,:who,:trainer)";
        $statement = $this->pdo->prepare($query);

        $statement->bindValue('name', $newActivity['name'], \PDO::PARAM_STR);
        $statement->bindValue('description', $newActivity['description'], \PDO::PARAM_STR);
        $statement->bindValue('schedule', $newActivity['schedule'], \PDO::PARAM_STR);
        $statement->bindValue('days', $newActivity['days'], \PDO::PARAM_STR);
        $statement->bindValue('who', $newActivity['who'], \PDO::PARAM_STR);
        if ($newActivity['trainer'] != "") {
            $statement->bindValue('trainer', $newActivity['trainer'], \PDO::PARAM_INT);
        } else {
            $statement->bindValue('trainer', null);
        }

        $statement->execute();
    }

    public function modifyActivity(array $activity): void
    {
        $query = "UPDATE activity 
            SET name = :name, description = :description, schedule = :schedule, 
            days = :days, who = :who, trainer_id = :trainer WHERE id = :id";
        $statement = $this->pdo->prepare($query);

        $statement->bindValue('name', $activity['name'], \PDO::PARAM_STR);
        $statement->bindValue('description', $activity['description'], \PDO::PARAM_STR);
        $statement->bindValue('schedule', $activity['schedule'], \PDO::PARAM_STR);
        $statement->bindValue('days', $activity['days'], \PDO::PARAM_STR);
        $statement->bindValue('who', $activity['who'], \PDO::PARAM_STR);
        $statement->bindValue('id', $activity['id'], \PDO::PARAM_INT);
        if ($activity['trainer'] != '') {
            $statement->bindValue('trainer', $activity['trainer'], \PDO::PARAM_INT);
        } else {
            $statement->bindValue('trainer', null);
        }

        $statement->execute();
    }
}
