<?php

namespace Controllers;

require_once ('libraries/utils.php');
require_once ('libraries/controllers/Controller.php');
require_once ('libraries/models/Article.php');
require_once ('libraries/models/Comment.php');

class Article extends Controller{

    protected $modelName = \models\Article::class;

    public function index(){

        $articles = $this->model->findLast();
        $pageTitle = "Accueil";

        render('index', compact('pageTitle','articles'));
    }

    public function show(){

        $commentModel = new \models\Comment();

        // 1. Récupération du param "id" et vérification de celui-ci
        $article_id = null;

        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $article_id = $_GET['id'];
        }

        if (!$article_id) {
            die("Vous devez préciser un paramètre `id` dans l'URL !");
        }

        //3. Récupération de l'article en question
        $article = $this->model->findOne($article_id);

        // 4. Récupération des commentaires de l'article en question
        $commentaires = $commentModel->findAll($article_id);

        render('article', compact("article","commentaires"));
    }

    public function showAll(){

        $articles = $this->model->findAll();

        render('blog', compact('articles'));
    }

}