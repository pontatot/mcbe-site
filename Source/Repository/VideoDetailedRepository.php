<?php

namespace App\Site\Repository;

use App\Site\Model\IInsertable;
use App\Site\Model\Video;

/**
 * @template-implements AbstractGetableRepository<Video>
 */
class VideoDetailedRepository extends AbstractGetableRepository
{

    /**
     * @inheritDoc
     */
    protected static function getNomTable(): string
    {
        return 'V_VIDEO';
    }
    /**
     * @inheritDoc
     */
    protected static function construire(array $objetFormatTableau): IInsertable
    {
        return new Video(
            $objetFormatTableau['videoId'],
            $objetFormatTableau['title'],
            $objetFormatTableau['description'],
            $objetFormatTableau['channelId'],
            $objetFormatTableau['upload'],
            $objetFormatTableau['extension'],
            $objetFormatTableau['name'],
            $objetFormatTableau['viewCount'],
            $objetFormatTableau['thumbsUpCount'],
            $objetFormatTableau['thumbsDownCount']
        );
    }

    /**
     * @inheritDoc
     */
    protected static function getNomClePrimaire(): string
    {
        return 'videoId';
    }
}