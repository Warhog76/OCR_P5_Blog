<?php

namespace App\Repositories;

use PDO;
use App\Models\Article;

class ArticleRepo extends Repository
{

    protected $table = "Article";


    public function findAll(): array
    {
        $articles = [];
        $request = $this->pdo->query("SELECT * FROM Article WHERE posted='1' ORDER BY date DESC");
        while ($datas = $request->fetch(PDO::FETCH_ASSOC)) {
            $articles[] = new Article($datas);
        }
        $request->closeCursor();
        return $articles;
    }

    public function getAll(): array
    {
        $articles = [];
        $request = $this->pdo->query("SELECT * FROM Article ORDER BY date DESC");
        while ($datas = $request->fetch(PDO::FETCH_ASSOC)) {
            $articles[] = new Article($datas);
        }
        $request->closeCursor();
        return $articles;
    }

    public function findLast(): array
    {

        $articles = [];
        $request = $this->pdo->query("SELECT * FROM Article WHERE posted='1' ORDER BY date DESC LIMIT 0,2");
        while ($datas = $request->fetch(PDO::FETCH_ASSOC)) {
            $articles[] = new Article($datas);
        }
        $request->closeCursor();
        return $articles;
    }

    public function findOne(int $id): Article
    {

        $query = $this->pdo->prepare("SELECT   *
                        FROM Article
                        WHERE article.id = :article_id");
        $query->execute(['article_id' => $id]);
        $results = $query->fetch(PDO::FETCH_ASSOC);
        return new Article($results);
    }

    public function postArticle($article): bool|\PDOStatement
    {

        $query = $this->pdo->prepare('INSERT INTO Article (title, chapo, content, date, posted)
            VALUES (:title,:chapo, :content,NOW(),:posted)');
        $query->execute($article);
        $query->closeCursor();
        return $query;
    }

    public function editArticle($article): bool|\PDOStatement
    {

        $query = $this->pdo->prepare('UPDATE Article SET title= :title, chapo= :chapo, content= :content, date= NOW(), posted= :posted WHERE id = :id');
        $query->execute($article);
        $query->closeCursor();
        return $query;
    }
}