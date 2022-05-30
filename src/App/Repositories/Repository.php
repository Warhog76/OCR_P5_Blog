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

    function str_random($length): string
    {
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

}