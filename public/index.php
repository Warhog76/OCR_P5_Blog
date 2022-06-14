<?php

use App\Repositories\{AccountRepo,ArticleRepo,CommentRepo,Session,ErrorMessage};
use App\Routers\Routers;
use App\Controllers\{Accounts,Articles,Comments,Contact,Renderer};

require '../vendor/autoload.php';

$router = new Routers(
    new Accounts(
        new AccountRepo(),
        new Session(),
        new ErrorMessage(),
    ),
    new Articles(
        new ArticleRepo(),
        new CommentRepo(),
        new Renderer(),
        new ErrorMessage(),
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

