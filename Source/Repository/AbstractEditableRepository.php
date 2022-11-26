<?php

namespace App\Site\Repository;

use App\Site\Model\IInsertable;
use PDOException;

/**
 * @template T of IInsertable
 * @template-implements AbstractGetableRepository<T>
 */
abstract class AbstractEditableRepository extends AbstractGetableRepository
{
    /**
     * @return array<int, string>
     */
    protected static abstract function getNomsColonnes(): array;

    /**
     * @param string $valeurClePrimaire
     * @return bool
     */
    public static function delete(string $valeurClePrimaire): bool
    {
        $sql = "DELETE FROM " . static::getNomTable() . " WHERE " . static::getNomClePrimaire() . "=:Tag";
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        $values = array(
            "Tag" => $valeurClePrimaire
        );
        $pdoStatement->execute($values);
        return $pdoStatement->rowCount() > 0;
    }

    /**
     * @param T $object
     * @return bool
     */
    public static function deleteElement(IInsertable $object): bool
    {
        $sql = "DELETE FROM " . static::getNomTable() . " WHERE ";
        $values = [];
        $elementTable = $object->formatTableau();
        foreach (static::getNomsColonnes() as $col) {
            $values[$col . 'Tag'] = $elementTable[$col];
            $sql .= $col . ' = :' . $col . 'Tag AND ';
        }
        $sql = substr($sql, 0, -5);
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        $pdoStatement->execute($values);
        return $pdoStatement->rowCount() > 0;
    }

    /**
     * @param T $object
     * @return bool
     */
    public static function update(IInsertable $object) : bool {
        $sql = "UPDATE " . static::getNomTable() . " SET ";
        $values = array();
        $elementTable = $object->formatTableau();
        foreach (static::getNomsColonnes() as $col) {
            if (static::getNomClePrimaire() != $col) $sql .= $col . "=:" . $col . "Tag, ";
            $values[$col . "Tag"] = $elementTable[$col];
        }
        $sql = substr($sql, 0, -2);
        $sql .= " WHERE " . static::getNomClePrimaire() . "=:" . static::getNomClePrimaire() . "Tag";
        try {
            DatabaseConnection::getPdo()->prepare($sql)->execute($values);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    /**
     * @param T $object
     * @return bool
     */
    public static function insert(IInsertable $object) : bool {
        $sql = "INSERT INTO " . static::getNomTable() . " (";
        foreach (static::getNomsColonnes() as $col) {
            $sql .= $col . ", ";
        }
        $sql = substr($sql, 0, -2) .  ") VALUES (";
        $values = array();
        $elementTable = $object->formatTableau();
        foreach (static::getNomsColonnes() as $col) {
            $sql .= ":" . $col . "Tag, ";
            $values[$col . "Tag"] = $elementTable[$col];
        }
        $sql = substr($sql, 0, -2) . ")";
        try {
            DatabaseConnection::getPdo()->prepare($sql)->execute($values);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

}