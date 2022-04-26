<?php

namespace Models;

require_once ('libraries/database.php');
require_once ('libraries/models/Model.php');

class Comment extends Model {

    protected $table = "Comment";

    /**
     * findAllComments
     *
     */
    public function findAll(int $id): array {

        $query = $this->pdo->prepare("SELECT * 
                    FROM Comment
                    WHERE article_id = :article_id
                    ORDER BY date DESC");
        $query->execute(['article_id' => $id]);
        $commentaires = $query->fetchAll();

        return $commentaires;
    }

    public function addComment($name,$email,$comment){

        $c = array(
            'name'        => $name,
            'email'       => $email,
            'comment'     => $comment,
            'article_id'  => $_GET["id"]
        );

        $sql = "INSERT INTO Comment (comment, name, email, date, article_id)
          VALUES (:comment,:name, :email, NOW(), :article_id)";

        $addComment = $this->pdo->prepare($sql);
        $rec = $addComment->execute($c);

        //verification
        if ($rec) {
            echo "commentaire enregistré";
        }else{
            echo "une erreur est survenue";
        }
    }

}