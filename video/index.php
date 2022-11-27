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
    if (isset($_POST['content'])) {
        VideoManager::comment($_GET['id'], $_POST['content']);
    }
    if (isset($_GET['like'])) VideoManager::thumbsUp($_GET['id']);
    elseif (isset($_GET['dislike'])) VideoManager::thumbsDown($_GET['id']);
    $video = VideoManager::getVideo($_GET['id']);
    Controller::loadView('video/view.php', 'view', ['video'=>$video]);
} else {
    if (!isset($_GET['search'])) $_GET['search'] = '';
    $videos = [];
    if ($_GET['search'] && $_GET['search'] != '') {
        $videos = VideoManager::search($_GET['search']);
    } else {
        $videos = VideoManager::getVideos();
    }
    Controller::loadView('video/viewall.php', 'view', ['search'=>$_GET['search'], 'videos'=>$videos]);
}


