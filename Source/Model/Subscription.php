<?php

namespace App\Site\Model;

class Subscription implements IInsertable
{
    private int $channelId;
    private int $subscribeId;

    /**
     * @param int $channelId
     * @param int $subscribeId
     */
    public function __construct(int $channelId, int $subscribeId)
    {
        $this->channelId = $channelId;
        $this->subscribeId = $subscribeId;
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
     * @return Subscription
     */
    public function setChannelId(int $channelId): Subscription
    {
        $this->channelId = $channelId;
        return $this;
    }

    /**
     * @return int
     */
    public function getSubscribeId(): int
    {
        return $this->subscribeId;
    }

    /**
     * @param int $subscribeId
     * @return Subscription
     */
    public function setSubscribeId(int $subscribeId): Subscription
    {
        $this->subscribeId = $subscribeId;
        return $this;
    }


    public function formatTableau(): array
    {
        return ["channelId"=>$this->channelId, "subscribeId"=>$this->subscribeId];
    }
}