<?php

namespace App\Repositories;

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
        $req = $this->pdo->prepare("INSERT INTO Account SET username = ?, password = ?, email = ?, token = ?");
        $password = password_hash(filter_input(INPUT_POST, 'password'), PASSWORD_BCRYPT);
        $token = $this->str_random(60);
        $req->execute([filter_input(INPUT_POST, 'username'), $password, filter_input(INPUT_POST, 'email'), $token]);

        /*
         * $user_id = $this->pdo->lastInsertId();
         * mail(filter_input(INPUT_POST, 'email'), 'Confirmation de votre compte', "Afin de valider votre compte, merci de cliquer sur ce lien\n\n
         * http://localhost:8888/OCR_P5_Blog/public/index.php?page=confirm&id=$user_id&token=$token");
         * */
    }

    public function confirmUser($user_id)
    {

        $req = $this->pdo->prepare('SELECT * FROM Account WHERE id = ?');
        $req->execute([$user_id]);
        return $req->fetch();

    }

    public function validateUser($user_id)
    {
        $this->pdo->prepare('UPDATE Account SET token = NULL, confirmed_at=NOW() WHERE id = ?')->execute([$user_id]);

    }

}