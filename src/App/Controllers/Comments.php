<?php

namespace App\Controllers;

use App\Repositories\{CommentRepo, ErrorMessage, Session};

class Comments extends Controller
{

    public function __construct(
        private CommentRepo $commentRepo,
        private Renderer    $page,
        private ErrorMessage $error,
        private Session $session,
    ){}

    public function addComments($comment,$name,$email,$csrf_token,$submit,$commentId): void
    {

        if($submit !== null){

            if ($csrf_token != ($this->session->read('csrf_token'))){

                $this->error->setError("csrf_token error", 'error');
                return;
            }

            if (empty($name)) {
                $this->error->setError('Vous devez indiquez un nom', 'error');
            } elseif (empty($email)) {
                $this->error->setError('Vous devez indiquez un email', 'error');
            } elseif (empty($comment)) {
                $this->error->setError('Votre message est manquant', 'error');
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error->setError("votre adresse email n'est pas valide", 'error');
            } else {
                $this->commentRepo->addComment($name, $email, $comment, $commentId);
                $subject = "Nouveau commentaire";
                $message = "un nouveau commentaire a ete poste et necessite votre moderation. Voici le message : " .$comment. " ";
                $this->mailer($email,$subject,$message);
                $this->error->setError("Merci pour votre commentaire", 'success');
            }
        }
    }

    public function findUnseen(): void
    {
        $commentaires = $this->commentRepo->findUnseen();

        $this->page->renderBack('dashboard', compact('commentaires'));

    }

    public function validateComment($commentId)
    {
        $this->commentRepo->validComment($commentId);
        header('Location: index.php?page=dashboard');

    }

    public function deleteComment($commentId)
    {
        $this->commentRepo->delComment($commentId);
        header('Location: index.php?page=dashboard');

    }
}