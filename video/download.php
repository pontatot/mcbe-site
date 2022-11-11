<?php
spl_autoload_register(function ($className) {
    $path = '../Source/Controller/' . $className . '.php';
    if (is_file($path)) include_once $path;
});
session_start();
if (isset($_GET['video']) and is_file('../Assets/vid/'.$_GET['video'] . '.mp4')) {
    $video = VideoController::get($_GET['video']);
    header('Content-Type: video/mp4');
    header('Content-Disposition: attachment; filename="' . $video->getTitle() . '.mp4"');
    readfile('../Assets/vid/'.$_GET['video'] . '.mp4');
}
$url = 'Location: ../watch/?video=' . $_GET['video'] . '.mp4';
header($url);
exit();