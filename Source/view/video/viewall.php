<?php

use App\Site\Lib\Forms\FormInput;

if (!isset($search)) $search = null;
if (!isset($videos)) $videos = [];
echo new \App\Site\Lib\Forms\Form(elements: new \App\Site\Lib\Forms\FormElementGroup(
    new FormInput('text', 'search', 'Video title', value:$search),
    new FormInput('submit', value:'Search')));
if (empty($videos)) {
    echo 'No video found';
} else {
    foreach ($videos as $video) {
        echo "<a href='./?id={$video->getId()}'>{$video->getTitle()}</a> by <a href='../channel?id={$video->getChannel()}'>{$video->getName()}</a><br/>";
    }
}
