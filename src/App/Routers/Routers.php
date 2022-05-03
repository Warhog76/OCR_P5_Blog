<?php

namespace App\Routers;

use App\Controllers\Article;
use App\Controllers\Mail;

require_once('../src/app/controllers/Article.php');
require_once('../src/app/controllers/Contact.php');

class Routers
{

    public function get(): void
    {
        $postController = new Article();
        $mailController = new mail();

        if($_GET['page'] === 'home' || $_GET['page'] === null) {
           $postController->index();
        }elseif ($_GET['page'] === 'blog'){
        $postController->showAll();
        }elseif ($_GET['page'] === 'article'){
            $postController->show();
        }elseif ($_GET['page'] === 'contact'){
            render('contact');
            $mailController->sendMail();
        }
    }
}