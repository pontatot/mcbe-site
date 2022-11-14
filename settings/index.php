<?php
spl_autoload_register(function ($className) {
    $path = '../Source/Controller/' . $className . '.php';
    if (is_file($path)) include_once $path;
});
session_start();
$lang = Controller::getLang() ?? "EN";
$customStyle = "";
foreach (Controller::getStyles() as $key => $values) {
    $customStyle .= '.' . $key . 'style {
        background-color: ' . $values['bg-color'] . ';
        border: 1px solid ' . $values['link-color'] . ';
        color: ' . $values['text-color'] . ';
        padding: 10px;
        scale: none;
        transition: scale 200ms, background-color 500ms;
    }
    .' . $key . 'style:hover {
        background-color: ' . $values['link-color'] . ';
        scale: 125%;
        transition: scale 200ms, background-color 500ms;
    }';
}
Controller::loadView('settings.php', $lang::getItem('settings_page'), ['customStyle'=>$customStyle]);
