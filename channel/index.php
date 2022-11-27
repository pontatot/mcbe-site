<?php
require_once __DIR__ . '/../Source/Lib/ClassLoader.php';
// instantiate the loader
$loader = new App\Site\Lib\ClassLoader();
// register the base directories for the namespace prefix
$loader->addNamespace('App\Site', __DIR__ . '/../Source');
// register the autoloader
$loader->register();

use App\Site\Controller\ChannelManager;
use App\Site\Controller\Controller;

if (!isset($_GET['search'])) $_GET['search'] = '';
if (isset($_GET['id'])) {
    if (isset($_GET['subscribe'])) ChannelManager::subscribe($_GET['id']);
    elseif (isset($_GET['unsubscribe'])) ChannelManager::unsubscribe($_GET['id']);
    Controller::loadView('channel/view.php', 'channel', ['id'=>$_GET['id'], 'search'=>($_GET['search'] ?? null)]);
} else {
    Controller::loadView('channel/viewall.php', 'channel', ['search'=>($_GET['search'] ?? null)]);
}


