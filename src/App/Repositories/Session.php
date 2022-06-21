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

        // Create a new CSRF token.
        if (! isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = base64_encode(openssl_random_pseudo_bytes(64));
        }
    }

    public function write($key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function read($key){
        return $_SESSION[$key] ?? null;
    }

    public function get($key){
        return $_SESSION[$key];
    }

    public function delete($key){
        unset($_SESSION[$key]);
    }

    public function logout(): void
    {
        if(self::$instance) {
            session_destroy();
        }
    }

}
