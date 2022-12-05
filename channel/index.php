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
use App\Site\Lib\UserConnexion;

if (!isset($_GET['search'])) $_GET['search'] = null;
if (isset($_GET['id'])) {
    $channel = ChannelManager::getChannel($_GET['id']);
    if (!$channel) {
        Controller::error('Channel not found', 404, './');
    }
    $self = UserConnexion::getInstance()->getConnectedUserChannel();
    if (isset($_GET['subscribe'])) $self ? ChannelManager::subscribe($channel->getId()) : Controller::error('You must be connected to subscribe', 403, './?id=' . $channel->getId());
    elseif (isset($_GET['unsubscribe'])) $self ? ChannelManager::unsubscribe($channel->getId()) : Controller::error('You must be connected to subscribe', 403, './?id=' . $channel->getId());
    if ($_GET['search'] && $_GET['search'] != '') $videos = ChannelManager::searchChannelVideos($channel->getId(), $_GET['search']);
    else $videos = ChannelManager::getChannelVideos($channel->getId());
    $channel = ChannelManager::getChannel($_GET['id']);
    $subbed = $self && ChannelManager::isSubbed($channel->getId());
    Controller::loadView('channel/view.php', $channel->getName(), ['channel'=>$channel, 'search'=>$_GET['search'], 'self'=>$self, 'videos'=>$videos, 'subbed'=>$subbed]);
} else {
    $channels = [];
    if ($_GET['search'] && $_GET['search'] != '') {
        $channels = ChannelManager::search($_GET['search']);
    } else {
        $channels = ChannelManager::getChannels();
    }
    Controller::loadView('channel/viewall.php', null, ['search'=>$_GET['search'], 'channels'=>$channels]);
}


