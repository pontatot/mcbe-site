<?php
abstract class AbstractLang
{
    private static array $_itemsBase = [
        //'page-name_'=>'Value'

        //globals
        'home_page'=>null,
        'upload_page'=>null,
        'about_page'=>null,
        'contact_page'=>null,
        'error_page'=>null,
        'watch_page'=>null,
        'website_foot'=>null,
        'lang_fr'=>'FR',
        'lang_en'=>'EN',

        //home page
        'home_title'=>null,



        //upload page
        'upload_vido-upload-label'=>null,
        'upload_video-title-label'=>null,
        'upload_video-title-placeholder'=>null,
        'upload_video-description-label'=>null,
        'upload_video-description-placeholder'=>null,
        'upload_video-upload-button-name'=>null,
        'upload_video-upload-error'=>null,
        'upload_video-missing'=>null,
        'upload_video-database-upload'=>null,



        //about page
        'about_title'=>null,
        'about_desc'=>null,



        //contact page
        'contact_title'=>null,
        'contact_discord-title'=>null,
        'contact_mail-title'=>null,

        //watch page
        'watch_delete'=>null,
        'watch_download'=>null,




        //error page
        'error_default'=>null,
        'error_video-not-found'=>null,
        'error_video-not-deleted'=>null,
        'error_database-connection'=>null,
    ];

    protected static function addTranslation(array $translation) : void {
        foreach ($translation as $key=>$value) static::$_itemsBase[$key] = $value;
    }

    public static abstract function getLang() : string;

    public static function getItem(string $item) : string {
        return (isset(static::$_itemsBase[$item]) and !empty(static::$_itemsBase[$item])) ? static::$_itemsBase[$item] : "missing " . static::getLang() . " translation for '$item'";
    }

}