<?php

namespace App\Controllers;

require_once('../src/App/utils.php');

class Article extends Controller{

    protected $modelName = \App\Models\Article::class;

    public function index()
    {

        $articles = $this->model->findLast();
        $pageTitle = "Accueil";

        render('index', compact('pageTitle','articles'));
    }

    public function show()
    {

        $articleModel = new \App\Models\Article();
        $commentModel = new \App\Models\Comment();

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

         /**
         * 5. On affiche
         */
        $pageTitle = $article['title'];

        render('article', compact('pageTitle','article','commentaires','article_id'));

    }

    public function showAll()
    {

        $articles = $this->model->findAll();

        render('blog', compact('articles'));
    }
}