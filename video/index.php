<?php
require_once __DIR__ . '/../Source/Lib/ClassLoader.php';
$loader = new App\Site\Lib\ClassLoader();
$loader->addNamespace('App\Site', __DIR__ . '/../Source');
$loader->register();

use App\Site\Controller\Controller;
use App\Site\Controller\VideoManager;
use App\Site\Lib\UserConnexion;

$channel = UserConnexion::getInstance()->getConnectedUserChannel();
if (isset($_GET['id'])) {
    if (UserConnexion::getInstance()->isConnected()) {
        if (isset($_GET['like'])) VideoManager::thumbsUp($_GET['id']);
        elseif (isset($_GET['dislike'])) VideoManager::thumbsDown($_GET['id']);
        if (isset($_POST['content'])) {
            VideoManager::comment($_GET['id'], $_POST['content']);
        }
    } else {
        if (isset($_GET['like']) || isset($_GET['dislike'])) {
            Controller::error('You must be connected to Like', 403, './?id=' . $_GET['id']);
        }
        if (isset($_POST['content'])) {
            Controller::error('You must be connected to comment', 403, './?id=' . $_GET['id']);
        }
    }
    $video = VideoManager::getVideo($_GET['id']);
    if (!$video) Controller::error('Video not found', 404, './');
    $comments = VideoManager::getComments($video->getId());
    Controller::loadView('video/view.php', $video->getTitle(), ['video'=>$video, 'comments'=>$comments, 'channel'=>$channel]);
} else {
    if (!isset($_GET['search'])) $_GET['search'] = '';
    $videos = [];
    if ($_GET['search'] && $_GET['search'] != '') {
        $videos = VideoManager::search($_GET['search']);
    } else {
        $videos = VideoManager::getVideos();
    }
    Controller::loadView('video/viewall.php', null, ['search'=>$_GET['search'], 'videos'=>$videos, 'channel'=>$channel]);
}


