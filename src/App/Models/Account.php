<?php

namespace App\Models;

Class Account
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $surname;

    /**
     * @var string
     */
    private string $username;

    /**
     * @var string
     */
    private string $password;

    /**
     * @var string
     */
    private string $email;

    /**
     * @var string
     */
    private string $typeAccount;

    /**
     * @var string
     */
    private string $token;

    /**
     * @var string
     */
    private string $confirmed_at;

    /**
     * @var string
     */
    private string $reset_token;

    /**
     * @var string
     */
    private string $reset_at;

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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return Account
     */
    public function setUsername(string $username): Account
    {
        $this->username = $username;
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

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Account
     */
    public function setToken(string $token): Account
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getConfirmedAt(): string
    {
        return $this->confirmed_at;
    }

    /**
     * @param string $confirmed_at
     * @return Account
     */
    public function setConfirmedAt(string $confirmed_at): Account
    {
        $this->confirmed_at = $confirmed_at;
        return $this;
    }

    /**
     * @return string
     */
    public function getResetToken(): string
    {
        return $this->reset_token;
    }

    /**
     * @param string $reset_token
     * @return Account
     */
    public function setResetToken(string $reset_token): Account
    {
        $this->reset_token = $reset_token;
        return $this;
    }

    /**
     * @return string
     */
    public function getResetAt(): string
    {
        return $this->reset_at;
    }

    /**
     * @param string $reset_at
     * @return Account
     */
    public function setResetAt(string $reset_at): Account
    {
        $this->reset_at = $reset_at;
        return $this;
    }
}