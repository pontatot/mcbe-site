<?php

class Channel extends AbstractDataObject
{
    private int $id;
    private string $name;
    private ?string $description;
    private string $email;
    private string $password;

    /**
     * @param int $id
     * @param string $name
     * @param ?string $description
     * @param string $email
     * @param string $password
     */
    public function __construct(int $id, string $name, ?string $description, string $email, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
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
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
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
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }


    public function formatTableau(): array
    {
        return ["id"=>$this->id, "name"=>$this->name, "description"=>$this->description, "email"=>$this->email, "password"=>$this->password];
    }
}