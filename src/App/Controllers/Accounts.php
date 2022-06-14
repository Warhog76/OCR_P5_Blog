<?php

namespace App\Controllers;

use App\Repositories\{AccountRepo, ErrorMessage, Session};
use PHPMailer\PHPMailer\Exception;

class Accounts extends Controller
{
    public function __construct(
        private AccountRepo $accountRepo,
        private ErrorMessage $error,
        private Session $session,
    ){}

    public function login($password,$email,$submit): void
    {

        if($submit !== null){

            if(!empty($email) && !empty($password)) {
                $user = $this->accountRepo->isUser($email);

                if(password_verify($password, $user->getPassword())) {
                   $this->session->write('user_function', $user->getFunction());
                   $this->session->write('user_id', $user->getId());

                        header('Location: index.php?page=account');

                }else{
                    $this->error->getError("Identifiant ou mot de passe incorrect", 'error');
                }
            }
        }
    }

    /**
     * @throws Exception
     */
    public function register($username, $password, $passwordConfirm, $email, $submit): void
    {
        if ($submit !== null){

            if(empty($username) || !preg_match('/^[\w_]+$/', $username)) {
                $this->error->getError('Votre Username est incorrect','error');
            }else{
                $user = $this->accountRepo->isRegister($username);
                if($user){
                    $this->error->getError('Ce pseudo existe déjà','error');
                }
            }

            if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error->getError("votre adresse email n'est pas valide",'error');
            }elseif(empty($password) || $password != $passwordConfirm) {
                $this->error->getError("Vous devez rentrer un mot de passe valide",'error');
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
        $confirmedToken = $results->getToken();

        if($confirmedToken == $token){
            $this->accountRepo->validateUser($userId);
            header('Location: index.php?page=home');
        }else{
            $this->error->getError("ce token n'est plus valide",'error');
            header('Location: index.php?page=login');
        }

    }

    public function modPassword($password,$passwordConfirm,$submit): void
    {
        $userid = $this->session->read('user_id');

        if($submit !== null){
            if(empty($password) || $password != $passwordConfirm) {
                $this->error->getError("Les mots de passes ne correspondent pas",'error');

            }else{
                //retourne un message pour signaler l'envoi dun mail afin de valider le compte et créer un mdp
                $this->accountRepo->modPassword($password,$userid);
                $this->error->getError("Votre nouveau mot de passe a bien été changé",'success');
            }
        }
    }

    /**
     * @throws Exception
     */
    public function remember($email, $submit)
    {
        if($submit !== null){

            if(!empty($email)) {
                $user = $this->accountRepo->lost($email);

                if($user){
                    $id = $user->getId();
                    $reset_token = $this->str_random(60);

                    $this->accountRepo->newPassword($reset_token,$id);

                $subject = 'Réinitialisation de votre mot de passe';
                $message = "Afin de reinitialiser votre mot de passe, merci de cliquer sur ce lien suivant :<br><br> 
                            http://localhost:8888/OCR_P5_Blog/public/index.php?page=reset&id=" .$id. "&token=" .$reset_token. " ";

                $this->mailer($email,$subject,$message);
                header('Location: index.php?page=login');

                }else{
                    $this->error->getError("Aucun compte ne correspond à cet email",'error');
                }
            }
        }
    }

    public function reset($userId,$token,$password,$passwordConfirm){

        if(isset($userId) && isset($token)){

            $user = $this->accountRepo->checkUser($userId,$token);

            if($user){

                if(!empty($password) || $password == $passwordConfirm) {

                    $this->accountRepo->reinitPassword($password,$userId);
                    header('location: index.php?page=account');
                }

            }else{
                $this->error->getError("ce token n'est plus valide",'error');
                header('Location: index.php?page=login');
            }

        }else{
            header('location : index.php?page=login');
        }
    }
}
