<?php

namespace App\Controllers;

abstract class Controller
{
    public function __construct(){}

    /*protected function loggedOnly(): void
    {

        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        if (!isset($_SESSION['auth'])){
            $_SESSION['flash']['danger'] = "Vous n'avez pas les droit pour accéder à cette page";
            header('Location: index.php?page=login');
            exit();
        }
    }*/

    function str_random($length): string
    {
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }
}