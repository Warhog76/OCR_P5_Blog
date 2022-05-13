<?php

namespace App\Repositories;

use App\Repositories\Database;

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
     * delete
     *
     *    public function delete(int $id) :void
     *    {
     *
     *        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
     *        $query->execute(['id' => $id]);
     *    }
     */
}