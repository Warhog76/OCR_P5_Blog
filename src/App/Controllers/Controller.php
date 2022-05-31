<?php

namespace App\Controllers;

abstract class Controller
{
    public function __construct(){
        session_start();
    }

    protected function loggedOnly(): void
    {

        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        if (!isset($_SESSION['auth'])){
            $_SESSION['flash']['danger'] = "Vous n'avez pas les droit pour accéder à cette page";
            header('Location: index.php?page=login');
            exit();
        }
    }


}