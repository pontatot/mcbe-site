<?php

namespace App\Site\Repository;

use App\Site\Model\Comment;
use App\Site\Model\IInsertable;

/**
 * @template-implements AbstractEditableRepository<Comment>
 */
class CommentRepository extends AbstractEditableRepository
{

    /**
     * @inheritDoc
     */
    protected static function getNomsColonnes(): array
    {
        return ['content', 'videoId', 'channelId'];
    }

    /**
     * @inheritDoc
     */
    protected static function getNomTable(): string
    {
        return 'COMMENTS';
    }

    /**
     * @inheritDoc
     */
    protected static function construire(array $objetFormatTableau): IInsertable
    {
        return new Comment(
            $objetFormatTableau['id'],
            $objetFormatTableau['content'],
            $objetFormatTableau['videoId'],
            $objetFormatTableau['channelId'],
            $objetFormatTableau['postDate']
        );
    }

    /**
     * @inheritDoc
     */
    protected static function getNomClePrimaire(): string
    {
        return 'id';
    }
}