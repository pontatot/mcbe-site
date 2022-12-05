<?php

namespace App\Site\Repository;

use App\Site\Model\IInsertable;
use App\Site\Model\Video;

/**
 * @template-implements AbstractEditableRepository<Video>
 */
class VideoRepository extends AbstractEditableRepository
{
    /**
     * @return string
     */
    protected static function getNomTable(): string
    {
        return "VIDEOS";
    }

    /**
     * @param array<string, mixed> $objetFormatTableau
     * @return Video
     */
    protected static function construire(array $objetFormatTableau): IInsertable
    {
        return new Video(
            $objetFormatTableau['id'],
            $objetFormatTableau['title'],
            $objetFormatTableau['description'],
            $objetFormatTableau['channel'],
            $objetFormatTableau['upload'],
            $objetFormatTableau['extension']
        );
    }

    /**
     * @return string
     */
    protected static function getNomClePrimaire(): string
    {
        return 'id';
    }

    /**
     * @return array<int, string>
     */
    protected static function getNomsColonnes(): array
    {
        return ['id', 'title', 'description', 'channel', 'extension'];
    }
}