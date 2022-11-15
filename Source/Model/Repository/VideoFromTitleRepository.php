<?php

class VideoFromTitleRepository extends VideoRepository
{
    protected static function getNomClePrimaire(): string
    {
        return "title";
    }

    public static function insertGet(Video $object): ?Video
    {
        $result = parent::insert($object) ? static::select($object->getTitle()) : null;
        return ($result and get_class($result) == "Video") ? $result : null;
    }

}