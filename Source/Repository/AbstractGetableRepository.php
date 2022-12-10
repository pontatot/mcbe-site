<?php

namespace App\Site\Repository;

use App\Site\Model\IInsertable;

/**
 * @template T of IInsertable
 */
abstract class AbstractGetableRepository
{
    /**
     * @return string
     */
    protected static abstract function getNomTable(): string;

    /**
     * @param array<string, mixed> $objetFormatTableau
     * @return T
     */
    protected static abstract function construire(array $objetFormatTableau): IInsertable;

    /**
     * @return string
     */
    protected static abstract function getNomClePrimaire(): string;


    /**
     * @param array<string, string> $filter
     * @return array<int, T>
     */
    public static function selectAll(?array $filter = []): array
    {
        $sql = "SELECT * FROM " . static::getNomTable() . " WHERE ";
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
     * @return ?T
     */
    public static function select(string $valeurClePrimaire): ?IInsertable
    {
        $sql = "SELECT * from " . static::getNomTable() . " WHERE " . static::getNomClePrimaire() . "=:Tag";
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        $pdoStatement->execute(["Tag" => $valeurClePrimaire]);
        $voiture = $pdoStatement->fetch();
        if ($voiture) {
            return static::construire($voiture);
        }
        return null;
    }

    /**
     * @param array<string, string> $filter
     * @return array<int, T>
     */
    public static function search(?array $filter = [], ?bool $and = true): array
    {
        $sql = "SELECT * FROM " . static::getNomTable() . "  WHERE";
        $values = [];
        foreach ($filter as $col=>$val) {
            $sql .= " $col LIKE '%$val%'  " . ($and ? 'AND ' : ' OR ');
//            $values[$col . 'Tag'] = $val;
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

}