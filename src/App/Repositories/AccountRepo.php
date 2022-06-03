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

    public function isRegister($user): Account
    {
        $query = $this->pdo->prepare("SELECT id FROM Account WHERE username = ?");
        $query->execute([$user]);
        $results = $query->fetch(PDO::FETCH_ASSOC);
        return new Account($results);
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

    public function checkUser($user_id,$token): Account
    {

        $query = $this->pdo->prepare("SELECT * FROM Account WHERE id = ? AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)");
        $query->execute([$user_id,$token]);
        $results = $query->fetch(PDO::FETCH_ASSOC);
        return new Account($results);
    }

    public function reinitPassword($password,$user_id)
    {

        $password = password_hash($password, PASSWORD_BCRYPT);

        $this->pdo->prepare('UPDATE Account SET password = ?, reset_token = NULL, reset_at = NULL  WHERE id = ?')->execute([$password, $user_id]);
    }
}