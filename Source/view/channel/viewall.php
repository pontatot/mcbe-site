<?php

use App\Site\Controller\ChannelManager;
if (!isset($search)) $search = null;
echo "
    <form action=\".\" method=\"get\" enctype=\"multipart/form-data\">
        <label for=\"search\"></label>
        <input type='text' name=\"search\" placeholder=\"Channel name\" value='$search' id=\"search\"/>
        <input type=\"submit\" value=\"Search\">
    </form>";
$channels = [];
if ($search && $search != '') {
    $channels = ChannelManager::search($search);
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