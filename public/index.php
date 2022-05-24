<?php

use App\Repositories\ArticleRepo;
use App\Repositories\CommentRepo;
use App\Routers\Routers;
use App\Controllers\Articles;
use App\Controllers\Comments;
use App\Controllers\Contact;
use App\Controllers\Renderer;

require '../vendor/autoload.php';

$router = new Routers(
    new Articles(
        new ArticleRepo(),
        new CommentRepo(),
        new Renderer(),
    ),
    new Comments(),
    new Contact(),
    new renderer(),
);
$router->get();
