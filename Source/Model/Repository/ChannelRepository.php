<?php


class ChannelRepository extends AbstractRepository
{
    public static function construire(array $objetFormatTableau) : Channel {
        return new Channel(
            $objetFormatTableau["id"],
            $objetFormatTableau["name"],
            $objetFormatTableau["description"],
            $objetFormatTableau["email"],
            $objetFormatTableau["password"]
        );
    }

    protected static function getNomTable(): string
    {
        return "CHANNELS";
    }

    protected static function getNomClePrimaire(): string
    {
        return "id";
    }

    protected static function getNomsColonnes(): array
    {
        return ["id", "name", "description", "email", "password"];
    }
}