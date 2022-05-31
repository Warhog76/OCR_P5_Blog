<?php

namespace App\Routers;

use App\Controllers\Accounts;
use App\Controllers\Articles;
use App\Controllers\Comments;
use App\Controllers\Contact;
use App\Controllers\Renderer;

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

    public function get(): void
    {

        if(filter_input(INPUT_GET, 'page') === 'home' || filter_input(INPUT_GET, 'page') === null) {
            $this->postController->index();
        }elseif (filter_input(INPUT_GET, 'page') === 'login'){
            $this->page->renderLog('login');
            $this->accountController->login();
        }elseif (filter_input(INPUT_GET, 'page') === 'account'){
            $this->page->render('account');
            $this->accountController->newPassword();
        }elseif (filter_input(INPUT_GET, 'page') === 'register'){
            $this->page->renderLog('register');
            $this->accountController->register();
        }elseif (filter_input(INPUT_GET, 'page') === 'confirm'){
            $this->accountController->confirm();
        }elseif (filter_input(INPUT_GET, 'page') === 'blog'){
            $this->postController->showAll();
        }elseif (filter_input(INPUT_GET, 'page') === 'article'){
            $this->postController->show();
            $this->commentController->addComments();
        }elseif (filter_input(INPUT_GET, 'page') === 'contact'){
            $this->page->render('contact');
            $this->mailController->sendMail();
        }elseif(filter_input(INPUT_GET, 'page') === 'dashboard'){
            $this->commentController->findUnseen();
        }elseif (filter_input(INPUT_GET, 'page') === 'list'){
            $this->postController->getAll();
        }elseif (filter_input(INPUT_GET, 'page') === 'post') {
            $this->postController->modify();
        }elseif (filter_input(INPUT_GET, 'page') === 'write'){
            $this->page->renderBack('write');
            $this->postController->post();
        }elseif (filter_input(INPUT_GET, 'page') === 'logout') {
            $this->page->render('logout');
        }
    }
}