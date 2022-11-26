<?php

namespace App\Site\Model;

/**
 *
 */
class Video implements IInsertable
{
    protected ?int $id;
    protected string $title;
    protected ?string $description;
    protected int $channel;
    protected ?string $upload;
    private ?string $extension;
    private ?string $name;
    private ?int $viewCount;
    private ?int $thumbsUpCount;
    private ?int $thumbsDownCount;

    /**
     * @param int|null $id
     * @param string $title
     * @param string|null $description
     * @param int $channel
     * @param string|null $upload
     * @param ?string $extension
     * @param ?string $name
     * @param int|null $viewCount
     * @param int|null $thumbsUpCount
     * @param int|null $thumbsDownCount
     */
    public function __construct(?int $id, string $title, ?string $description, int $channel, ?string $upload, ?string $extension = null, ?string $name = null, ?int $viewCount = null, ?int $thumbsUpCount = null, ?int $thumbsDownCount = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->channel = $channel;
        $this->upload = $upload;
        $this->extension = $extension;
        $this->name = $name;
        $this->viewCount = $viewCount;
        $this->thumbsUpCount = $thumbsUpCount;
        $this->thumbsDownCount = $thumbsDownCount;
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
     * @return Video
     */
    public function setId(?int $id): Video
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
     * @return Video
     */
    public function setTitle(string $title): Video
    {
        $this->title = $title;
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
     * @return Video
     */
    public function setDescription(?string $description): Video
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getChannel(): int
    {
        return $this->channel;
    }

    /**
     * @param int $channel
     * @return Video
     */
    public function setChannel(int $channel): Video
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUpload(): ?string
    {
        return $this->upload;
    }

    /**
     * @param string|null $upload
     * @return Video
     */
    public function setUpload(?string $upload): Video
    {
        $this->upload = $upload;
        return $this;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @param string $extension
     * @return Video
     */
    public function setExtension(string $extension): Video
    {
        $this->extension = $extension;
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
     * @return Video
     */
    public function setName(?string $name): Video
    {
        $this->name = $name;
        return $this;
    }



    /**
     * @return int|null
     */
    public function getViewCount(): ?int
    {
        return $this->viewCount;
    }

    /**
     * @param int|null $viewCount
     * @return Video
     */
    public function setViewCount(?int $viewCount): Video
    {
        $this->viewCount = $viewCount;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getThumbsUpCount(): ?int
    {
        return $this->thumbsUpCount;
    }

    /**
     * @param int|null $thumbsUpCount
     * @return Video
     */
    public function setThumbsUpCount(?int $thumbsUpCount): Video
    {
        $this->thumbsUpCount = $thumbsUpCount;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getThumbsDownCount(): ?int
    {
        return $this->thumbsDownCount;
    }

    /**
     * @param int|null $thumbsDownCount
     * @return Video
     */
    public function setThumbsDownCount(?int $thumbsDownCount): Video
    {
        $this->thumbsDownCount = $thumbsDownCount;
        return $this;
    }


    public function formatTableau(): array
    {
        return ["id"=>$this->id, "title"=>$this->title, "description"=>$this->description, "channel"=>$this->channel, "upload"=>$this->upload, "extension"=>$this->extension];
    }
}