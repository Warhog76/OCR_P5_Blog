<?php

namespace App\Models;

Class Article
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @var string
     */
    protected string $title;

    /**
     * @var string
     */
    protected string $content;

    /**
     * @var string
     */
    protected string $image;

    /**
     * @var string
     */
    protected string $writer;

    /**
     * @var string
     */
    protected string $date;

    /**
     * @var int
     */
    protected int $posted;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Article
     */
    public function setId(int $id): Article
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Article
     */
    public function setTitle(string $title): Article
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Article
     */
    public function setContent(string $content): Article
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return Article
     */
    public function setImage(string $image): Article
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getWriter(): string
    {
        return $this->writer;
    }

    /**
     * @param string $writer
     * @return Article
     */
    public function setWriter(string $writer): Article
    {
        $this->writer = $writer;
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
     * @return Article
     */
    public function setDate(string $date): Article
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return int
     */
    public function getPosted(): int
    {
        return $this->posted;
    }

    /**
     * @param int $posted
     * @return Article
     */
    public function setPosted(int $posted): Article
    {
        $this->posted = $posted;
        return $this;
    }



}