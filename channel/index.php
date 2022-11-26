<?php
require_once __DIR__ . '/../Source/Lib/ClassLoader.php';
// instantiate the loader
$loader = new App\Site\Lib\ClassLoader();
// register the base directories for the namespace prefix
$loader->addNamespace('App\Site', __DIR__ . '/../Source');
// register the autoloader
$loader->register();

use App\Site\Controller\ChannelManager;

?>
    <p>
        <a href="../video">Videos</a>
        <a href="../channel">Channels</a>
    </p>


<?php

if (!isset($_GET['search'])) $_GET['search'] = '';
if (isset($_GET['id'])) {
    $channel = ChannelManager::getChannel($_GET['id']);
    echo "
    <h1>{$channel->getName()}</h1>
    <h2>{$channel->getSubCount()} subscribers</h2>
    <p>{$channel->getDescription()}</p>
    <br/>
    <h3>Videos</h3>
    <form action=\".\" method=\"get\" enctype=\"multipart/form-data\">
        <label for=\"search\"></label>
        <input type='text' name=\"search\" placeholder=\"Video title\" value='{$_GET['search']}' id=\"search\"/>
        <input type='hidden' value='{$_GET['id']}' name='id'>
        <input type=\"submit\" value=\"Search\">
    </form>";
    $videos = [];
    if ($_GET['search'] && $_GET['search'] != '') {
        $videos = ChannelManager::searchChannelVideos($_GET['id'], $_GET['search']);
    } else {
        $videos = ChannelManager::getChannelVideos($_GET['id']);
    }
    if (count($videos) == 0) {
        echo 'No video found';
    } else {
        foreach ($videos as $video) {
            echo "<a href='../video?id={$video->getId()}'>{$video->getTitle()}</a><br/>";
        }
    }
} else {
    echo "
    <form action=\".\" method=\"get\" enctype=\"multipart/form-data\">
        <label for=\"search\"></label>
        <input type='text' name=\"search\" placeholder=\"Channel name\" value='{$_GET['search']}' id=\"search\"/>
        <input type=\"submit\" value=\"Search\">
    </form>";
    $channels = [];
    if ($_GET['search'] && $_GET['search'] != '') {
        $channels = ChannelManager::search($_GET['search']);
    } else {
        $channels = ChannelManager::getChannels();
    }
    if (count($channels) == 0) {
        echo 'No channel found';
    } else {
        foreach ($channels as $channel) {
            echo "<a href='./?id={$channel->getId()}'>{$channel->getName()}</a><br/>";
        }
    }
}


