<?php

namespace App\Controllers;

use App\Models\Article;
use App\Repositories\CommentRepo;
use App\Repositories\ArticleRepo;

class Articles{

    public function __construct(
            private ArticleRepo $post,
            private CommentRepo $comment,
            private Renderer $page,
    ){}

    public function index(): void
    {

        $articles = $this->post->findLast();
        $this->page->render('index', compact('articles'));
    }

    public function show(): void
    {

        $article_id = null;

        if (!empty(filter_input(INPUT_GET, 'id')) && ctype_digit(filter_input(INPUT_GET, 'id'))) {
            $article_id = filter_input(INPUT_GET, 'id');
        }

        $article = $this->post->findOne($article_id);
        $commentaires = $this->comment->findAll($article_id);

        $this->page->render('article', compact('article','commentaires'));

    }

    public function showAll(): void
    {

        $articles = $this->post->findAll();
        $this->page->render('blog', compact('articles'));

    }

    public function getAll(): void
    {

        $articles = $this->post->getAll();
        $this->page->renderBack('list', compact('articles'));

    }

    /**
     * @param array $data
     * @return array
     */
    public function getArr(array $data): array
    {
        $data['title'] = htmlspecialchars(trim(filter_input(INPUT_POST, 'title')));
        $data['chapo'] = htmlspecialchars(trim(filter_input(INPUT_POST, 'chapo')));
        $data['content'] = htmlspecialchars(trim(filter_input(INPUT_POST, 'content')));
        $data['posted'] = isset($_POST['public']) ? "1" : "0";
        return $data;
    }

    public function post(): void
    {

        if(isset($_POST['submit']))
        {
            $data = [];
            $data = $this->getArr($data);

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
                $result = $this->post->postArticle($this->post);

            }
        }
    }

    public function modify(): void
    {

        /**
         * 1. Récupération du param "id" et vérification de celui-ci
         */
        $article_id = null;

        if (!empty(filter_input(INPUT_GET, 'id')) && ctype_digit(filter_input(INPUT_GET, 'id'))) {
            $article_id = filter_input(INPUT_GET, 'id');
        }

        /**
         * 2. Récupération de l'article en question
         */
        $article = $this->post->findOne($article_id);

        $this->page->renderBack('article', compact('article'));

        if(isset($_POST['submit']))
        {
            $data = [];
            $data['id'] = $_GET['id'];
            $data = $this->getArr($data);

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

                $result = $this->post->editArticle($article);

                if($result)
                {
                    header('Location: index.php?p=article&id=' . $article->getId());
                }
            }
        }
    }
}