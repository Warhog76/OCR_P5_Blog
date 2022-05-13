<?php

namespace App\Models;

Class Comment
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string
     */
    protected string $comment;

    /**
     * @var string
     */
    protected string $date;

    /**
     * @var int
     */
    protected int $article_id;

    /**
     * @var int
     */
    protected int $seen;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Comment
     */
    public function setId(int $id): Comment
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Comment
     */
    public function setName(string $name): Comment
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return Comment
     */
    public function setComment(string $comment): Comment
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return Comment
     */
    public function setDate(string $date): Comment
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return int
     */
    public function getArticleId(): int
    {
        return $this->article_id;
    }

    /**
     * @param int $article_id
     * @return Comment
     */
    public function setArticleId(int $article_id): Comment
    {
        $this->article_id = $article_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getSeen(): int
    {
        return $this->seen;
    }

    /**
     * @param int $seen
     * @return Comment
     */
    public function setSeen(int $seen): Comment
    {
        $this->seen = $seen;
        return $this;
    }





}