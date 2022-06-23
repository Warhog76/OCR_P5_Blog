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

    public function login($password,$email,$submit,$csrf_token): void
    {
        if($submit !== null){

            if ($csrf_token != ($this->session->read('csrf_token'))){

                $this->error->setError("csrf_token error", 'error');
            } else if (!empty($email) && !empty($password)) {
                $user = $this->accountRepo->isUser($email);

                if($email !== $user->getEmail()) {
                    $this->error->setError("Identifiant ou mot de passe incorrect", 'error');

                }elseif (password_verify($password, $user->getPassword())) {
                    $this->session->write('user_function', $user->getFunction());
                    $this->session->write('user_id', $user->getId());
                    $this->session->write('user_username', $user->getUsername());

                    header('Location: index.php?page=account');
                }
            }else{
                    $this->error->setError("Identifiant ou mot de passe incorrect", 'error');
            }
        }
    }


    /**
     * @throws Exception
     */
    public function register($username, $password, $passwordConfirm, $email, $csrf_token, $submit): void
    {
        if($submit !== null){

            if ($csrf_token != ($this->session->read('csrf_token'))){

                $this->error->setError("csrf_token error", 'error');
                return;
            }

            if(empty($username) || !preg_match('/^[\w_]+$/', $username)) {
                $this->error->setError('Votre Username est incorrect','error');
                return;
            }else{
                $user = $this->accountRepo->isRegister($username);

                if($username === $user->getUsername()){
                    $this->error->setError('Ce pseudo existe déjà','error');
                    return;
                }
            }

            if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error->setError("votre adresse email n'est pas valide",'error');
            }elseif(empty($password) || $password != $passwordConfirm) {
                $this->error->setError("Vous devez rentrer un mot de passe valide",'error');
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
            $this->error->setError("ce token n'est plus valide",'error');
            header('Location: index.php?page=login');
        }

    }

    public function modPassword($password,$passwordConfirm,$csrf_token,$submit): void
    {
        $userid = $this->session->read('user_id');

        if($submit !== null){

            if ($csrf_token != ($this->session->read('csrf_token'))){

                $this->error->setError("csrf_token error", 'error');
                return;
            }

            if(empty($password) || $password != $passwordConfirm) {
                $this->error->setError("Les mots de passes ne correspondent pas",'error');

            }else{
                //retourne un message pour signaler l'envoi dun mail afin de valider le compte et créer un mdp
                $this->accountRepo->modPassword($password,$userid);
                $this->error->setError("Votre nouveau mot de passe a bien été changé",'success');
            }
        }
    }

    /**
     * @throws Exception
     */
    public function remember($email, $submit,$csrf_token)
    {
        if($submit !== null){

            if ($csrf_token != ($this->session->read('csrf_token'))){

                $this->error->setError("csrf_token error", 'error');
                return;
            }

            if(!empty($email)) {
                $user = $this->accountRepo->lost($email);

                if($user){
                    $id_user = $user->getId();
                    $reset_token = $this->str_random(60);

                    $this->accountRepo->newPassword($reset_token,$id_user);

                $subject = 'Reinitialisation de votre mot de passe';
                $message = "Afin de reinitialiser votre mot de passe, merci de cliquer sur ce lien suivant :<br><br> 
                            http://localhost:8888/OCR_P5_Blog/public/index.php?page=reset&id=" .$id_user. "&token=" .$reset_token. " ";

                $this->mailer($email,$subject,$message);
                header('Location: index.php?page=login');

                }else{
                    $this->error->setError("Aucun compte ne correspond à cet email",'error');
                }
            }
        }
    }

    public function reset($userId,$token,$password,$passwordConfirm){

        if(isset($userId) && isset($token)){

            if($this->accountRepo->checkUser($userId,$token)){

                if(!empty($password) || $password == $passwordConfirm) {

                    $this->accountRepo->reinitPassword($password,$userId);
                    $this->error->setError("Votre mot de passe a bien été changé",'success');
                }
            }else{
                $this->error->setError("ce token n'est plus valide",'error');
                header('Location: index.php?page=home');
            }

        }
    }
}
