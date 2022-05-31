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

    public function login(): void
    {

        if(filter_input(INPUT_POST, 'submit') !== null){
            $email = htmlspecialchars(trim(filter_input(INPUT_POST, 'email')));
            $password = htmlspecialchars(trim(filter_input(INPUT_POST, 'password')));

            if(!empty($email) && !empty($password)) {
                $user = $this->accountRepo->isUser($email);

                if(password_verify($password, $user->password)) {
                    session_start();
                    $_SESSION['auth'] = $user;
                    $_SESSION['flash']['success'] = 'Vous êtes désormais connecté';
                    header('Location: index.php?page=home');
                    exit();

                }else{
                    $_SESSION['flash']['danger'] = "Identifiant ou mot de passe incorrect";
                }
            }
        }
    }

    /**
     * @throws Exception
     */
    public function register(): void
    {

        $username = htmlspecialchars(trim(filter_input(INPUT_POST, 'username')));
        $email = htmlspecialchars(trim(filter_input(INPUT_POST, 'email')));
        $password = htmlspecialchars(trim(filter_input(INPUT_POST, 'password')));
        $passwordConfirm = htmlspecialchars(trim(filter_input(INPUT_POST, 'password_confirm')));

        if (filter_input(INPUT_POST, 'submit') !== null){

            if (empty($username) || !preg_match('/^[\w_]+$/', $username)) {
                $_SESSION['flash']['danger'] = "Votre pseudo est invalide";
            }else{
                $user = $this->accountRepo->isRegister($username);
                if($user){
                    $_SESSION['flash']['danger'] = "Ce pseudo existe déjà";
                }
            }
            if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['flash']['danger'] = "Votre email est invalide";
            }
            if(empty($password) || $password != $passwordConfirm) {
                $_SESSION['flash']['danger'] = "Vous devez rentrer un mot de passe valide";
            }else{
                //retourne un message pour signaler l'envoi dun mail afin de valider le compte et créer un mdp
                $user = $this->accountRepo->registerUser();

                $user_id = $user['id'];
                $token = $user['token'];

                var_dump($user_id);

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
                $mail->Subject = 'Confirmation de votre compte';
                $mail->Body = "Afin de valider votre compte, 
                merci de cliquer sur ce lien suivant :<br><br> http://localhost:8888/OCR_P5_Blog/public/index.php?page=confirm&id=" .$user_id. "&token=" .$token. " ";
                $mail->AltBody = "Afin de valider votre compte, 
                merci de cliquer sur ce lien suivant :<br><br> http://localhost:8888/OCR_P5_Blog/public/index.php?page=confirm&id=" .$user_id. "&token=" .$token. " ";

                $mail->send();

                $_SESSION['flash']['success'] = 'Un email vient de vous être envoyé afin de valider votre compte';
                header('Location: index.php?page=login');
            }
        }
    }

    public function confirm(): void
    {

        $user_id = filter_input(INPUT_GET, 'id');
        $token = filter_input(INPUT_GET, 'token');

        $results= $this->accountRepo->confirmUser($user_id);

        session_start();

        if($results->token == $token){
            $this->accountRepo->validateUser($user_id);
            $_SESSION['flash']['success'] = 'Votre compte a bien été validé';
            header('Location: index.php?page=home');
        }else{
            $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
            header('Location: index.php?page=login');
        }

    }

    public function modPassword(): void
    {

        $password = htmlspecialchars(trim(filter_input(INPUT_POST, 'password')));
        $passwordConfirm = htmlspecialchars(trim(filter_input(INPUT_POST, 'password_confirm')));

        if (filter_input(INPUT_POST, 'submit') !== null){

            if(empty($password) || $password != $passwordConfirm) {
                $_SESSION['flash']['danger'] = "Les mots de passes ne correspondent pas";
            }else{
                //retourne un message pour signaler l'envoi dun mail afin de valider le compte et créer un mdp
                $this->accountRepo->modPassword();
                $_SESSION['flash']['success'] = 'Votre nouveau mot de passe a bien été changé';
            }
        }
    }

    public function remember()
    {
        if(filter_input(INPUT_POST, 'submit') !== null){
            $email = htmlspecialchars(trim(filter_input(INPUT_POST, 'email')));

            if(!empty($email)) {
                $user = $this->accountRepo->lost($email);

                if($user){
                    $id = $user['id'];
                    $reset_token = $this->str_random(60);

                    $this->accountRepo->newPassword($reset_token,$id);

                    $_SESSION['flash']['success'] = 'Un email vient de vous être envoyé avec les instructions à suivre pour votre mot de passe ';
                    header('Location: index.php?page=login');
                    exit();

                }else{
                    $_SESSION['flash']['danger'] = "Aucun compte ne correspond à cet email";
                }
            }
        }


    }
}