<?php

namespace App\Site\Repository;

use App\Site\Model\IInsertable;
use App\Site\Model\VideoView;
use PDOException;

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

    public static function updateThumb(VideoView $object) : bool {
        $sql = "UPDATE WATCH SET thumbs = :thumbTag WHERE videoId = :videoTag AND channelId = :channelTag";
        $values = ["thumbTag"=>(($object->getThumbs()) ? 1 : (is_null($object->getThumbs()) ? null : 0)), "videoTag"=>$object->getVideoId(), "channelTag"=>$object->getChannelId()];
        try {
            DatabaseConnection::getPdo()->prepare($sql)->execute($values);
            return true;
        } catch(PDOException $e) {
            var_dump($e);
            return false;
        }
    }
}