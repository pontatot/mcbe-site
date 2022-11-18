<?php
spl_autoload_register(function ($className) {
    $path = '../Source/Controller/' . $className . '.php';
    if (is_file($path)) include_once $path;
});
session_start();
$lang = Controller::getLang();
if (isset($_SESSION['Channel'])) unset($_SESSION['Channel']);
if (isset($_GET['page'])) {
    if ($_GET['page'] == 'signup') Controller::loadView('signup.php', $lang::getItem('signup_page'));
    else Controller::loadView('login.php', $lang::getItem('login_page'));
}
else Controller::loadView('login.php', $lang::getItem('login_page'));

