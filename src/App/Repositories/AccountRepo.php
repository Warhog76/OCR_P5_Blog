<?php

namespace App\Repositories;

use App\Models\Account;
use PDO;

class AccountRepo extends Repository
{

    public function isUser($mail): Account
    {
        $query = $this->pdo->prepare("SELECT * FROM Account WHERE email = ? AND confirmed_at IS NOT NULL");
        $query->execute([$mail]);
        $results = $query->fetch(PDO::FETCH_ASSOC);
        return new Account($results);
    }

    public function isRegister($user)
    {
        $req = $this->pdo->prepare("SELECT id FROM Account WHERE username = ?");
        $req->execute([$user]);
        return $req->fetch();
    }

    public function registerUser($username,$password,$email): array
    {
        $req = $this->pdo->prepare("INSERT INTO Account SET username = ?, password = ?, email = ?, token = ?");
        $password = password_hash($password, PASSWORD_BCRYPT);
        $token = $this->str_random(60);
        $req->execute([$username, $password, $email, $token]);

        $user_id=$this->pdo->lastInsertId();
        return compact('user_id','token');

    }

    public function confirmUser($user_id): Account
    {

        $query = $this->pdo->prepare('SELECT * FROM Account WHERE id = ?');
        $query->execute([$user_id]);
        $results = $query->fetch(PDO::FETCH_ASSOC);
        return new Account($results);
    }

    public function validateUser($user_id)
    {
        $this->pdo->prepare('UPDATE Account SET token = NULL, confirmed_at=NOW() WHERE id = ?')->execute([$user_id]);

    }

    public function modPassword($password)
    {

        $user_id = $_SESSION['auth']->id;
        $password = password_hash($password, PASSWORD_BCRYPT);

        $this->pdo->prepare('UPDATE Account SET password = ? WHERE id = ?')->execute([$password, $user_id]);
    }

    public function lost($user): Account
    {

        $query = $this->pdo->prepare("SELECT * FROM Account WHERE email = :email AND confirmed_at IS NOT NULL");
        $query->execute(['email' => $user]);
        $results = $query->fetch(PDO::FETCH_ASSOC);
        return new Account($results);
    }

    public function newPassword($token, $id)
    {

        $this->pdo->prepare("UPDATE Account SET reset_token = ?, reset_at = NOW() where id = ?")->execute([$token, $id]);
    }

}