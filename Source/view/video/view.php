<?php

use App\Site\Controller\VideoManager;

if (!isset($video)) \App\Site\Controller\Controller::redirect('./');
echo "
    <video controls>
        <source src=\"../Assets/vid/{$video->getId()}.{$video->getExtension()}\" type=\"video/mp4\">
    </video>
    <h1>{$video->getTitle()}</h1>
    <h2><a href='../channel?id={$video->getChannel()}'>{$video->getName()}</a></h2>
    <h3>{$video->getUpload()}</h3>
    <p>Views:{$video->getViewCount()}</p><p><a href='./?id={$video->getId()}&like'>thumbs up</a>: {$video->getThumbsUpCount()}</p><p><a href='./?id={$video->getId()}&dislike'>thumbs down</a>: {$video->getThumbsDownCount()}</p>
    <p>{$video->getDescription()}</p>
    <br/>
    <h3>Comments</h3>
    <form action=\"./?id={$video->getId()}\" method=\"post\" enctype=\"multipart/form-data\">
        <label for=\"content\"></label>
        <textarea name=\"content\" placeholder=\"comment\" id=\"content\"></textarea>
        <input type=\"submit\" value=\"Post\">
    </form>
    ";
foreach (VideoManager::getComments($video->getId()) as $comment) {
    echo "<p><a href='../channel?id={$comment->getChannelId()}'>{$comment->getName()}</a>: {$comment->getContent()}</p>";
}