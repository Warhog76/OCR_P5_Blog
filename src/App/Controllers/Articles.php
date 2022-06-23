<?php

namespace App\Controllers;

use App\Repositories\{CommentRepo, ArticleRepo, ErrorMessage, Session};

class Articles extends Controller
{

    public function __construct(
            private ArticleRepo $post,
            private CommentRepo $comment,
            private Renderer $page,
            private ErrorMessage $error,
            private Session $session,
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

    public function post($submit,$title,$chapo,$content): void
    {

        if(isset($submit)) {
            $data = [];
            $data['title'] = $title;
            $data['chapo'] = $chapo;
            $data['content'] = $content;
            $data['writer'] = $this->session->read('user_username');

            if (empty($data['title'])) :
                $this->error->setError('Vous devez indiquez un titre', 'error');
            elseif(empty($data['chapo'])) :
                $this->error->setError('Vous devez indiquez un chapo', 'error');
            elseif(empty($data['content'])) :
                $this->error->setError('Vous devez indiquez un texte', 'error');
            /*
             * starting point for an upload picture system
             *
             * elseif(!empty($files['image']['name'])) :
                $file = $files['image']['name'];
                $extensions = ['.png', '.jpg', '.jpeg', '.gif', '.PNG', '.JPG', '.JPEG', '.GIF'];  //Ensemble de extensions autorisées
                $extension = strrchr($file, '.');

                if (!in_array($extension, $extensions)) {      //Permet de controler si l'extension de l'image est valide ou non
                    $this->error->getError("Cette image n'est pas valable", 'error');
                };
            *
            */

            else:
                $this->post->postArticle($data);
                $this->error->setError("Article bien enregistré", 'success');

                /*
                 * if (!empty($files['image']['name'])) {
                    $this->post->postImg($files['image']['tmp_name'], $extension);
                }
                *
                * */

            endif;
        }
    }

    public function showBack($postId): void
    {

        $articleId = null;

        if (!empty($postId) && ctype_digit($postId)) {
            $articleId = $postId;
        }

        $article = $this->post->findOne($articleId);

        $this->page->renderBack('article', compact('article'));

    }

    public function modify($id_article,$submit,$title,$chapo,$content,$writer): void
    {

        if (!empty($id_article) && ctype_digit($id_article)) {
            $articleId = $id_article;
        }

        if(isset($submit))
        {

            $data = [];
            $data['title'] = $title;
            $data['chapo'] = $chapo;
            $data['content'] = $content;
            $data['writer'] = $writer;
            $data['id'] = $articleId;

            if (empty($data['title'])) {
                $this->error->setError('Vous devez indiquez un titre', 'error');
            }elseif(empty($data['chapo'])) {
                $this->error->setError('Vous devez indiquez un chapo', 'error');
            }elseif(empty($data['content'])) {
                $this->error->setError('Vous devez indiquez un texte', 'error');
            }else {
                $this->post->editArticle($data);
                $this->error->setError("Votre article a bien été enregistré", 'success');
            }
        }
    }

    public function deleteArticle($articleId)
    {
        $this->post->delArticle($articleId);
        header('Location: index.php?page=list');

    }
}