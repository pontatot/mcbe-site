<?php
require_once __DIR__ . '/../Source/Lib/ClassLoader.php';
// instantiate the loader
$loader = new App\Site\Lib\ClassLoader();
// register the base directories for the namespace prefix
$loader->addNamespace('App\Site', __DIR__ . '/../Source');
// register the autoloader
$loader->register();

use App\Site\Controller\Controller;
use App\Site\Lib\UserConnexion;

if (!UserConnexion::getInstance()->isConnected() | isset($_POST['username'])) {
    if (isset($_POST['username']) & isset($_POST['password'])) {
        if (\App\Site\Controller\ChannelManager::login($_POST['username'], $_POST['password'])) {
            Controller::redirect('./');
        }
    }
    Controller::loadView('channel/login.php', 'login', ['username'=>($_POST['username'] ?? null), 'error'=>((isset($_POST['username']) & isset($_POST['password'])) ? 'Wrong username or password' : null)]);
} else {
    UserConnexion::getInstance()->disconnect();
    Controller::redirect('./');
}