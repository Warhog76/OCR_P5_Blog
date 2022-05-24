<?php

namespace App\Routers;

use App\Controllers\Articles;
use App\Controllers\Comments;
use App\Controllers\Contact;
use App\Controllers\Renderer;

class Routers
{

    public function __construct(
        private Articles $postController,
        private Comments $commentController,
        private Contact $mailController,
        private Renderer $page,
    )
    {}

    public function get(): void
    {

        if($_GET['page'] === 'home' || $_GET['page'] === null) {
            $this->postController->index();
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
            $this->page->renderBack('logout');
        }
    }
}