<?php
spl_autoload_register(function ($className) {
    $path = '../Source/Controller/' . $className . '.php';
    if (is_file($path)) include_once $path;
});
session_start();
$lang = Controller::getLang() ?? "EN";
$uploadError = $lang::getItem('upload_video-missing');
if (isset($_FILES["video_upload"])) {
    $uploadError = VideoController::upload($_POST['title'], $_POST['description'], $_FILES["video_upload"]["tmp_name"], pathinfo($_FILES["video_upload"]["full_path"],  PATHINFO_EXTENSION) ?? 'mp4');
    if ($uploadError == null) {
        unset($_SESSION['title']);
        unset($_SESSION['description']);
    } else {
        $_SESSION['title'] = $_POST['title'];
        $_SESSION['description'] = $_POST['description'];
    }

}
$url = 'Location: ../' . (($uploadError == null) ? 'home' : 'upload/?error=' . urlencode($lang::getItem('upload_video-upload-error') . ": $uploadError"));
header($url);
exit();