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

        if(isset($_POST)){
            $email = htmlspecialchars(trim(filter_input(INPUT_POST, 'email')));
            $password = htmlspecialchars(trim(filter_input(INPUT_POST, 'password')));

            $errors = [];
            $results = $this->accountRepo->isUser($email);

            if(empty($email) || empty($password)){
                $errors['empty'] = "Tous les champs n'ont pas été remplis!";
            }elseif($results->email == null){
                $errors['exist']  = "Accès refusé";
            }elseif(password_verify($password, $results->password)){
                $errors['exist']  = "Mot de passe incorrect";
            };

            if(!empty($errors)){
                    ?>
                <div class="container">
                    <div class="card red">
                        <div class="card-content white-text">
                            <?php
                            foreach($errors as $error){
                                echo $error."<br/>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }else{
                $_SESSION['admin'] = $email;
                header('Location: index.php?page=home');
            };
        }
    }

    public function register(): void
    {

        $username = htmlspecialchars(trim(filter_input(INPUT_POST, 'username')));
        $email = htmlspecialchars(trim(filter_input(INPUT_POST, 'email')));
        $password = htmlspecialchars(trim(filter_input(INPUT_POST, 'password')));
        $passwordConfirm = htmlspecialchars(trim(filter_input(INPUT_POST, 'password_confirm')));

        if (!empty($_POST)){
            $errors = [];
            if (empty($username) || !preg_match('/^[\w_]+$/', $username)) {
                $errors['username'] = "Votre pseudo est invalide";
            }else{
                $user = $this->accountRepo->isRegister($username);
                if($user){
                    $errors['username'] = "Ce pseudo existe déjà";
                }
            }
            if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Votre email est invalide";
            }
            if(empty($password) || $password != $passwordConfirm) {
                $errors['password'] = "Vous devez rentrer un mot de passe valide";
            }

            if(!empty($errors)){
                ?>
                <div class="container">
                    <div class="card red">
                        <div class="card-content white-text">
                            <?php
                            foreach($errors as $error){
                                echo $error."<br/>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
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