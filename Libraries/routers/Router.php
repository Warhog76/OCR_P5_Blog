<?php

namespace Router;

use Controllers\Article;
use Controllers\Mail;

require_once('Libraries/controllers/article.php');
require_once('Libraries/controllers/contact.php');

/**
 * Classe permettant le routing
 */
class router
{

    public function get(): void
    {
        $postController = new Article();
        $mailController = new Mail();

        if ($_GET['page'] === 'home' || $_GET['page'] === null) :
            $postController->index();
        elseif ($_GET['page'] === 'blog') :
            $postController->showAll();
        elseif ($_GET['page'] === 'article') :
            $postController->show();
        elseif ($_GET['page'] === 'contact') :
            render('contact');
            $mailController->sendMail();
        else:
            render('404');
        endif;
    }
}

    /* $_GET['page'] =
     * / : controller = index()
     * /blog : controller = showALL()
     * /articles : controller = show()
     * /contact : controller = sendMail()
     *
     *


    public function post(): void
    {
        //parse_url() analyse une URL et retourne ses composants
        $parsed_url = parse_url($_SERVER['REQUEST_URI']);

        //soit url en question a un chemin et sinon le chemin est la racine
        $path = $parsed_url['path'] ?? '/';

        // si le chemin est bien contact alors on fait appel au fichier contact.php
        if($path == "/contact") {require_once($_SERVER["DOCUMENT_ROOT"].'Libraries/views/contact.php');}
    }

    public function error404(): void
    {

    }
}*/