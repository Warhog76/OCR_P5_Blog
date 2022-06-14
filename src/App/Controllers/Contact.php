<?php

namespace App\Controllers;

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use App\Repositories\ErrorMessage;
use PHPMailer\PHPMailer\Exception;

class Contact extends Controller
{

    public function __construct(
        private ErrorMessage $error,
    ){}
    /**
     * @throws Exception
     */
    public function sendMail($name,$email,$subject,$message,$submit): void
    {
        // si le bouton "Envoyer" est cliqué
        if (isset($submit)) {

            if (empty($name)) {
                $this->error->getError('Vous devez indiquez un nom','error');
            }elseif (empty($email)) {
                $this->error->getError('Vous devez indiquez un email','error');
            }elseif (empty($message)) {
                $this->error->getError('Votre message est manquant','error');
            }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error->getError("votre adresse email n'est pas valide",'error');
            }else{
                $this->mailer($email, $subject, $message);
                $this->error->getError('votre email a bien été envoyé', 'success');
            }
        }
    }
}

