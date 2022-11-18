<?php
spl_autoload_register(function ($className) {
    $path = __DIR__ . "/../DataObject/$className.php";
    if (is_file($path)) include_once $path;
});
abstract class AbstractRepository
{
    protected static abstract function getNomTable(): string;
    protected static abstract function construire(array $objetFormatTableau): AbstractDataObject;
    protected static abstract function getNomClePrimaire(): string;
    protected static abstract function getNomsColonnes(): array;

    public static function selectAll(): array
    {
        $sql = "SELECT * FROM " . static::getNomTable();
        $pdoStatement = DatabaseConnection::getPdo()->query($sql);

        $elements = [];
        foreach ($pdoStatement as $elementFormatTableau) {
            $elements[] = static::construire($elementFormatTableau);
        }
        return $elements;
    }

    public static function select(string $valeurClePrimaire): ?AbstractDataObject
    {
        $sql = "SELECT * from " . static::getNomTable() . " WHERE " . static::getNomClePrimaire() . "=:Tag";
        // Préparation de la requête
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);

        $values = array(
            "Tag" => $valeurClePrimaire,
            //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de voiture correspondante
        $object = $pdoStatement->fetch();
        if ($object) {
            return static::construire($object);
        }
        return null;
    }

    public static function selectWhere(string $colonne, string $valeur): ?AbstractDataObject
    {
        $sql = "SELECT * from " . static::getNomTable() . " WHERE " . $colonne . "=:Tag";
        // Préparation de la requête
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        $values = array(
            "Tag" => $valeur,
            //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de voiture correspondante
        $object = $pdoStatement->fetch();
        if ($object) {
            return static::construire($object);
        }
        return null;
    }

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

    public static function update(AbstractDataObject $object) : bool {
        $sql = "UPDATE " . static::getNomTable() . " SET ";
        $values = array();
        foreach (static::getNomsColonnes() as $col) {
            if (static::getNomClePrimaire() != $col) $sql .= $col . "=:" . $col . "Tag, ";
            $values[$col . "Tag"] = $object->formatTableau()[$col];
        }
        $sql = substr($sql, 0, -2);
        $sql .= " WHERE " . static::getNomClePrimaire() . "=:" . static::getNomClePrimaire() . "Tag";
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        try {
            $pdoStatement->execute($values);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    public static function insert(AbstractDataObject $object) : bool {
        $sql = "INSERT INTO " . static::getNomTable() . " (";
        foreach (static::getNomsColonnes() as $col) {
            if ($object->formatTableau()[$col]) $sql .= $col . ", ";
        }
        $sql = substr($sql, 0, -2) .  ") VALUES (";
        $values = array();
        foreach (static::getNomsColonnes() as $col) {
            if ($object->formatTableau()[$col]) {
                $sql .= ":" . $col . "Tag, ";
                $values[$col . "Tag"] = $object->formatTableau()[$col];
            }
        }
        $sql = substr($sql, 0, -2) . ")";
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        try {
            $pdoStatement->execute($values);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

}