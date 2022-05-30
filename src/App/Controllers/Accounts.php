<?php

namespace App\Controllers;

use App\Repositories\AccountRepo;

class Accounts
{
    public function __construct(
        private AccountRepo $accountRepo,
    ){}

    /*public function login(){

        if(isset(filter_input(INPUT_POST, 'submit'))){
            $email = htmlspecialchars(trim(filter_input(INPUT_POST, 'email')));
            $password = htmlspecialchars(trim(filter_input(INPUT_POST, 'password')));

            $errors = [];

            if(empty($email) || empty($password)){
                $errors['empty'] = "Tous les champs n'ont pas été remplis!";
            }elseif($this->accountRepo->isAdmin($email,$password) == 0){
                $errors['exist']  = "Accès refusé";
            }

            if(!empty($errors)){
                    "message d'erreur";
            }elseif($_SESSION['admin'] = $email){                ;
                $this->page->renderBack('dashboard');
            }else{
                //retour page accueil pour simple user
            }
        }
    }*/

    public function register(): string
    {

        $username = htmlspecialchars(trim(filter_input(INPUT_POST, 'username')));
        $email = htmlspecialchars(trim(filter_input(INPUT_POST, 'email')));
        $password = htmlspecialchars(trim(filter_input(INPUT_POST, 'password')));
        $passwordConfirm = htmlspecialchars(trim(filter_input(INPUT_POST, 'password_confirm')));

        if(!empty(filter_input(INPUT_POST, ''))){
            $errors = [];
            if(empty($username)|| !preg_match('/^[\w_]+$/', $username)) {
                $errors['username'] = "Votre pseudo est invalide";
            }else{
                $user = $this->accountRepo->isUser($username);
                if($user){
                    $errors['username'] = "Ce pseudo existe déjà";
                }
            }

            if(empty($email)|| !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Votre email est invalide";
            }

            if (empty($password) || $password != $passwordConfirm) {
                $errors['password'] = "Vous devez rentrer un mot de passe valide";
            }
            if(!empty($errors)){
                foreach($errors as $error){
                    return $error;
                }
            }else{
            //retourne un message pour signaler l'envoi dun mail afin de valider le compte et créer un mdp
                $this->accountRepo->registerUser();
                header('Location: index.php?page=login');
            }
        }
    }

    public function confirm(): void
    {

        $user_id = filter_input(INPUT_GET, 'id');
        $token = filter_input(INPUT_GET, 'token');

        $results= $this->accountRepo->confirmUser($user_id);

        if($results->token == $token){
            $this->accountRepo->validateUser($user_id);
            session_start();
            $_SESSION['flash']['success'] = 'Votre compte a bien été validé';
            header('Location: index.php?page=home');
        }else{
            $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
            header('Location: index.php?page=login');
        }

    }
}