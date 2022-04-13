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

        $query = $this->pdo->prepare("SELECT * FROM Comment WHERE article_id = :article_id ORDER BY date DESC");
        $query->execute(['article_id' => $id]);
        $commentaires = $query->fetchAll();

        return $commentaires;
    }

}