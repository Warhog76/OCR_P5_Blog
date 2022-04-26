<?php

namespace Controllers;

require_once ('libraries/database.php');
require_once ('libraries/utils.php');
require_once ('libraries/controllers/Controller.php');
require_once ('libraries/models/Comment.php');

class Comment extends Controller{

    protected $modelName = \models\Comment::class;

    public function getComments(){

        if(isset($_POST['submit'])){

            // variable declaration
            $comment    	= htmlspecialchars($_POST['comment']);
            $name  		    = htmlspecialchars($_POST['name']);
            $email   		= htmlspecialchars($_POST['email']);
            $errors         = [];

            if(empty($name) || empty($email) || empty($comment)){
                $errors['empty'] = "Tous les champs n'ont pas été remplis";
            }else{
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $errors['email'] = "L'adresse email n'est pas valide";
                }
            }
            if(!empty($errors)){

                echo '<div class="card red">
                <div class="card-content white-text">';

                foreach($errors as $error){
                    echo $error."<br/>";
                }

                echo '</div>
            </div>';


            }else{
                $this->model->addComment($name,$email,$comment);
            }
        }


    }
}