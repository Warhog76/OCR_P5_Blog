<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

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

    /**
     * @throws Exception
     */
    public function mailer($email,$subject,$message): void
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer();

        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = '127.0.0.1';                           //Set the SMTP server to send through
        $mail->Port = 1025;                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        //Recipients
        $mail->setFrom($email, 'Mailer');
        $mail->addAddress('joe@example.com', 'Joe User');

        //Content
        $mail->isHTML(true);   //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = $message;

        $mail->send();



    }
}