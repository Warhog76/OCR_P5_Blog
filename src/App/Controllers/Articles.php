<?php

namespace App\Controllers;

use App\Repositories\CommentRepo;
use App\Repositories\ArticleRepo;

class Articles extends Controller
{

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

    public function show($id): void
    {

        $article_id = null;

        if (!empty($id) && ctype_digit($id)) {
            $article_id = $id;
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

    public function post($submit,$title,$chapo,$content,$posted): void
    {

        if(isset($submit))
        {
            $data = [];
            $data['title'] = $title;
            $data['chapo'] = $chapo;
            $data['content'] = $content;
            $data['posted'] = isset($posted) ? "1" : "0";

            if(empty($data['title']) || empty($data['chapo']) || empty($data['content']))
            {
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
                $this->post->postArticle($data);

                if(!empty($_FILES['image']['name'])){
                    $this->post->postImg($_FILES['image']['tmp_name'], $extension);
            }
        }}
    }

    public function modify($id,$submit,$title,$chapo,$content,$posted): void
    {

        $article_id = null;

        if (!empty($id) && ctype_digit($id)) {
            $article_id = $id;
        }

        $article = $this->post->findOne($article_id);

        $this->page->renderBack('article', compact('article'));

        if(isset($submit))
        {
            $data = [];
            $data['title'] = $title;
            $data['chapo'] = $chapo;
            $data['content'] = $content;
            $data['posted'] = isset($posted) ? "1" : "0";
            $data['id'] = $article_id;

            if(empty($data['title']) || empty($data['chapo']) || empty($data['content'])){
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
                $this->post->editArticle($data);
                header("Location: index.php?p=article&id=" .$article->getId(). " ");
            }
        }
    }
}