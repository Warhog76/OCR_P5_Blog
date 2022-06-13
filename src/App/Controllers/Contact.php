<?php

namespace App\Controllers;

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use App\Repositories\ErrorMessage;
use PHPMailer\PHPMailer\Exception;

class Contact extends Controller
{

    /**
     * @throws Exception
     */
    public function sendMail($name,$email,$subject,$message,$submit): void
    {
        // si le bouton "Envoyer" est cliqué
        if ($submit !== null) {

            if (empty($name)) {
                ErrorMessage::getError('Vous devez indiquez un nom','error');
            }elseif (empty($email)) {
                ErrorMessage::getError('Vous devez indiquez un email','error');
            }elseif (empty($message)) {
                ErrorMessage::getError('Votre message est manquant','error');
            }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                ErrorMessage::getError("votre adresse email n'est pas valide",'error');
            }else{
                $this->mailer($email, $subject, $message);
                ErrorMessage::getError('votre email a bien été envoyé', 'success');
            }
        }
    }
}

