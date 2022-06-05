<?php

use App\Repositories\{AccountRepo,ArticleRepo,CommentRepo};
use App\Routers\Routers;
use App\Controllers\{Accounts,Articles,Comments,Contact,Renderer};

require '../vendor/autoload.php';

$router = new Routers(
    new Accounts(
        new AccountRepo(),
    ),
    new Articles(
        new ArticleRepo(),
        new CommentRepo(),
        new Renderer(),
    ),
    new Comments(
        new CommentRepo(),
        new Renderer(),
    ),
    new Contact(),
    new Renderer(),
);

$router->get($_GET,$_POST,$_SESSION);

