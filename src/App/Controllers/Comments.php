<?php

namespace App\Controllers;

use App\Repositories\CommentRepo;

class Comments {

    public function __construct(
        private CommentRepo $comment,
        private Renderer $page,
    ){}

    public function addComments(): void
    {

        if (isset($_POST['submit'])) {

            // variable declaration
            $comment = htmlspecialchars(filter_input(INPUT_POST, 'comment'));
            $name = htmlspecialchars(filter_input(INPUT_POST, 'name'));
            $email = htmlspecialchars(filter_input(INPUT_POST, 'email'));
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