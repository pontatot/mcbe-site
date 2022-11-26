<?php

namespace App\Site\Repository;

use App\Site\Model\IInsertable;
use App\Site\Model\VideoView;

/**
 * @template-implements AbstractEditableRepository<VideoView>
 */
class VideoViewRepository extends AbstractEditableRepository
{

    /**
     * @inheritDoc
     */
    protected static function getNomsColonnes(): array
    {
        return ['videoId', 'channelId', 'thumbs'];
    }

    /**
     * @inheritDoc
     */
    protected static function getNomTable(): string
    {
        return 'WATCH';
    }

    /**
     * @inheritDoc
     */
    protected static function construire(array $objetFormatTableau): IInsertable
    {
        return new VideoView(
            $objetFormatTableau['videoId'],
            $objetFormatTableau['channelId'],
            $objetFormatTableau['thumbs'],
            $objetFormatTableau['watchTime']
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