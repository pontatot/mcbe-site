<?php
spl_autoload_register(function ($className) {
    $path = '../Source/Controller/' . $className . '.php';
    if (is_file($path)) include_once $path;
});
session_start();
$lang = Controller::getLang();


$action = $_GET['action'] ?? "home";

if (!isset($_GET['video'])) {
    Controller::error($lang::getItem('error_video-not-found'));
    return;
}
$videoElement = VideoController::get($_GET['video']);
if (!$videoElement or !is_file('../Assets/vid/' . $_GET['video'] . '.' . $videoElement->getExtension())) {
    Controller::error($lang::getItem('error_video-not-found') . " " . $_GET['video']);
    return;
}
Controller::loadView("video.php", $lang::getItem('watch_page') . ' ' . $videoElement->getTitle(), ["page"=>"about", "video"=>$_GET['video']]);