<?php

class Video extends AbstractDataObject
{
    private ?int $id;
    private string $title;
    private ?string $description;
    private ?Channel $channel;
    private ?string $upload;
    private string $extension;

    /**
     * @param ?int $id
     * @param string $title
     * @param ?string $description
     * @param int $channel
     * @param ?string $upload
     */
    public function __construct(?int $id, string $title, ?string $description, int $channel, ?string $upload, string $extension)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->channel = ChannelRepository::select($channel);
        $this->upload = $upload;
        $this->extension = $extension;
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
     */
    public function setExtension(string $extension): void
    {
        $this->extension = $extension;
    }

    /**
     * @return Channel
     */
    public function getChannel(): Channel
    {
        return $this->channel;
    }

    /**
     * @param Channel $channel
     */
    public function setChannel(Channel $channel): void
    {
        $this->channel = $channel;
    }

    /**
     * @return ?int
     */
    public function getId(): ?int
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description ?? '';
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
    public function getUpload(): string
    {
        return $this->upload;
    }

    /**
     * @param string $upload
     */
    public function setUpload(string $upload): void
    {
        $this->upload = $upload;
    }




    public function formatTableau(): array
    {
        return ["id"=>$this->id, "title"=>$this->title, "description"=>$this->description, "channel"=>$this->channel->getId(), "upload"=>$this->upload, "extension"=>$this->extension];
    }
}