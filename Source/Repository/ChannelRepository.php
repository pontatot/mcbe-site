<?php

namespace App\Site\Repository;

use App\Site\Model\Channel;
use App\Site\Model\IInsertable;

/**
 * @template-implements AbstractEditableRepository<Channel>
 */
class ChannelRepository extends AbstractEditableRepository
{

    /**
     * @inheritDoc
     */
    protected static function getNomsColonnes(): array
    {
        return ['id', 'name', 'description', 'email', 'password'];
    }

    /**
     * @inheritDoc
     */
    protected static function getNomTable(): string
    {
        return 'CHANNELS';
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
            $objetFormatTableau['password']
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