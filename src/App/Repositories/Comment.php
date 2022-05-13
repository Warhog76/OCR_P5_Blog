<?php

namespace App\Repositories;

class Comment extends Model
{
    protected $table = "Comment";

    /**
     * findAllComments
     *
     */
    public function findAll(int $id): array
    {

        $query = $this->pdo->prepare("SELECT * FROM Comment WHERE article_id = :article_id ORDER BY date DESC");
        $query->execute(['article_id' => $id]);
        return $query->fetchAll();
    }

    public function addComment($name,$email,$comment){

        $c = array(
            'name'        => $name,
            'email'       => $email,
            'comment'     => $comment,
            'article_id'  => $_GET["id"]
        );

        //ecriture de la requete
        $sql = "INSERT INTO Comment (comment, name, email, date, article_id)
          VALUES (:comment,:name, :email, NOW(), :article_id)";

        //preparation
        $addComment = $this->pdo->prepare($sql);

        //execution
        $addComment->execute($c);

    }
}