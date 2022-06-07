<?php

namespace App\Controllers;

use App\Repositories\CommentRepo;
use phpDocumentor\Reflection\Types\Null_;

class Comments extends Controller
{

    public function __construct(
        private CommentRepo $comment,
        private Renderer $page,
    ){}

    public function addComments($comment,$name,$email,$submit): void
    {

        if ($submit !==  null) {

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
                $this->comment->addComment($name, $email, $comment);
            }
        }
    }

    public function findUnseen(): void
    {
        $commentaires = $this->comment->findUnseen();

        $this->page->renderBack('dashboard', compact('commentaires'));

    }

}