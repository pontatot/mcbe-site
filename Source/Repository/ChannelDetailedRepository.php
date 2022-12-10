<?php

namespace App\Site\Repository;

use App\Site\Model\Channel;
use App\Site\Model\IInsertable;

/**
 * @template-implements AbstractGetableRepository<Channel>
 */
class ChannelDetailedRepository extends AbstractGetableRepository
{

    /**
     * @inheritDoc
     */
    protected static function getNomTable(): string
    {
        return 'V_CHANNEL';
    }

    /**
     * @inheritDoc
     */
    protected static function construire(array $objetFormatTableau): IInsertable
    {
        return new Channel(
            $objetFormatTableau['id'],
            $objetFormatTableau['name'],
            $objetFormatTableau['description'],
            $objetFormatTableau['email'],
            $objetFormatTableau['password'],
            $objetFormatTableau['subCount']
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