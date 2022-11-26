<?php

namespace App\Site\Repository;

use App\Site\Model\IInsertable;
use App\Site\Model\Subscription;

/**
 * @template-implements AbstractEditableRepository<Subscription>
 */
class SubscriptionRepository extends AbstractEditableRepository
{

    /**
     * @inheritDoc
     */
    protected static function getNomsColonnes(): array
    {
        return ['channelId', 'subscribeId'];
    }

    /**
     * @inheritDoc
     */
    protected static function getNomTable(): string
    {
        return 'SUBSCRIBE';
    }

    /**
     * @inheritDoc
     */
    protected static function construire(array $objetFormatTableau): IInsertable
    {
        return new Subscription(
            $objetFormatTableau['channelId'],
            $objetFormatTableau['subscribeId']
        );
    }

    /**
     * @inheritDoc
     */
    protected static function getNomClePrimaire(): string
    {
        return 'channelId';
    }
}