<?php

namespace App\Repositories;

abstract class Repository
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getPdo();
    }
}