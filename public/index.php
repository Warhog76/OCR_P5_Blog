<?php

use App\Repositories\{AccountRepo, ArticleRepo, CommentRepo, ErrorMessage, Session};
use App\Routers\Routers;
use App\Controllers\{Accounts,Articles,Comments,Contact,Renderer};

require '../vendor/autoload.php';

$session = Session::getInstance();
$renderer = new Renderer($session);
$errorMessage = new ErrorMessage($session);
$article = new ArticleRepo();
$comment = new CommentRepo();

$router = new Routers(
    new Accounts(
        new AccountRepo(),
        $errorMessage,
        $session
    ),
    new Articles(
        $article,
        $comment,
        $renderer,
        $errorMessage,
        $session,
    ),
    new Comments(
        $comment,
        $renderer,
        $errorMessage,
        $session,
    ),
    new Contact(
        $errorMessage,
        $session,
    ),
    $renderer,
    $session,

);

$router->get($_GET,$_POST);

