<?php
spl_autoload_register(function ($className) {
    $path = '../Source/Controller/' . $className . '.php';
    if (is_file($path)) include_once $path;
});
session_start();
$lang = Controller::getLang() ?? "EN";
if (isset($_GET['video'])) {
    if (!VideoController::delete($_GET['video'])){
        Controller::error($lang::getItem('error_video-not-deleted') . " " . $_GET['video']);
        exit();
    }
}
$url = 'Location: ../home/';
header($url);
exit();