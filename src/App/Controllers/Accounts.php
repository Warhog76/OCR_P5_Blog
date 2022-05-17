<?php

namespace App\Controllers;

use App\Models\Account;
use App\Repositories\AccountRepo;
use App\Controllers\Renderer;

class Accounts extends Controller
{
    protected $repositoryName = AccountRepo::class;

    public function login(){

        if(isset($_POST['submit'])){
            $email = htmlspecialchars(trim($_POST['email']));
            $password = htmlspecialchars(trim($_POST['password']));

            $errors = [];

            if(empty($email) || empty($password)){
                $errors['empty'] = "Tous les champs n'ont pas été remplis!";
            }else if($this->repository->isAdmin($email,$password) == 0){
                $errors['exist']  = "Accès refusé";
            }

            if(!empty($errors)){
                ?>
                <div class="card red">
                    <div class="card-content white-text">
                        <?php
                        foreach($errors as $error){
                            echo $error."<br/>";
                        }
                        ?>
                    </div>
                </div>
                <?php
            }else{
                $_SESSION['admin'] = $email;
                $page = new Renderer();
               $page->renderBack('dashboard');
            }
        }
    }
}