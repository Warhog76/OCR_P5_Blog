<?php

namespace App\Controllers;

use App\Models\Article;
use App\Repositories\CommentRepo;
use App\Repositories\ArticleRepo;

class Articles extends Controller{

    protected $repositoryName = ArticleRepo::class;

    public function index()
    {

        $articles = $this->repository->findLast();

        $page= new Renderer();
        $page->render('index', compact('articles'));
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

    public function getAll()
    {

        $articles = $this->repository->getAll();

        $page= new Renderer();
        $page->renderBack('list', compact('articles'));

    }

    public function post()
    {
        $articleRepo = new ArticleRepo();

        if(isset($_POST['submit']))
        {
            $data = [];
            $data['title'] = htmlspecialchars(trim($_POST['title']));
            $data['chapo'] = htmlspecialchars(trim($_POST['chapo']));
            $data['content'] = htmlspecialchars(trim($_POST['content']));
            $data['posted'] = isset($_POST['public']) ? "1" : "0";

            if(empty($data['title']) || empty($data['chapo']) || empty($data['content']))
            {

            ?>
                <div class="card red">
                    <div class="card-content white-text">
                        <?php
                        echo "Veuillez remplir tous les champs"
                        ?>
                    </div>
                </div>

            <?php

                /*if(!empty($_FILES['image']['name'])) {
                    $file = $_FILES['image']['name'];
                    $extensions = ['.png', '.jpg', '.jpeg', '.gif', '.PNG', '.JPG', '.JPEG', '.GIF'];  //Ensemble des extensions autorisées
                    $extension = strrchr($file, '.');
                    $errors = [];

                    if (!in_array($extension, $extensions)) {      //Permet de contrôler si l'extension de l'image est valide ou non
                        $errors['image'] = "Cette image n'est pas valable";
                    }
                }*/
            }else{
                $article = new Article($data);
                $result = $articleRepo->postArticle($article);

            }
        }
    }

    public function modify()
    {

        $articleRepo = new ArticleRepo();
        $page= new Renderer();

        /**
         * 1. Récupération du param "id" et vérification de celui-ci
         */
        $article_id = null;

        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $article_id = $_GET['id'];
        }

        /**
         * 2. Récupération de l'article en question
         */
        $article = $articleRepo->findOne($article_id);

        $page->renderBack('article', compact('article'));

        if(isset($_POST['submit']))
        {
            $data = [];
            $data['id'] = $_GET['id'];
            $data['title'] = htmlspecialchars(trim($_POST['title']));
            $data['chapo'] = htmlspecialchars(trim($_POST['chapo']));
            $data['content'] = htmlspecialchars(trim($_POST['content']));
            $data['posted'] = isset($_POST['public']) ? "1" : "0";

            if(empty($data['title']) ||empty($data['content'])){
                ?>

                <div class="card red">
                    <div class="card-content white-text">
                        <?php
                        echo "Veuillez remplir tous les champs"
                        ?>
                    </div>
                </div>

        <?php
            }else{
                $article = new Article($data);
                $result = $articleRepo->editArticle($article);

                if($result)
                {
                    header('Location: index.php?p=article&id=' . $article->getId());
                }
            }
        }
    }
}