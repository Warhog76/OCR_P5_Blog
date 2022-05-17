<?php

namespace App\Routers;

use App\Controllers\Articles;
use App\Controllers\Comments;
use App\Controllers\Contact;
use App\Controllers\Renderer;

class Routers
{

    public function get(): void
    {
        $postController = new Articles();
        $mailController = new Contact();
        $commentController = new Comments();
        $page= new Renderer();

        if($_GET['page'] === 'home' || $_GET['page'] === null) {
            $postController->index();
        }elseif ($_GET['page'] === 'blog'){
            $postController->showAll();
        }elseif ($_GET['page'] === 'article'){
            $postController->show();
            $commentController->addComments();
        }elseif ($_GET['page'] === 'contact'){
            $page->render('contact');
            $mailController->sendMail();
        }elseif($_GET['page'] === 'dashboard' || $_GET['page'] === null){
            $commentController->findUnseen();
        }elseif ($_GET['page'] === 'list'){
            $postController->getAll();
        }elseif ($_GET['page'] === 'articlemod') {
            $postController->modify();
        }elseif ($_GET['page'] === 'write'){
            $page->renderBack('write');
            $postController->post();
        }elseif ($_GET['page'] === 'logout') {
            $page->renderBack('logout');
        }
    }
}