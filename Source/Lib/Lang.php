<?php
namespace App\Site\Config\lang;
use App\Site\HTTP\Session;

class Lang {
    private static ?Lang $instance = null;
    private static string $langKey = '_savedLanguage';
    private string $currentLang;
    private array $items;

    private function __construct()
    {
        $this->currentLang = Session::getInstance()->read(static::$langKey) ?? "EN";
        $this->loadLang($this->currentLang);
    }

    public static function getInstance(): Lang
    {
        if (is_null(static::$instance))
            static::$instance = new Lang();
        return static::$instance;
    }

    private function loadLang(string $lang) : void {
        $myFile = fopen(__DIR__ . "/../Config/Lang.php", 'r');
        $content = fread($myFile, filesize(__DIR__ . "/../Config/Lang.php"));
        fclose($myFile);
        $this->currentLang = $lang;
        foreach (json_decode($content, true) as $key => $value) {
            $this->items[$key] = $value;
        }
    }

    public function getItem(string $item)
    {
        if (!isset($this->items)) {
            return "Translation not found for $item in $this->currentLang";
        }
        return $this->items[$item];
    }

    public function getLang() : string {
        return $this->currentLang;
    }
}