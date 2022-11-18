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
        'login_page'=>'Log in',
        'signup_page'=>'Sign up',
        'signout_page'=>'Sign out',
        'website_foot'=>'MCBE\'s website',
        'lang_fr'=>'FR',
        'lang_en'=>'EN',
        'login_not'=>'Please login',

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
        'upload_video-missing'=>'Missing parameter',
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


        //log in page
        'login_username-label'=>'Username',
        'login_username-placeholder'=>'email adress/channel name',
        'login_password-label'=>'Password',
        'login_password-placeholder'=>'Your password',
        'login_submit-button'=>'Log in',
        'login_missing'=>'Missing username or password',
        'login_wrong-credentials'=>'Wrong username or password',
        'login_error'=>'Login error',
        'login_no-permission'=>'You do not have the permission to do this',


        //sign up page
        'signup_username-label'=>'Username',
        'signup_username-placeholder'=>'Channel name',
        'signup_email-label'=>'Email adress',
        'signup_email-placeholder'=>'you@example.com',
        'signup_description-label'=>'Channel description',
        'signup_description-placeholder'=>'About your channel',
        'signup_password-label'=>'Password',
        'signup_password-placeholder'=>'Your password',
        'signup_passwordConf-label'=>'Confirm your password',
        'signup_passwordConf-placeholder'=>'Your password',
        'signup_submit-button'=>'Sign in',
        'signup_missing'=>'Missing username, email, password or password confirmation',
        'signup_wrong-credentials'=>'Passwords aren\'t matching',
        'signup_insert-fail'=>'Could not create account',
        'signup_error'=>'Signing up error',


        //error page
        'error_default'=>'Error',
        'error_video-not-found'=>'404 Video not found',
        'error_video-not-deleted'=>'406 Not Acceptable',
        'error_database-connection'=>'Could not connect to database',
        'error_redirecting'=>'Redirecting in 5 seconds',
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