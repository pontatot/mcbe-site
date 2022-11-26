<?php
namespace App\Site\HTTP;

use Exception;

class Session
{
    private static ?Session $instance = null;

    /**
     * @throws Exception
     */
    private function __construct()
    {
        if (session_start() === false) {
            throw new Exception("Session error");
        }
    }

    public static function getInstance(): Session
    {
        if (is_null(static::$instance))
            static::$instance = new Session();
        return static::$instance;
    }

    public function exists($name): bool
    {
        return isset($_SESSION[$name]) and $_SESSION[$name];
    }

    public function save(string $name, mixed $value): void
    {
        $_SESSION[$name] = $value;
    }

    public function read(string $name): mixed
    {
        return static::getInstance()->exists($name) ? $_SESSION[$name] : null;
    }

    public function delete($name): bool
    {
        if (static::getInstance()->exists($name)) {
            unset($_SESSION[$name]);
            return true;
        }
        return false;
    }

    public function destroy() : void
    {
        session_unset();
        session_destroy();
        Cookie::delete(session_name());
        static::$instance = null;
    }
}