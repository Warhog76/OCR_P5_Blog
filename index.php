<?php

require_once('Libraries/routers/router.php');

use Router\router;

ini_set('display_errors','on');
error_reporting(E_ALL);

$router = new router();
$router->get();

/*
 * In the URL -> http://localhost:8888/OCR_P5_Blog/
 * The output -> Index
 * $router->get("/", 'Libraries/views/home.php');
 *
 * In the URL -> http://localhost:8888/OCR_P5_Blog/blog
 * The output -> blog
 * $router->get("/blog", 'Libraries/views/blog.php');
 *
 * In the URL -> http://localhost:8888/OCR_P5_Blog/article/$id
 * The $id will be available in article.php
 * $router->get("/article/$id", 'Libraries/views/article.php');
 *
 * In the URL -> http://localhost:8888/OCR_P5_Blog/contact
 * The output -> contact
 * $router->get("/contact", 'Libraries/views/contact.php');
 *
 */