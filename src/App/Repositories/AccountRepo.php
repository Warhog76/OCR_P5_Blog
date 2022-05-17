<?php

namespace App\Repositories;

use PDO;
use App\Models\Account;

class AccountRepo extends Repository
{

    protected $table = "Article";


    public function isAdmin($email, $password): int
    {

        $a = [
            'email' => $email,
            'password' => $password
        ];

        $sql = "SELECT * FROM Account WHERE email = :email AND password = :password";

        $req = $this->pdo->prepare($sql);
        $req->execute($a);
        return $req->rowCount();
    }
}