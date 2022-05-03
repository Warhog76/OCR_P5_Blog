<?php

namespace App\Models;

require_once('../src/app/database.php');

abstract class Model
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = getPdo();
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