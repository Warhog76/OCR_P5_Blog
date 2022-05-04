<?php

namespace App\Controllers;

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;

class Contact {

    public function sendMail(): void
    {
        // si le bouton "Envoyer" est cliqué
        if (isset($_POST['submit'])) {

            $email = htmlspecialchars($_POST['mail']);
            $subject = htmlspecialchars($_POST['subject']);
            $message = htmlspecialchars(stripslashes(trim($_POST['message'])));

            if (empty($_POST['name']) || empty($email) || empty($message)) {
                $errors['empty'] = "Tous les champs n'ont pas été remplis";
            } else {

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "L'adresse email n'est pas valide";
                }
            }

            if (!empty($errors)) {

                echo '<div class="card red">
                <div class="card-content white-text">';

                foreach ($errors as $error) {
                    echo $error . "<br/>";
                }

                echo '</div>
              </div>';

            } else {
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

                if (!empty($mail)) {
                    echo '<div class="card green">
                        <div class="card-content white-text">';

                    echo 'Message bien envoyé' . "<br/>";
                }
            }
        }
    }
}

