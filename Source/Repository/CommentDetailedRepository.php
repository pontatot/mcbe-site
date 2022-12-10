<?php

namespace App\Site\Repository;

use App\Site\Model\Comment;
use App\Site\Model\IInsertable;

/**
 * @template-implements AbstractGetableRepository<Comment>
 */
class CommentDetailedRepository extends AbstractGetableRepository
{

    /**
     * @inheritDoc
     */
    protected static function getNomTable(): string
    {
        return 'V_COMMENT';
    }

    /**
     * @inheritDoc
     */
    protected static function construire(array $objetFormatTableau): IInsertable
    {
        return new Comment(
            $objetFormatTableau['commentId'],
            $objetFormatTableau['content'],
            $objetFormatTableau['videoId'],
            $objetFormatTableau['channelId'],
            $objetFormatTableau['postDate'],
            $objetFormatTableau['name']
        );
    }

    /**
     * @inheritDoc
     */
    protected static function getNomClePrimaire(): string
    {
        return 'commentId';
    }
}