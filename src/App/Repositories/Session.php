<?php

namespace App\Repositories;

Class Session{

    static Session $instance;

    public static function getInstance(): Session
    {
        if(!self::$instance){
            self::$instance = new Session();
        }
        return self::$instance;
    }

    /*public function __construct()
    {
        session_start();
    }*/

    public function write($key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function read($key){
        return $_SESSION[$key] ?? null;
    }

    public function get($key){
        $flash = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $flash;
    }

    public function delete($key){
        unset($_SESSION[$key]);
    }

}
