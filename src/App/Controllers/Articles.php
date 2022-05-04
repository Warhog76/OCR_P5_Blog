<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Utils\Renderer;

require_once('../src/App/utils.php');

class Articles extends Controller{

    protected $modelName = \App\Models\Article::class;


    public function index()
    {

        $articles = $this->model->findLast();
        $pageTitle = "Accueil";

        $page= new Renderer();

        $page->render('index', compact('pageTitle','articles'));
    }

    public function show()
    {

        $articleModel = new Article();
        $commentModel = new Comment();
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
         * 3. Récupération de l'article en question
         */

        $article = $articleModel->findOne($article_id);

        /**
         * 4. Récupération des commentaires de l'article en question
         */

        $commentaires = $commentModel->findAll($article_id);

        $page->render('article', compact('article','commentaires'));

    }

    public function showAll()
    {
        $page= new Renderer();
        $articles = $this->model->findAll();

        $page->render('blog', compact('articles'));
    }
}