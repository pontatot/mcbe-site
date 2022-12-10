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
        return 'C.id';
    }

    private static string $sqlRequest = 'SELECT C.id AS commentId, videoId, content, postDate, channelId, name FROM COMMENTS C JOIN VIDEOS V ON V.id = C.videoId JOIN CHANNELS CH ON CH.id = C.channelId ';

    /**
     * @param array<string, string> $filter
     * @return array<int, Comment>
     */
    public static function selectAll(?array $filter = []): array
    {
        $sql = static::$sqlRequest . "WHERE ";
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
     * @return ?Comment
     */
    public static function select(string $valeurClePrimaire): ?IInsertable
    {
        $sql = static::$sqlRequest . "WHERE " . static::getNomClePrimaire() . "=:Tag";
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
     * @return array<int, Comment>
     */
    public static function search(?array $filter = [], ?bool $and = true): array
    {
        $sql = static::$sqlRequest . "WHERE ";
        foreach ($filter as $col=>$val) {
            $sql .= "$col LIKE '%$val%'  " . ($and ? 'AND ' : ' OR ');
        }
        $sql = substr($sql, 0, -6);
        $pdoStatement = DatabaseConnection::getPdo()->query($sql);
        $elements = [];
        foreach ($pdoStatement as $elementFormatTableau) {
            $elements[] = static::construire($elementFormatTableau);
        }
        return $elements;
    }
}