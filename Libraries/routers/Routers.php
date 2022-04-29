<?php

namespace Router;

use Controllers\Article;
use Controllers\Mail;

require_once ('Libraries/controllers/Article.php');
require_once ('Libraries/Controllers/Contact.php');

class Router {

    public function get()
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