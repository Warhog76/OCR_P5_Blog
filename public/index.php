<?php

use App\Repositories\{AccountRepo, ArticleRepo, CommentRepo, ErrorMessage};
use App\Routers\Routers;
use App\Controllers\{Accounts,Articles,Comments,Contact,Renderer};

require '../vendor/autoload.php';

session_start();

$router = new Routers(
    new Accounts(
        new AccountRepo(),
        new ErrorMessage(),
    ),
    new Articles(
        $article,
        $comment,
        $renderer,
        $errorMessage,
    ),
    new Comments(
        new CommentRepo(),
        new Renderer(),
        new ErrorMessage(),
    ),
    new Contact(
        new ErrorMessage(),
    ),
    new Renderer(),
);

$router->get($_GET,$_POST);

