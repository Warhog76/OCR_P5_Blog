<?php

namespace App\Models;

Class Account
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
    protected string $surname;

    /**
     * @var string
     */
    protected string $password;

    /**
     * @var string
     */
    protected string $email;

    /**
     * @var string
     */
    protected string $typeAccount;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Account
     */
    public function setId(int $id): Account
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
     * @return Account
     */
    public function setName(string $name): Account
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     * @return Account
     */
    public function setSurname(string $surname): Account
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Account
     */
    public function setPassword(string $password): Account
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Account
     */
    public function setEmail(string $email): Account
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getTypeAccount(): string
    {
        return $this->typeAccount;
    }

    /**
     * @param string $typeAccount
     * @return Account
     */
    public function setTypeAccount(string $typeAccount): Account
    {
        $this->typeAccount = $typeAccount;
        return $this;
    }





}