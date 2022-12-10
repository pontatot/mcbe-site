<?php

namespace App\Site\Repository;

use App\Site\Model\IInsertable;
use App\Site\Model\Video;

/**
 * @template-implements AbstractGetableRepository<Video>
 */
class VideoDetailedRepository extends AbstractGetableRepository
{

    /**
     * @inheritDoc
     */
    protected static function getNomTable(): string
    {
        return 'V_VIDEO';
    }

    private static string $sqlString = 'SELECT V.id AS videoId, title, upload, V.description, extension, C.id AS channelId, name, (SELECT COUNT(*) FROM WATCH W WHERE W.videoId = V.id) AS viewCount, (SELECT COUNT(*) FROM WATCH W WHERE W.thumbs = 1 AND W.videoId = V.id) AS thumbsUpCount, (SELECT COUNT(*) FROM WATCH W WHERE W.thumbs = 0 AND W.videoId = V.id) AS thumbsDownCount FROM VIDEOS V JOIN CHANNELS C ON C.id = V.channel ';

    /**
     * @inheritDoc
     */
    protected static function construire(array $objetFormatTableau): IInsertable
    {
        return new Video(
            $objetFormatTableau['videoId'],
            $objetFormatTableau['title'],
            $objetFormatTableau['description'],
            $objetFormatTableau['channelId'],
            $objetFormatTableau['upload'],
            $objetFormatTableau['extension'],
            $objetFormatTableau['name'],
            $objetFormatTableau['viewCount'],
            $objetFormatTableau['thumbsUpCount'],
            $objetFormatTableau['thumbsDownCount']
        );
    }

    /**
     * @inheritDoc
     */
    protected static function getNomClePrimaire(): string
    {
        return 'videoId';
    }

    /**
     * @param array<string, string> $filter
     * @return array<int, Video>
     */
    public static function selectAll(?array $filter = []): array
    {
        $sql = static::$sqlString . ' WHERE ';
        $values = [];
        $i = 0;
        foreach ($filter as $col=>$val) {
            $sql .= "$col = :{$i}Tag  AND ";
            $values[$i . 'Tag'] = $val;
            $i++;
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
     * @return ?Video
     */
    public static function select(string $valeurClePrimaire): ?IInsertable
    {
        $sql = static::$sqlString . " WHERE V.id=:Tag";
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
     * @return array<int, Video>
     */
    public static function search(?array $filter = [], ?bool $and = true): array
    {
        $sql = static::$sqlString . ' WHERE ';
        $values = [];
        foreach ($filter as $col=>$val) {
            $sql .= "$col LIKE '%$val%'  " . ($and ? 'AND ' : ' OR ');
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