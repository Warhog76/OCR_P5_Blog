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

        switch ($_GET['page']){
            case "home" || null:
                $postController->index();
            case "blog":
                $postController->showAll();
            case "article":
                $postController->show();
                $commentController->addComments();
            case "contact":
                $page->render('contact');
                $mailController->sendMail();
    }

    public function redirect(string $url): void
    {

        header("Location: $url");
        exit();
    }

}
