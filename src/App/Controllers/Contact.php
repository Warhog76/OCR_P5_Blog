<?php

namespace App\Controllers;

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Contact extends Controller
{

    /**
     * @throws Exception
     */
    public function sendMail($email,$subject,$message,$submit): void
    {
        // si le bouton "Envoyer" est cliqué
        if ($submit !== null) {

            $errors = [];

            if (empty(filter_input(INPUT_POST, 'name')) || empty($email) || empty($message)) {
                $errors[] = "Tous les champs n'ont pas été remplis";
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "L'adresse email n'est pas valide";
            }

            if(count($errors) == 0) {
                $this->mailer($email,$subject,$message);
            }
        }
    }
}

