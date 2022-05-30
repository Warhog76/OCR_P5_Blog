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
    public function findAll(int $id): array
    {
        $commentaires = [];
        $query = $this->pdo->prepare("SELECT * FROM Comment WHERE article_id = :article_id ORDER BY date DESC");
        $query->execute(['article_id' => $id]);
        while ($results = $query->fetch(PDO::FETCH_ASSOC)){

            $commentaires [] = new Comment($results);
        }
        $query->closeCursor();

        return $commentaires;
    }

    public function addComment($name,$email,$comment){

        $c = array(
            'name'        => $name,
            'email'       => $email,
            'comment'     => $comment,
            'article_id'  => filter_input(INPUT_GET, 'id')
        );

        //ecriture de la requete
        $sql = "INSERT INTO Comment (comment, name, email, date, article_id)
          VALUES (:comment,:name, :email, NOW(), :article_id)";

        //preparation
        $addComment = $this->pdo->prepare($sql);

        //execution
        $addComment->execute($c);

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