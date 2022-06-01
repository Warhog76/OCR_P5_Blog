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

            if (empty(filter_input(INPUT_POST, 'name')) || empty($email) || empty($message)) {
                $errors['empty'] = "Tous les champs n'ont pas été remplis";
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "L'adresse email n'est pas valide";
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
                $this->mailer($email,$subject,$message);

                ?>
                <div class="container">
                    <div class="card green">
                        <div class="card-content white-text">
                            "Votre message a bien été envoyé"
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
}

