<?php

use App\Site\Controller\ChannelManager;
if (!isset($id)) $id = 0;
if (!isset($search)) $search = null;
$channel = ChannelManager::getChannel($id);
$self = \App\Site\Lib\UserConnexion::getInstance()->getConnectedUserChannel();
echo "
<h1>{$channel->getName()}</h1>
<h2>{$channel->getSubCount()} subscribers</h2>";
if ($self && $channel->getId() != $self->getId())
echo "<p><a href='./?id={$id}&" . (ChannelManager::isSubbed($id) ? 'un' : '') . "subscribe'>" . (ChannelManager::isSubbed($id) ? 'un' : '') . "subscribe</a></p>";
echo "<p>{$channel->getDescription()}</p>
<br/>
<h3>Videos</h3>
<form action=\".\" method=\"get\" enctype=\"multipart/form-data\">
    <label for=\"search\"></label>
    <input type='text' name=\"search\" placeholder=\"Video title\" value='$search' id=\"search\"/>
    <input type='hidden' value='$id' name='id'>
    <input type=\"submit\" value=\"Search\">
</form>";
$videos = [];
if ($search && $search != '') {
$videos = ChannelManager::searchChannelVideos($id, $search);
} else {
$videos = ChannelManager::getChannelVideos($id);
}
if (count($videos) == 0) {
echo 'No video found';
} else {
foreach ($videos as $video) {
echo "<a href='../video?id={$video->getId()}'>{$video->getTitle()}</a><br/>";
}
}