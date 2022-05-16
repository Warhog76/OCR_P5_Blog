<?php

namespace App\Repositories;

use PDO;
use App\Models\Article;

class ArticleRepo extends Repository
{

    protected $table = "Article";

    /**
     * find all articles
     */
    public function findAll() : array
    {
        $articles = [];
        $request = $this->pdo->query("SELECT * FROM Article WHERE posted='1' ORDER BY date DESC");
        while ($datas = $request->fetch(PDO::FETCH_ASSOC))
        {
            $articles[] = new Article($datas);
        }
        $request->closeCursor();
        return $articles;
    }

    public function getAll() : array
    {
        $articles = [];
        $request = $this->pdo->query("SELECT * FROM Article ORDER BY date DESC");
        while ($datas = $request->fetch(PDO::FETCH_ASSOC))
        {
            $articles[] = new Article($datas);
        }
        $request->closeCursor();
        return $articles;
    }

    /**
     * find 2 last articles order by date desc
     */
    public function findLast(): array
    {

        $articles = [];
        $request = $this->pdo->query("SELECT * FROM Article WHERE posted='1' ORDER BY date DESC LIMIT 0,2");
        while ($datas = $request->fetch(PDO::FETCH_ASSOC))
        {
            $articles[] = new Article($datas);
        }
        $request->closeCursor();
        return $articles;
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