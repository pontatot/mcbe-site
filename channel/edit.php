<?php

use App\Site\Controller\ChannelManager;
use App\Site\Controller\Controller;
use App\Site\Lib\UserConnexion;
use App\Site\Model\Channel;

require_once __DIR__ . '/../Source/Lib/ClassLoader.php';
// instantiate the loader
$loader = new App\Site\Lib\ClassLoader();
// register the base directories for the namespace prefix
$loader->addNamespace('App\Site', __DIR__ . '/../Source');
// register the autoloader
$loader->register();

$channel = UserConnexion::getInstance()->getConnectedUserChannel();
if ($channel) {
    if (isset($_GET['delete'])) {
        if (isset($_POST['password'])) {
            if (UserConnexion::paswdCheck($_POST['password'], UserConnexion::getInstance()->getConnectedUserChannel()->getPassword())) {
                ChannelManager::deleteChannel($channel->getId());
                Controller::redirect('./');
            }
            $error = 'Wrong password';
        }
        Controller::loadView('channel/deleteConfirm.php', null, ['error'=>$error??null]);
        exit();
    }
    if (isset($_POST['password'])) {
        $channel = new Channel($channel->getId(), $channel->getName(), $channel->getDescription(), $channel->getEmail(), $channel->getPassword());
        if (isset($_POST['channel_username'])) $channel->setName($_POST['channel_username']);
        if (isset($_POST['email'])) $channel->setEmail($_POST['email']);
        if (isset($_POST['channel_description'])) $channel->setDescription($_POST['channel_description']);

        if(UserConnexion::paswdCheck($_POST['password'], $channel->getPassword())) {
            if(ChannelManager::updateChannel($channel)) Controller::redirect("./?id={$channel->getId()}");
            else $error = "Channel name already exists";
        } else {
            $error = 'Wrong password';
        }
    }
    Controller::loadView('channel/edit.php', null, ['channel'=>$channel, 'error'=>$error??null]);
} else {
    if (isset($_POST['channel_username'], $_POST['email'], $_POST['password'], $_POST['passwordConf'])) {
        if ($_POST['password'] == $_POST['passwordConf']) {
            $channel = new Channel(null, $_POST['channel_username'], $_POST['channel_description'] ?? null, $_POST['email'], $_POST['password']);
            if(ChannelManager::createChannel($channel->getName(), $channel->getDescription(), $channel->getEmail(), UserConnexion::paswdHash($channel->getPassword()))) Controller::redirect('./');
            else $error = 'Channel already exists';
        } else $error = 'Passwords don\'t match';
    }
    Controller::loadView('channel/create.php', null, ['channel'=>$channel, 'error'=>$error??null]);
}

