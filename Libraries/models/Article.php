<?php
namespace Models;

require_once ('libraries/database.php');
require_once ('libraries/models/Model.php');

class Article extends Model{

    protected $table = "Article";

    /**
     * find all writed articles
     */
    public function findAll() : array {

        $results = $this->pdo->query("SELECT * FROM Article WHERE posted='1' ORDER BY date DESC");
        $articles = $results->fetchAll();

        return $articles;
    }

    /**
     * find 2 last writed articles order by date desc
     */
    public function findLast(): array
    {

        $results = $this->pdo->query("SELECT * FROM Article WHERE posted='1' ORDER BY date DESC LIMIT 0,2");
        $articles = $results->fetchAll();

        return $articles;
    }

    /**
     * find article with it ID
     */
    public function findOne(int $id): array{

        $query = $this->pdo->prepare("SELECT Article.id,
                                Article.title,
                                Article.content,
                                Article.image,
                                Article.date,
                                Article.writer  
                        FROM Article
                        WHERE Article.id = :article_id");
        $query->execute(['article_id' => $id]);
        $article = $query->fetchAll();

        return $article;
    }
}