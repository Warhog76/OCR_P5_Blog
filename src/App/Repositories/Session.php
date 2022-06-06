<?php

namespace App\Repositories;

Class Session{

    static Session $instance;

    static function getInstance(): Session
    {
        if(!self::$instance){
            self::$instance = new Session();
        }
        return self::$instance;
    }

    public function __construct()
    {
        session_start();
    }

    public function write($key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function read($key){
        return $_SESSION[$key] ?? null;
    }

}