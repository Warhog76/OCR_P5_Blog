<?php

namespace App\Repository;

class Article extends Model
{

    protected $table = "Article";

    /**
     * find all writed articles
     */
    public function findAll() : array
    {

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
    public function findOne(int $id): array
    {

        $query = $this->pdo->prepare("SELECT   article.id,
                                article.title,
                                article.content,
                                article.image,
                                article.date,
                                account.name   
                        FROM Article
                        Join Account
                        ON Article.writer=Account.email
                        WHERE article.id = :article_id");
        $query->execute(['article_id' => $id]);

        return $query->fetch();
    }
}