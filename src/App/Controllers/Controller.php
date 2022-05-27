<?php

namespace App\Controllers;

abstract class Controller {

    protected mixed $repository;
    protected $repositoryName;

    public function __construct()
    {
        $this->repository = new $this->repositoryName();
    }
}