<?php

namespace App\Routers;

use App\Controllers\Accounts;
use App\Controllers\Articles;
use App\Controllers\Comments;
use App\Controllers\Contact;
use App\Controllers\Renderer;
use PHPMailer\PHPMailer\Exception;

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

    /**
     * @throws Exception
     */
    public function get(): void
    {

        if($_GET['page'] === 'home' || $_GET['page'] === null) {
            $this->postController->index();
        }elseif ($_GET['page'] === 'login'){
            $this->page->renderLog('login');
        }elseif ($_GET['page'] === 'register'){
            $this->page->renderLog('register');
            $this->accountController->register();
        }elseif ($_GET['page'] === 'confirm'){
            $this->accountController->confirm();
        }elseif ($_GET['page'] === 'blog'){
            $this->postController->showAll();
        }elseif ($_GET['page'] === 'article'){
            $this->postController->show();
            $this->commentController->addComments();
        }elseif ($_GET['page'] === 'contact'){
            $this->page->render('contact');
            $this->mailController->sendMail();
        }elseif($_GET['page'] === 'dashboard'){
            $this->commentController->findUnseen();
        }elseif ($_GET['page'] === 'list'){
            $this->postController->getAll();
        }elseif ($_GET['page'] === 'post') {
            $this->postController->modify();
        }elseif ($_GET['page'] === 'write'){
            $this->page->renderBack('write');
            $this->postController->post();
        }elseif ($_GET['page'] === 'logout') {
            $this->page->render('logout');
        }
    }
}