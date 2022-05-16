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

    public function post()
    {

        if(isset($_POST['submit'])){
            $title = htmlspecialchars(trim($_POST['title']));
            $content = htmlspecialchars(trim($_POST['content']));
            $posted = isset($_POST['public']) ? "1" : "0";

            $errors = [];

            if(empty($title) || empty($content)){
                $errors['empty'] = "Veuillez remplir tous les champs";
            }

            if(!empty($_FILES['image']['name'])){
                $file = $_FILES['image']['name'];
                $extensions = ['.png','.jpg','.jpeg','.gif','.PNG','.JPG','.JPEG','.GIF'];  //Ensemble de extensions autorisées
                $extension = strrchr($file,'.');

            if(!in_array($extension,$extensions)){      //Permet de controler si l'extension de l'image est valide ou non
                $errors['image'] = "Cette image n'est pas valable";
            }
        }

        if(!empty($errors)){
        ?>

        <div class="card red">
            <div class="card-content white-text">
                <?php
                foreach($errors as $error){
                    echo $error."<br/>";
                }
                ?>
            </div>
        </div>

        <?php
        }else{
            post($title,$content,$posted);

            if(!empty($_FILES['image']['name'])){
                post_img($_FILES['image']['tmp_name'], $extension);
            }else{
                $id = $db->lastInsertId();
                header("Location:../index.php?page=post&id=".$id);
            }
        }
    }
    }
}