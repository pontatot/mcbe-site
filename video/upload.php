<?php
spl_autoload_register(function ($className) {
    $path = '../Source/Controller/' . $className . '.php';
    if (is_file($path)) include_once $path;
});
session_start();
$lang = Controller::getLang();
try {
    if (!isset($_SESSION['Channel'])) throw new ErrorException($lang::getItem('login_not'));
    if (!isset($_FILES["video_upload"]) or !isset($_POST["title"])) throw new ErrorException($lang::getItem('upload_video-missing'));
    $type = (new finfo(FILEINFO_MIME_TYPE))->file($_FILES['video_upload']['tmp_name']);
    if (substr($type, 0, 6) != 'video/') throw new ErrorException($lang::getItem('upload_video-wrong-format'));
    $ext = pathinfo($_FILES["video_upload"]["full_path"],  PATHINFO_EXTENSION);
    if($ext == "") $ext = 'mp4';
    $mess = VideoController::upload($_SESSION['Channel'], $_POST['title'], $_POST['description'], $_FILES["video_upload"]["tmp_name"], $ext);
    if ($mess) throw new ErrorException($mess);
    unset($_SESSION['title']);
    unset($_SESSION['description']);
} catch (ErrorException $exception) {
    $_SESSION['title'] = $_POST['title'];
    $_SESSION['description'] = $_POST['description'];
    $uploadError = $exception->getMessage();
}
$url = 'Location: ../' . (!isset($uploadError) ? 'home' : 'upload/?error=' . urlencode($lang::getItem('upload_video-upload-error') . ": $uploadError"));
header($url);
exit();