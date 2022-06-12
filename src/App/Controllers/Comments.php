<?php

namespace App\Controllers;

use App\Repositories\CommentRepo;
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

            $errors = [];

            if (empty($name) || empty($email) || empty($comment)) {
                $errors['empty'] = "Tous les champs n'ont pas été remplis";
            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "L'adresse email n'est pas valide";
                }
            }
            if (!empty($errors)) {

                echo '<div class="card red">
                <div class="card-content white-text">';

                foreach ($errors as $error) {
                    echo $error . "<br/>";
                }

                echo '</div>
            </div>';


            } else {
                $this->commentRepo->addComment($name, $email, $comment,$commentId);
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