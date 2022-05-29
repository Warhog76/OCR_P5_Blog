<?php

namespace App\Repositories;

use PDO;
use App\Models\Account;

class AccountRepo extends Repository
{


    public function isUser($user): mixed
    {
        $req = $this->pdo->prepare("SELECT id FROM Account WHERE username = ?");
        $req->execute([$user]);
        return $req->fetch();

    }

    public function registerUser()
    {
        $req = $this->pdo->prepare("INSERT INTO Account SET username = ?, password = ?, email = ?, confirmation_token = ?");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $token = $this->str_random(60);
        $req->execute([$_POST['username'], $password, $_POST['email'], $token]);
        mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte, merci de cliquer sur ce lien\n\n
        http://localhost:8888/OCR_P5_Blog/public/index.php?page=confirm?id"."&token=$token");

    }

}