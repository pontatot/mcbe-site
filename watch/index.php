<?php
spl_autoload_register(function ($className) {
    $path = '../Source/Controller/' . $className . '.php';
    if (is_file($path)) include_once $path;
});
session_start();
$lang = Controller::getLang() ?? "EN";
if (!isset($_GET['video'])) {
    Controller::error($lang::getItem('error_video-not-found'));
    return;
}
$videoElement = VideoController::get($_GET['video']);
if (!$videoElement or !is_file('../Assets/vid/' . $_GET['video'] . '.' . $videoElement->getExtension())) {
    Controller::error($lang::getItem('error_video-not-found') . " " . $_GET['video']);
    return;
}
Controller::loadView("video.php", $lang::getItem('watch_page') . ' ' . substr($_GET['video'], 0, -4), ["page"=>"about", "video"=>$_GET['video']]);