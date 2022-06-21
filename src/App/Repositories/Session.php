<?php

namespace App\Repositories;

Class Session{

    static ?Session $instance = null;

    public static function getInstance(): Session
    {
        if(!self::$instance){
            self::$instance = new Session();
        }
        return self::$instance;
    }

    private function __construct()
    {
        session_start();

        $token = base64_encode(openssl_random_pseudo_bytes(64));
        self::write('csrf_token', $token);

    }

    public static function write($key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function read($key){
        return $_SESSION[$key] ?? null;
    }

    public static function get($key){
        return $_SESSION[$key];
    }

    public function delete($key): void
    {
        unset($_SESSION[$key]);
    }

    public function logout(): void
    {
        if(self::$instance) {
            session_destroy();
        }
    }
}
