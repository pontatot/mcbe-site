<?php
require_once __DIR__ . '/../Source/Lib/ClassLoader.php';
// instantiate the loader
$loader = new App\Site\Lib\ClassLoader();
// register the base directories for the namespace prefix
$loader->addNamespace('App\Site', __DIR__ . '/../Source');
// register the autoloader
$loader->register();

use App\Site\Controller\Controller;
use App\Site\Controller\VideoManager;

if (isset($_GET['id'])) {
    $video = VideoManager::getVideo($_GET['id']);
    if (!$video) {
        Controller::error('Video not found', 404, './');
    }
    if (\App\Site\Lib\UserConnexion::getInstance()->isConnected()) {
        if (isset($_GET['like'])) VideoManager::thumbsUp($_GET['id']);
        elseif (isset($_GET['dislike'])) VideoManager::thumbsDown($_GET['id']);
        if (isset($_POST['content'])) {
            VideoManager::comment($_GET['id'], $_POST['content']);
        }
    } else {
        if (isset($_GET['like']) || isset($_GET['dislike'])) {
            Controller::error('You must be connected to Like', 403, './?id=' . $video->getId());
        }
        if (isset($_POST['content'])) {
            Controller::error('You must be connected to comment', 403, './?id=' . $video->getId());
        }
    }
    $comments = VideoManager::getComments($video->getId());
    Controller::loadView('video/view.php', $video->getTitle(), ['video'=>$video, 'comments'=>$comments]);
} else {
    if (!isset($_GET['search'])) $_GET['search'] = '';
    $videos = [];
    if ($_GET['search'] && $_GET['search'] != '') {
        $videos = VideoManager::search($_GET['search']);
    } else {
        $videos = VideoManager::getVideos();
    }
    Controller::loadView('video/viewall.php', 'Utube', ['search'=>$_GET['search'], 'videos'=>$videos]);
}


