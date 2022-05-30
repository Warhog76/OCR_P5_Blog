<?php

namespace App\Controllers;

use App\Repositories\AccountRepo;

class Accounts
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

    public function register(): void
    {

        $username = htmlspecialchars(trim(filter_input(INPUT_POST, 'username')));
        $email = htmlspecialchars(trim(filter_input(INPUT_POST, 'email')));
        $password = htmlspecialchars(trim(filter_input(INPUT_POST, 'password')));
        $passwordConfirm = htmlspecialchars(trim(filter_input(INPUT_POST, 'password_confirm')));

        if (!empty($_POST)){

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
                $this->accountRepo->registerUser();
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
}