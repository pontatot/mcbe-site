<?php

namespace App\Site\Model;

class VideoView implements IInsertable
{
    private int $videoId;
    private int $channelId;
    private ?bool $thumbs;
    private ?string $watchTime;

    /**
     * @param int $videoId
     * @param int $channelId
     * @param bool|null $thumbs
     * @param string|null $watchTime
     */
    public function __construct(int $videoId, int $channelId, ?bool $thumbs = null, ?string $watchTime = null)
    {
        $this->videoId = $videoId;
        $this->channelId = $channelId;
        $this->thumbs = $thumbs;
        $this->watchTime = $watchTime;
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
     * @return VideoView
     */
    public function setVideoId(int $videoId): VideoView
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
     * @return VideoView
     */
    public function setChannelId(int $channelId): VideoView
    {
        $this->channelId = $channelId;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getThumbs(): ?bool
    {
        return $this->thumbs;
    }

    /**
     * @param bool|null $thumbs
     * @return VideoView
     */
    public function setThumbs(?bool $thumbs): VideoView
    {
        $this->thumbs = $thumbs;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWatchTime(): ?string
    {
        return $this->watchTime;
    }

    /**
     * @param string|null $watchTime
     * @return VideoView
     */
    public function setWatchTime(?string $watchTime): VideoView
    {
        $this->watchTime = $watchTime;
        return $this;
    }


    public function formatTableau(): array
    {
        return ["videoId"=>$this->videoId, "channelId"=>$this->channelId, "thumbs"=>(($this->thumbs) ? 1 : (is_null($this->thumbs) ? null : 0))];
    }
}