<?php

namespace App\Site\HTTP;

class Cookie
{
    public static function save(string $cle, mixed $valeur, ?int $dureeExpiration = null): bool {
        return setcookie($cle, serialize($valeur), $dureeExpiration ? time()+$dureeExpiration : 0);
    }

    public static function read(string $cle): mixed {
        return static::exists($cle) ? unserialize($_COOKIE[$cle]) : null;
    }

    public static function exists($cle) : bool {
        return isset($_COOKIE[$cle]) and $_COOKIE[$cle];
    }

    public static function delete($cle) : void {
        if (static::exists($cle)) {
            unset($_COOKIE[$cle]);
            setcookie($cle, "", 1);
        }
    }
}