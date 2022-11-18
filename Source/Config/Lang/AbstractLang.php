<?php
abstract class AbstractLang
{
    private static array $_itemsBase = [
        //'page-name_'=>'Value'

        //globals
        'home_page'=>null,
        'upload_page'=>null,
        'settings_page'=>null,
        'contact_page'=>null,
        'error_page'=>null,
        'watch_page'=>null,
        'login_page'=>null,
        'signup_page'=>null,
        'signout_page'=>null,
        'website_foot'=>null,
        'lang_fr'=>'FR',
        'lang_en'=>'EN',
        'login_not'=>null,

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
        'upload_video-wrong-format'=>null,



        //settings page
        'settings_language'=>null,
        'settings_themes'=>null,
        'settings_submit'=>null,



        //contact page
        'contact_title'=>null,
        'contact_discord-title'=>null,
        'contact_mail-title'=>null,

        //watch page
        'watch_delete'=>null,
        'watch_download'=>null,

        //log in page
        'login_username-label'=>null,
        'login_username-placeholder'=>null,
        'login_password-label'=>null,
        'login_password-placeholder'=>null,
        'login_submit-button'=>null,
        'login_missing'=>null,
        'login_wrong-credentials'=>null,
        'login_error'=>null,
        'login_no-permission'=>null,


        //sign up page
        'signup_username-label'=>null,
        'signup_username-placeholder'=>null,
        'signup_email-label'=>null,
        'signup_email-placeholder'=>null,
        'signup_description-label'=>null,
        'signup_description-placeholder'=>null,
        'signup_password-label'=>null,
        'signup_password-placeholder'=>null,
        'signup_submit-button'=>null,
        'signup_missing'=>null,
        'signup_wrong-credentials'=>null,
        'signup_insert-fail'=>null,
        'signup_error'=>null,


        //error page
        'error_default'=>null,
        'error_video-not-found'=>null,
        'error_video-not-deleted'=>null,
        'error_database-connection'=>null,
        'error_redirecting'=>null,
    ];

    protected static function addTranslation(array $translation) : void {
        foreach ($translation as $key=>$value) static::$_itemsBase[$key] = $value;
    }

    public static abstract function getLang() : string;

    public static function getItem(string $item) : string {
        return (isset(static::$_itemsBase[$item]) and !empty(static::$_itemsBase[$item])) ? static::$_itemsBase[$item] : "missing " . static::getLang() . " translation for '$item'";
    }

}