<?php

namespace App\Controllers;

use App\Repositories\CommentRepo;
use App\Repositories\ArticleRepo;

class Articles extends Controller{

    protected $repositoryName = ArticleRepo::class;

    public function index()
    {

        $articles = $this->repository->findLast();
        $pageTitle = "Accueil";

        $page= new Renderer();
        $page->render('index', compact('pageTitle','articles'));
    }

    public function show()
    {

        $articleRepo = new ArticleRepo();
        $commentRepo = new CommentRepo();
        $page= new Renderer();

         /**
         * 1. Récupération du param "id" et vérification de celui-ci
         */
        $article_id = null;

        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $article_id = $_GET['id'];
        }

        if (!$article_id) {
            die("Vous devez préciser un paramètre `id` dans l'URL !");
        }

        /**
         * 2. Récupération de l'article en question
         */
        $article = $articleRepo->findOne($article_id);

        /**
         * 3. Récupération des commentaires de l'article en question
         */
        $commentaires = $commentRepo->findAll($article_id);

        $page->render('article', compact('article','commentaires'));

    }

    public function showAll()
    {

        $articles = $this->repository->findAll();

        $page= new Renderer();
        $page->render('blog', compact('articles'));


    }
}