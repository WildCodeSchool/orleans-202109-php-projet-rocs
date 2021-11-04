<?php
namespace App\Model;

class Activity extends AbstractManager
{
    public const TABLE = 'activity';

public function selectActiviy():array
    {
        $query = 'SELECT * FROM ' . static::TABLE;
        
        return $this->pdo->query($query)->fetchAll();
    }
}