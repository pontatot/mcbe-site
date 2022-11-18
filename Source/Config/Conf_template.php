<?php
//rename this file to 'Conf.php' and class to 'Conf'
class Conf_template
{
    static private array $data = [
        "token"=>"any-discord-bot-token",
        "url"=>"https://discord.com/api/v10/users/",
        "userId"=>"your-discord-user-id"
    ];
    static private array $databases = array(
        'hostname' => 'host-name',
        'database' => 'database-name',
        'login' => 'login',
        'password' => 'password'
    );
    private static string $pepper = 'A random string';
    static private array $supportedLanguages;
    public static function getUrl() : string {
        return static::$data['url'] . static::$data['userId'];
    }
    public static function getToken() : string {
        return static::$data['token'];
    }
    static public function getLogin() : string {
        return static::$databases['login'];
    }
    static public function getHostname() : string {
        return static::$databases['hostname'];
    }
    static public function getDatabase() : string {
        return static::$databases['database'];
    }
    static public function getPassword() : string {
        return static::$databases['password'];
    }
    public static function getSupportedLang() : array {
        if (isset(static::$supportedLanguages)) return static::$supportedLanguages;
        static::$supportedLanguages = scandir(__DIR__ . "/Lang");
        if (!static::$supportedLanguages) static::$supportedLanguages = ['', ''];
        unset(static::$supportedLanguages[0], static::$supportedLanguages[1]);
        static::$supportedLanguages=array_values(static::$supportedLanguages);
        array_splice(static::$supportedLanguages, array_search('AbstractLang.php', static::$supportedLanguages), 1);
        return static::$supportedLanguages;
    }
    public static function isSupportedLang(string $lang) : bool {
        return in_array(strtoupper($lang) . '.php', static::getSupportedLang());
    }
    public static function getPepper() : string {
        return static::$pepper;
    }

}
