<?php

namespace App\Site\Model;

class Comment implements IInsertable
{
    private ?int $id;
    private string $content;
    private ?string $postDate;
    private int $videoId;
    private int $channelId;
    private ?string $name;

    /**
     * @param int|null $id
     * @param string $content
     * @param string|null $postDate
     * @param int $videoId
     * @param int $channelId
     * @param ?string $name
     */
    public function __construct(?int $id, string $content, int $videoId, int $channelId, ?string $postDate = null, ?string $name = null)
    {
        $this->id = $id;
        $this->content = $content;
        $this->postDate = $postDate;
        $this->videoId = $videoId;
        $this->channelId = $channelId;
        $this->name = $name;
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
     * @return Comment
     */
    public function setId(?int $id): Comment
    {
        $this->id = $id;
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
     * @return Comment
     */
    public function setContent(string $content): Comment
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPostDate(): ?string
    {
        return $this->postDate;
    }

    /**
     * @param string|null $postDate
     * @return Comment
     */
    public function setPostDate(?string $postDate): Comment
    {
        $this->postDate = $postDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getVideoId(): int
    {
        return $this->videoId;
    }

    /**
     * @param int $videoId
     * @return Comment
     */
    public function setVideoId(int $videoId): Comment
    {
        $this->videoId = $videoId;
        return $this;
    }

    /**
     * @return int
     */
    public function getChannelId(): int
    {
        return $this->channelId;
    }

    /**
     * @param int $channelId
     * @return Comment
     */
    public function setChannelId(int $channelId): Comment
    {
        $this->channelId = $channelId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Comment
     */
    public function setName(?string $name): Comment
    {
        $this->name = $name;
        return $this;
    }


    public function formatTableau(): array
    {
        return ["id"=>$this->id, "content"=>$this->content, "upload"=>$this->postDate, "channelId"=>$this->channelId, "videoId"=>$this->videoId];
    }
}