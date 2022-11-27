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
            null,
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

    /**
     * @param array<string, string> $filter
     * @return array<int, Channel>
     */
    public static function selectAll(?array $filter = []): array
    {
        $sql = "SELECT id, name, description, email, (SELECT COUNT(*) FROM SUBSCRIBE S WHERE S.subscribeId = C.id) AS subCount FROM CHANNELS C WHERE ";
        $values = [];
        foreach ($filter as $col=>$val) {
            $sql .= "$col = :{$col}Tag  AND ";
            $values[$col . 'Tag'] = $val;
        }
        $sql = substr($sql, 0, -6);
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        $pdoStatement->execute($values);
        $elements = [];
        foreach ($pdoStatement as $elementFormatTableau) {
            $elements[] = static::construire($elementFormatTableau);
        }
        return $elements;
    }

    /**
     * @param string $valeurClePrimaire
     * @return ?Channel
     */
    public static function select(string $valeurClePrimaire): ?IInsertable
    {
        $sql = "SELECT id, name, description, email, (SELECT COUNT(*) FROM SUBSCRIBE S WHERE S.subscribeId = C.id) AS subCount FROM CHANNELS C WHERE " . static::getNomClePrimaire() . "=:Tag";
        // Préparation de la requête
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);

        $values = array(
            "Tag" => $valeurClePrimaire
        );
        $pdoStatement->execute($values);
        $voiture = $pdoStatement->fetch();
        if ($voiture) {
            return static::construire($voiture);
        }
        return null;
    }

    /**
     * @param array<string, string> $filter
     * @return array<int, Channel>
     */
    public static function search(?array $filter = [], ?bool $and = true): array
    {
        $sql = "SELECT id, name, description, email, (SELECT COUNT(*) FROM SUBSCRIBE S WHERE S.subscribeId = C.id) AS subCount FROM CHANNELS C WHERE ";
        $values = [];
        foreach ($filter as $col=>$val) {
            $sql .= "$col LIKE '%{$val}%'  " . ($and ? 'AND ' : ' OR ');
//            $values[$col . 'Tag'] = $val;
        }
        $sql = substr($sql, 0, -6);
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
//        var_dump($sql);
//        var_dump($values);
//        var_dump($pdoStatement);
        $pdoStatement->execute($values);
        $elements = [];
        foreach ($pdoStatement as $elementFormatTableau) {
            $elements[] = static::construire($elementFormatTableau);
        }
        return $elements;
    }
}