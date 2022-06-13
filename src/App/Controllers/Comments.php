<?php

namespace App\Controllers;

use App\Repositories\CommentRepo;
use App\Repositories\ErrorMessage;
use phpDocumentor\Reflection\Types\Null_;

class Comments extends Controller
{

    public function __construct(
        private CommentRepo $commentRepo,
        private Renderer    $page,
    ){}

    public function addComments($comment,$name,$email,$submit,$commentId): void
    {

        if (isset($submit)) {

            if (empty($name)) {
                ErrorMessage::getError('Vous devez indiquez un nom', 'error');
            } elseif (empty($email)) {
                ErrorMessage::getError('Vous devez indiquez un email', 'error');
            } elseif (empty($comment)) {
                ErrorMessage::getError('Votre message est manquant', 'error');
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                ErrorMessage::getError("votre adresse email n'est pas valide", 'error');
            } else {
                $this->commentRepo->addComment($name, $email, $comment, $commentId);
                ErrorMessage::getError("Merci pour votre commentaire", 'success');
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