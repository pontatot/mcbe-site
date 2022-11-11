<?php
spl_autoload_register(function ($className) {
    $path = '../Source/Controller/' . $className . '.php';
    if (is_file($path)) include_once $path;
});
session_start();
$lang = Controller::getLang() ?? "EN";
Controller::loadView('contact.php', $lang::getItem('contact_page'), ["discordUser"=>Controller::getDiscordUser()]);