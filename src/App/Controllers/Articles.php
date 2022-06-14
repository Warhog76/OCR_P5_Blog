<?php

namespace App\Controllers;

use App\Repositories\{CommentRepo,ArticleRepo,ErrorMessage};

class Articles extends Controller
{

    public function __construct(
            private ArticleRepo $post,
            private CommentRepo $comment,
            private Renderer $page,
            private ErrorMessage $error,
    ){}

    public function index(): void
    {

        $articles = $this->post->findLast();
        $this->page->render('index', compact('articles'));
    }

    public function show($postId): void
    {

        $articleId = null;

        if (!empty($postId) && ctype_digit($postId)) {
            $articleId = $postId;
        }

        $article = $this->post->findOne($articleId);
        $commentaires = $this->comment->findAll($articleId);

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

    public function post($submit,$title,$chapo,$content,$public,$files): void
    {

        if(isset($submit)) {
            $data = [];
            $data['title'] = $title;
            $data['chapo'] = $chapo;
            $data['content'] = $content;
            $data['public'] = isset($public) ? "1" : "0";

            if (empty($data['title'])) :
                $this->error->getError('Vous devez indiquez un titre', 'error');
            elseif(empty($data['chapo'])) :
                $this->error->getError('Vous devez indiquez un chapo', 'error');
            elseif(empty($data['content'])) :
                $this->error->getError('Vous devez indiquez un texte', 'error');
            elseif(!empty($files['image']['name'])) :
                $file = $files['image']['name'];
                $extensions = ['.png', '.jpg', '.jpeg', '.gif', '.PNG', '.JPG', '.JPEG', '.GIF'];  //Ensemble de extensions autorisées
                $extension = strrchr($file, '.');

                if (!in_array($extension, $extensions)) {      //Permet de controler si l'extension de l'image est valide ou non
                    $this->error->getError("Cette image n'est pas valable", 'error');
                };
            else:
                $this->post->postArticle($data);
                $this->error->getError("Article bien enregistré", 'success');

                if (!empty($files['image']['name'])) {
                    $this->post->postImg($files['image']['tmp_name'], $extension);
                };
            endif;
        }
    }

    public function modify($id,$submit,$title,$chapo,$content,$posted): void
    {

        if (!empty($id) && ctype_digit($id)) {
            $articleId = $id;
        }

        $article = $this->post->findOne($articleId);

        $this->page->renderBack('article', compact('article'));

        if(isset($submit))
        {
            $data = [];
            $data['title'] = $title;
            $data['chapo'] = $chapo;
            $data['content'] = $content;
            $data['posted'] = isset($posted) ? "1" : "0";
            $data['id'] = $articleId;

            if (empty($data['title'])) :
                $this->error->getError('Vous devez indiquez un titre', 'error');
            elseif(empty($data['chapo'])) :
                $this->error->getError('Vous devez indiquez un chapo', 'error');
            elseif(empty($data['content'])) :
                $this->error->getError('Vous devez indiquez un texte', 'error');
            else:
                $this->post->editArticle($data);
                $this->error->getError("Votre article a bien été enregistré", 'success');
                header('Location: index.php?page=list');
            endif;
        }
    }
}