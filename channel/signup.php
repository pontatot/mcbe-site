<?php
spl_autoload_register(function ($className) {
    $path = '../Source/Controller/' . $className . '.php';
    if (is_file($path)) include_once $path;
});
session_start();
$lang = Controller::getLang();
try {
    if (!isset($_POST["channel_username"]) or !isset($_POST["email"]) or !isset($_POST["password"]) or !isset($_POST['passwordConf'])) throw new ErrorException($lang::getItem('signup_missing'));
    if ($_POST['password'] != $_POST['passwordConf']) throw new ErrorException($lang::getItem('signup_wrong-credentials'));
    $channel = ChannelController::signup($_POST["channel_username"], $_POST["email"], $_POST["channel_description"], $_POST['password']);
    if (!$channel) throw new ErrorException($lang::getItem('signup_insert-fail'));
    $_SESSION['Channel'] = $channel->getId();
    $url = 'Location: ../home';
} catch (ErrorException $exception) {
    unset($_SESSION['Channel']);
    $_SESSION['channel_username'] = $_POST['channel_username'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['channel_description'] = $_POST['channel_description'];
    $url = 'Location: ../channel/?page=signup&error=' . urlencode($lang::getItem('login_error') . ': ' . $exception->getMessage());
}
header($url);
exit();