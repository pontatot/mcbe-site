<?php
class EN extends AbstractLang
{
    private static array $_items = [
        //'page-name_'=>'Value'

        //globals
        'home_page'=>'Home',
        'upload_page'=>'Upload',
        'settings_page'=>'Settings',
        'contact_page'=>'Contact me',
        'error_page'=>'Error',
        'watch_page'=>'Watching',
        'website_foot'=>'MCBE\'s website',
        'lang_fr'=>'FR',
        'lang_en'=>'EN',

        //home page
        'home_title'=>'Welcome to my Website',



        //upload page
        'upload_vido-upload-label'=>'Upload your video',
        'upload_video-title-label'=>'Video title',
        'upload_video-title-placeholder'=>'My super Video',
        'upload_video-description-label'=>'Description',
        'upload_video-description-placeholder'=>'Welcome to my awesome video',
        'upload_video-upload-button-name'=>'Upload',
        'upload_video-upload-error'=>'Failed to upload video',
        'upload_video-missing'=>'No video to upload',
        'upload_video-database-upload'=>'Failed to insert into Database',
        'upload_video-wrong-format'=>'Wrong video format, requires type video',



        //settings page
        'settings_language'=>'Language',
        'settings_themes'=>'Theme',
        'settings_submit'=>'Submit',



        //contact page
        'contact_title'=>'Contact me',
        'contact_discord-title'=>'Discord',
        'contact_mail-title'=>'Mail',

        //watch page
        'watch_delete'=>'Delete',
        'watch_download'=>'Download',


        //error page
        'error_default'=>'Error',
        'error_video-not-found'=>'404 Video not found',
        'error_video-not-deleted'=>'406 Not Acceptable',
        'error_database-connection'=>'Could not connect to database',
    ];

    public function __construct()
    {
        static::addTranslation(static::$_items);
    }

    public static function getLang(): string
    {
        return get_class();
    }


}
new EN();