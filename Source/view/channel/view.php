<?php

use App\Site\Lib\Forms\FormInput;
use App\Site\Lib\Forms\LabelledFormElement;

if (!isset($search)) $search = null;
if (!isset($self)) $self = null;
if (!isset($channel)) return;
if (!isset($subbed)) $subbed = false;
echo "<h1>{$channel->getName()}</h1><h2>{$channel->getSubCount()} subscribers</h2>";
if ($self && $channel->getId() != $self->getId()) echo "<p><a href='./?id={$channel->getId()}&" . ($subbed ? 'un' : '') . "subscribe'>" . ($subbed ? 'un' : '') . "subscribe</a></p>";
echo "<p>{$channel->getDescription()}</p><h3>Videos</h3>"
    .new \App\Site\Lib\Forms\Form(elements: new \App\Site\Lib\Forms\GroupedFormElement(
    new FormInput('text', 'search', 'Video title', value:$_GET['search'] ?? null),
    new FormInput('hidden', 'id', value:$channel->getId()),
    new FormInput('submit', value:'Search')));
if (empty($videos)) {
    echo 'No video found';
} else {
    foreach ($videos as $video) {
        echo "<a href='../video?id={$video->getId()}'>{$video->getTitle()}</a><br/>";
    }
}