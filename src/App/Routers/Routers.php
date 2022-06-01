<?php

namespace App\Routers;

use App\Controllers\{Accounts,Articles,Comments,Contact,Renderer};

class Routers
{

    public function __construct(
        private Accounts $accountController,
        private Articles $postController,
        private Comments $commentController,
        private Contact $mailController,
        private Renderer $page,
    )
    {}

    public function get($get, $post): void
    {

        if($get['page'] === 'home' || $get['page'] === null) {
            $this->postController->index();
        }elseif ($get['page'] === 'login'){
           $password=$email=$submit=null;
            if(isset($post['submit'])){
                $password=$post['password'];
                $email=$post['email'];
                $submit=$post['submit'];
            }
            $this->accountController->login($password,$email,$submit);
            $this->page->renderLog('login');
        }elseif ($get['page'] === 'remember'){
            $email=$submit=null;
            if(isset($post['submit'])){
                $email=$post['email'];
                $submit=$post['submit'];
            }
            $this->accountController->remember($email, $submit);
            $this->page->renderLog('remember');
        }elseif ($get['page'] === 'account'){
            $password=$passwordConfirm=$submit=null;
            if(isset($post['submit'])){
                $password=$post['password'];
                $passwordConfirm=$post['password_confirm'];
                $submit=$post['submit'];
            }
            $this->accountController->modPassword($password,$passwordConfirm,$submit);
            $this->page->render('account');
        }elseif($get['page'] === 'register'){
            $username=$password=$passwordConfirm=$email=$submit=null;
            if(isset($post['submit'])){
                $username=$post['username'];
                $password=$post['password'];
                $passwordConfirm=$post['password_confirm'];
                $email=$post['email'];
                $submit=$post['submit'];
            }
            $this->accountController->register($username,$password,$passwordConfirm,$email,$submit);
            $this->page->renderLog('register');
        }elseif($get['page'] === 'confirm'){
            $userId=$get['id'];
            $token=$get['token'];
            $this->accountController->confirm($userId,$token);
        }elseif ($get['page'] === 'blog'){
            $this->postController->showAll();
        }elseif ($get['page'] === 'article'){
            $this->postController->show();
            $this->commentController->addComments();
        }elseif ($get['page'] === 'contact'){
            $this->page->render('contact');
            $email=$subject=$message=$submit=null;
            if(isset($post['submit'])){
                $email=$post['email'];
                $subject=$post['subject'];
                $message=$post['message'];
                $submit=$post['submit'];
            }
            $this->mailController->sendMail($email,$subject,$message,$submit);

        }elseif($get['page'] === 'dashboard'){
            $this->commentController->findUnseen();
        }elseif ($get['page'] === 'list'){
            $this->postController->getAll();
        }elseif ($get['page'] === 'post') {
            $this->postController->modify();
        }elseif ($get['page'] === 'write'){
            $this->page->renderBack('write');
            $this->postController->post();
        }elseif ($get['page'] === 'logout') {
            $this->page->render('logout');
        }
    }
}