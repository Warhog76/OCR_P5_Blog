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

   /* public function post($title, $content, $posted)
    {

        // variable declaration
        $p = [
            'title' => $title,
            'content' => $content,
            'writer' => $_SESSION['admin'],
            'posted' => $posted
        ];

        $sql = "INSERT INTO Article (title, content, writer, date, posted)
            VALUES (:title,:content,:writer,NOW(),:posted)";

        $addArticle = $this->pdo->prepare($sql);
        $addArticle->execute($p);
        $id = $this->pdo->lastInsertId();
        header("Location:index.php?page=post&id=" . $id);
    }

    public function post_img($tmp_name, $extension)
    {

        $id = $this->pdo->lastInsertId();
        $i = [
            'id' => $id,
            'image' => $id . $extension      //$id = 25 , $extension = .jpg      $id.$extension = "25".".jpg" = 25.jpg
        ];

        $sql = "UPDATE Article SET image = :image WHERE id = :id";
        $req = $this->pdo->prepare($sql);
        $req->execute($i);
        move_uploaded_file($tmp_name, "../images/posts/" . $id . $extension);
        header("Location:index.php?page=post&id=" . $id);
    } */

    public function editArticle($article): bool|\PDOStatement
    {

        $query = $this->pdo->prepare('UPDATE Article SET title= :title, chapo= :chapo, content= :content, date= NOW(), posted= :posted WHERE id = :id');
        $query->bindValue(':title', $article->getTitle());
        $query->bindValue(':chapo', $article->getChapo());
        $query->bindValue(':content', $article->getContent());
        $query->bindValue(':posted', $article->getPosted());
        $query->execute();
        $query->closeCursor();
        return $query;
    }
}