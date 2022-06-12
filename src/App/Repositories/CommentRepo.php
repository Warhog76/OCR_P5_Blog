<?php

namespace App\Repositories;

use App\Models\Comment;
use PDO;

class CommentRepo extends Repository
{
    protected $table = "Comment";

    /**
     * findAllComments
     *
     */
    public function findAll(int $commentId): array
    {
        $commentaires = [];
        $query = $this->pdo->prepare("SELECT * FROM Comment WHERE article_id = :article_id ORDER BY date DESC");
        $query->execute(['article_id' => $commentId]);
        while ($results = $query->fetch(PDO::FETCH_ASSOC)){

            $commentaires [] = new Comment($results);
        }
        $query->closeCursor();

        return $commentaires;
    }

    public function addComment($name,$email,$comment,$commentId){

        $c = array(
            'name'        => $name,
            'email'       => $email,
            'comment'     => $comment,
            'article_id'  => $commentId
        );

        $sql = "INSERT INTO Comment (comment, name, email, date, article_id)
          VALUES (:comment,:name, :email, NOW(), :article_id)";
        $addComment = $this->pdo->prepare($sql);
        $addComment->execute($c);

    }

    public function delComment($commentId): void
    {
        $this->pdo->exec("DELETE FROM Comment WHERE id= $commentId");
    }

    public function validComment($commentId): void
    {

        $this->pdo->exec("UPDATE Comment SET seen = '1' WHERE id= $commentId");
    }

    public function findUnseen(): array
    {
        $commentaires = [];
        $query = $this->pdo->query("SELECT  * FROM Comment WHERE seen = '0' ORDER BY date ASC");

        while ($results = $query->fetch(PDO::FETCH_ASSOC)){

            $commentaires [] = new Comment($results);
        }
        $query->closeCursor();

        return $commentaires;
    }
}