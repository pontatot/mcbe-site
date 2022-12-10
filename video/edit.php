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

$channel = Controller::getChannelLogged();
if (!$channel) {
    Controller::error('You must be connected', 403, './ ' . isset($_GET['id']) ? '?id=' . $_GET['id'] : '');
}
if (isset($_GET['id'])) {
    $video = VideoManager::getVideo($_GET['id']);
    if ($video->getChannel() != $channel->getId()) Controller::error('You do not have access to this video', 403, './?id=' . $_GET['id']);
    if (isset($_GET['delete'])) {
        $db = VideoManager::deleteVideo($video->getId());
        $file = unlink("../Assets/vid/{$video->getId()}.{$video->getExtension()}");
        if ($db and $file) {
            Controller::redirect('./');
        }
        Controller::error("Couldn't delete {$video->getTitle()}" . (!$db ? ', Failed to remove from database' : '') . (!$file ? ', Failed to remove video file' : ''), 500, "./?id={$video->getId()}");
        exit();
    }
    if (isset($_POST['title'])) $video->setTitle($_POST['title']);
    if (isset($_POST['description'])) $video->setDescription($_POST['description']);
    if (isset($_POST['title']) & isset($_POST['description'])) {
        if (VideoManager::updateVideo($video->getId(), $_POST['title'], $_POST['description'])){
            Controller::redirect('./?id=' . $video->getId());
        } else {
            $error = 'Couldn\'t edit the video, this can be due to the title not being unique';
        }
    }
    Controller::loadView('video/edit.php', 'Editing ' . $video->getTitle(), ['video'=>$video, 'channel'=>$channel, 'error'=>($error ?? null)]);
} else {
    if (isset($_FILES["video_upload"]) & isset($_POST["title"])) {
        $type = (new finfo(FILEINFO_MIME_TYPE))->file($_FILES['video_upload']['tmp_name']);
        if (str_starts_with($type, 'video/')) {
            $ext = pathinfo($_FILES["video_upload"]["full_path"],  PATHINFO_EXTENSION) ?? 'mp4';
            $video = VideoManager::createVideo($_POST['title'], $_POST['description'], $channel->getId(), $ext);
            if ($video) {
                if (move_uploaded_file($_FILES['video_upload']['tmp_name'], "../Assets/vid/" . $video->getId() . "." . $ext)) Controller::redirect('./?id=' . $video->getId());
                else {
                    VideoManager::deleteVideo($video->getId());
                    $error = 'Failed to upload video';
                }
            } else $error = 'Video title already exists';
        } else $error = 'Wrong file format: ' . $type;
    }
    Controller::loadView('video/create.php', 'Uploading', ['channel'=>$channel, 'error'=>$error ?? null]);
}
