<?php

namespace App\Models;

use App\Controllers\Database;

abstract class Model
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getPdo();
    }

    /**
     * find
     */
    public function find(int $id) : array
    {

        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE 'id' = :id");
        $query->execute(['id' => $id]);
        $item = $query->fetch();

        return $item;
    }

    /**
     * delete
     */
    public function delete(int $id) :void
    {

        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }
}