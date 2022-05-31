<?php

namespace App\Repositories;

class AccountRepo extends Repository
{

    public function isUser($user)
    {
        $req = $this->pdo->prepare("SELECT * FROM Account WHERE email = ? AND confirmed_at IS NOT NULL");
        $req->execute([$user]);
        return $req->fetch();
    }

    public function isRegister($user)
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
        return $req->fetch();

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

    public function modPassword()
    {

        $user_id = $_SESSION['auth']->id;
        $password = password_hash(filter_input(INPUT_POST, 'password'), PASSWORD_BCRYPT);

        $this->pdo->prepare('UPDATE Account SET password = ? WHERE id = ?')->execute([$password, $user_id]);
    }

    public function lost($user)
    {
        $req = $this->pdo->prepare("SELECT * FROM Account WHERE email = ? AND confirmed_at IS NOT NULL");
        $req->execute([$user]);
        return $req->fetch();
    }

    public function newPassword($token, $id)
    {

        $this->pdo->prepare("UPDATE Account SET reset_token = ?, reset_at = NOW() where id = ?")->execute([$token, $id]);
    }

}