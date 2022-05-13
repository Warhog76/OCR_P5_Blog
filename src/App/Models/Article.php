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

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getWriter(): string
    {
        return $this->writer;
    }

    public function getCreated()
    {
        return $this->date;
    }

    public function getPosted(): int
    {
        return $this->posted;
    }




}