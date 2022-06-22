<?php

namespace App\Controllers;

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use App\Repositories\{ErrorMessage, Session};
use PHPMailer\PHPMailer\Exception;

class Contact extends Controller
{

    public function __construct(
        private ErrorMessage $error,
        private Session $session,
    ){}
    /**
     * @throws Exception
     */
    public function sendMail($name,$email,$subject,$message,$csrf_token,$submit): void
    {

        if($submit !== null){

            if ($csrf_token != ($this->session->read('csrf_token'))){

                $this->error->setError("csrf_token error", 'error');
                return;
            }

            if (empty($name)) :
                $this->error->setError('Vous devez indiquez un nom','error');
            elseif (empty($email)) :
                $this->error->setError('Vous devez indiquez un email','error');
            elseif (empty($message)) :
                $this->error->setError('Votre message est manquant','error');
            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) :
                $this->error->setError("votre adresse email n'est pas valide",'error');
            else:
                $this->mailer($email, $subject, $message);
                $this->error->setError('votre email a bien été envoyé', 'success');
            endif;
        }
    }
}

