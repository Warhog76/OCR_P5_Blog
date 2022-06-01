<?php

namespace App\Controllers;

use App\Repositories\AccountRepo;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Accounts extends Controller
{
    public function __construct(
        private AccountRepo $accountRepo,
    ){}

    public function login($password,$email,$submit): void
    {

        if($submit !== null){

            if(!empty($email) && !empty($password)) {
                $user = $this->accountRepo->isUser($email);

                if(password_verify($password, $user->password)) {
                    session_start();
                    $_SESSION['auth'] = $user->email;
                    header('Location: index.php?page=home');
                    exit();

                }else{
                    ?>
                        <div class="container">
                            <div class="card red">
                                <div class="card-content white-text">
                                    "Identifiant ou mot de passe incorrect"
                                </div>
                            </div>
                        </div>
                    <?php
                }
            }
        }
    }

    public function register($username, $password, $passwordConfirm, $email, $submit): void
    {
        if ($submit !== null){

            $errors = [];

            if(empty($username) || !preg_match('/^[\w_]+$/', $username)) {
                $errors['username'] = "Votre pseudo est invalide";
            }else{
                $user = $this->accountRepo->isRegister($username);
                if($user){
                    $errors['exist'] = "Ce pseudo existe déjà";
                }
            }
            if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Votre email est invalide";
            }
            if(empty($password) || $password != $passwordConfirm) {
                $errors['mdp'] = "Vous devez rentrer un mot de passe valide";
            }

            if(!empty($errors)) {

                echo '<div class="container">
                            <div class="card red">
                                <div class="card-content white-text">';

                                    foreach ($errors as $error) {
                                    echo $error . "<br/>";
                                    }
                echo '</div></div>
            </div>';

            }else{
                //retourne un message pour signaler l'envoi dun mail afin de valider le compte et créer un mdp
                $users = $this->accountRepo->registerUser($username,$password,$email);

                $user_id = $users['user_id'];
                $token = $users['token'];

                $subject = 'Confirmation de votre compte';
                $message = "Afin de valider votre compte, merci de cliquer sur ce lien suivant :<br><br> 
                            http://localhost:8888/OCR_P5_Blog/public/index.php?page=confirm&id=" .$user_id. "&token=" .$token. " ";

                $this->mailer($email,$subject,$message);
                header('Location: index.php?page=login');
            }
        }
    }

    public function confirm($userId,$token): void
    {

        $results= $this->accountRepo->confirmUser($userId);

        session_start();

        if($results->token == $token){
            $this->accountRepo->validateUser($userId);
            header('Location: index.php?page=home');
        }else{
            ?>
            <div class="container">
                <div class="card red">
                    <div class="card-content white-text">
                        "Ce token n'est plus valide"
                    </div>
                </div>
            </div>
            <?php
            header('Location: index.php?page=login');
        }

    }

    public function modPassword($password,$passwordConfirm,$submit): void
    {

        if($submit !== null){
            if(empty($password) || $password != $passwordConfirm) {
                $_SESSION['flash']['danger'] = "Les mots de passes ne correspondent pas";
            }else{
                //retourne un message pour signaler l'envoi dun mail afin de valider le compte et créer un mdp
                $this->accountRepo->modPassword($password);
                $_SESSION['flash']['success'] = 'Votre nouveau mot de passe a bien été changé';
            }
        }
    }

    public function remember($email, $submit)
    {
        if($submit !== null){

            if(!empty($email)) {
                $user = $this->accountRepo->lost($email);

                    $id = $user->getId();
                    $reset_token = $this->str_random(60);

                    $this->accountRepo->newPassword($reset_token,$id);

                $subject = 'Confirmation de votre compte';
                $message = "Afin de valider votre compte, merci de cliquer sur ce lien suivant :<br><br> 
                            http://localhost:8888/OCR_P5_Blog/public/index.php?page=confirm&id=" .$id. "&token=" .$reset_token. " ";

                $this->mailer($email,$subject,$message);

                    $_SESSION['flash']['success'] = 'Un email vient de vous être envoyé avec les instructions à suivre pour votre mot de passe ';
                    header('Location: index.php?page=login');
                    exit();

            }else{
                    ?>
                        <div class="container">
                            <div class="card red">
                                <div class="card-content white-text">
                                "Aucun compte ne correspond à cet email"
                                </div>
                            </div>
                        </div>
                    <?php
                }
            }
        }
}