<?php
spl_autoload_register(function ($className) {
    $path = '../Source/Controller/' . $className . '.php';
    if (is_file($path)) include_once $path;
});
session_start();
$lang = Controller::getLang();
try {
    if (!isset($_POST["channel_username"]) or !isset($_POST['password'])) throw new ErrorException($lang::getItem('login_missing'));
    $channel = ChannelController::login($_POST["channel_username"], $_POST['password']);
    if (!$channel) throw new ErrorException($lang::getItem('login_wrong-credentials'));
    $_SESSION['Channel'] = $channel->getId();
    $url = 'Location: ../home';
} catch (ErrorException $exception) {
    unset($_SESSION['Channel']);
    $_SESSION['channel_username'] = $_POST['channel_username'];
    $url = 'Location: ../channel/?error=' . urlencode($lang::getItem('login_error') . ': ' . $exception->getMessage());
}
header($url);
exit();