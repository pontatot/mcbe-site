<?php
require_once __DIR__ . '/../Source/Lib/ClassLoader.php';
// instantiate the loader
$loader = new App\Site\Lib\ClassLoader();
// register the base directories for the namespace prefix
$loader->addNamespace('App\Site', __DIR__ . '/../Source');
// register the autoloader
$loader->register();

use App\Site\Controller\VideoManager;
?>
<p>
    <a href="../video">Videos</a>
    <a href="../channel">Channels</a>
</p>


<?php
if (isset($_GET['id'])) {
    if (isset($_POST['content'])) {
        VideoManager::comment($_GET['id'], $_POST['content']);
    }
    $video = VideoManager::getVideo($_GET['id']);
    echo "
    <video controls>
        <source src=\"../Assets/vid/{$video->getId()}.{$video->getExtension()}\" type=\"video/mp4\">
    </video>
    <h1>{$video->getTitle()}</h1>
    <h2><a href='../channel?id={$video->getChannel()}'>{$video->getName()}</a></h2>
    <h3>{$video->getUpload()}</h3>
    <p>Views:{$video->getViewCount()} thumbs up: {$video->getThumbsUpCount()} thumbs down: {$video->getThumbsDownCount()}</p>
    <p>{$video->getDescription()}</p>
    <br/>
    <h3>Comments</h3>
    <form action=\"./?id={$_GET['id']}\" method=\"post\" enctype=\"multipart/form-data\">
        <label for=\"content\"></label>
        <textarea name=\"content\" placeholder=\"comment\" id=\"content\"></textarea>
        <input type=\"submit\" value=\"Post\">
    </form>
    ";
    foreach (VideoManager::getComments($_GET['id']) as $comment) {
        echo "<p><a href='../channel?id={$comment->getChannelId()}'>{$comment->getName()}</a>: {$comment->getContent()}</p>";
    }
} else {
    if (!isset($_GET['search'])) $_GET['search'] = '';
    echo "
    <form action=\".\" method=\"get\" enctype=\"multipart/form-data\">
        <label for=\"search\"></label>
        <input type='text' name=\"search\" placeholder=\"Video title\" value='{$_GET['search']}' id=\"search\"/>
        <input type=\"submit\" value=\"Search\">
    </form>";
    $videos = [];
    if ($_GET['search'] && $_GET['search'] != '') {
        $videos = VideoManager::search($_GET['search']);
    } else {
        $videos = VideoManager::getVideos();
    }
    if (count($videos) == 0) {
        echo 'No video found';
    } else {
        foreach ($videos as $video) {
            echo "<a href='./?id={$video->getId()}'>{$video->getTitle()}</a> by <a href='../channel?id={$video->getChannel()}'>{$video->getName()}</a><br/>";
        }
    }
}


