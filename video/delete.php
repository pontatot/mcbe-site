<?php
spl_autoload_register(function ($className) {
    $path = '../Source/Controller/' . $className . '.php';
    if (is_file($path)) include_once $path;
});
$lang = Controller::getLang();
session_start();
try {
    if (!isset($_SESSION['Channel'])) throw new ErrorException($lang::getItem('login_not'));
    if (!isset($_GET['video'])) throw new ErrorException($lang::getItem('error_video-not-found'));
    $videoElement = VideoController::get($_GET['video']);
    if (!$videoElement) throw new ErrorException($lang::getItem('error_video-not-found'));
    if ($videoElement->getChannel()->getId() != $_SESSION['Channel']) throw new ErrorException($lang::getItem('login_no-permission'));
    if (!VideoController::delete($_GET['video'])) throw new ErrorException($lang::getItem('error_video-not-deleted') . " " . $_GET['video']);
    


    $url = 'Location: ../home/';
    header($url);
} catch (ErrorException $e) {
    Controller::error($e->getMessage() . ', ' . $lang::getItem('error_redirecting'));
    header( "refresh:5; url=../watch?video=" . $_GET['video'] );
}
exit();