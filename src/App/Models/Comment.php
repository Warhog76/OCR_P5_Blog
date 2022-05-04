<?php

namespace App\Models;

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
}