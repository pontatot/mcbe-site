<?php

namespace App\Site\Model;

class Channel implements IInsertable
{
    protected ?int $id;
    protected string $name;
    protected ?string $description;
    protected string $email;
    private ?string $password;
    private ?int $subCount;

    /**
     * @param int|null $id
     * @param string $name
     * @param string|null $description
     * @param string $email
     * @param ?string $password
     * @param ?int $subCount
     */
    public function __construct(?int $id, string $name, ?string $description, string $email, ?string $password, ?int $subCount = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->email = $email;
        $this->password = $password;
        $this->subCount = $subCount;
    }



    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Channel
     */
    public function setId(?int $id): Channel
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
     * @return Channel
     */
    public function setName(string $name): Channel
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return Channel
     */
    public function setDescription(?string $description): Channel
    {
        $this->description = $description;
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
     * @return Channel
     */
    public function setEmail(string $email): Channel
    {
        $this->email = $email;
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
     * @return Channel
     */
    public function setPassword(string $password): Channel
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSubCount(): ?int
    {
        return $this->subCount;
    }

    /**
     * @param int|null $subCount
     * @return Channel
     */
    public function setSubCount(?int $subCount): Channel
    {
        $this->subCount = $subCount;
        return $this;
    }


    public function formatTableau(): array
    {
        return ["id"=>$this->id, "name"=>$this->name, "description"=>$this->description, "email"=>$this->email, "password"=>$this->password];
    }
}