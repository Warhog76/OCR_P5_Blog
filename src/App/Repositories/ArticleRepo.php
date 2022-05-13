<?php

namespace App\Repositories;

use PDO;
use App\Models\Article;

class ArticleRepo extends Model
{

    protected $table = "Article";

    /**
     * find all articles
     */
    public function findAll() : array
    {

        $results = $this->pdo->query("SELECT * FROM Article WHERE posted='1' ORDER BY date DESC");
        return $results->fetchAll();

    }

    /**
     * find 2 last articles order by date desc
     */
    public function findLast(): array
    {

        $results = $this->pdo->query("SELECT * FROM Article WHERE posted='1' ORDER BY date DESC LIMIT 0,2");
        return $results->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * find article with it ID
     */
    public function findOne(int $id): Article
    {

        $query = $this->pdo->prepare("SELECT   *
                        FROM Article
                        WHERE article.id = :article_id");
        $query->execute(['article_id' => $id]);
        $results = $query->fetch(PDO::FETCH_ASSOC);
        return new Article($results);
    }
}