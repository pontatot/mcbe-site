<?php


class VideoRepository extends AbstractRepository
{

    public static function construire(array $objetFormatTableau) : Video {
        return new Video(
            $objetFormatTableau["id"],
            $objetFormatTableau["title"],
            $objetFormatTableau["description"],
            $objetFormatTableau["channel"],
            $objetFormatTableau["upload"],
            $objetFormatTableau["extension"]
        );
    }

    protected static function getNomTable(): string
    {
        return "VIDEOS";
    }

    protected static function getNomClePrimaire(): string
    {
        return "id";
    }

    protected static function getNomsColonnes(): array
    {
        return ["id", "title", "description", "channel", "upload", "extension"];
    }
}