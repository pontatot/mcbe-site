<?php

use App\Site\Lib\Forms\Form;
use App\Site\Lib\Forms\FormInput;
use App\Site\Lib\Forms\GroupedFormElement;

if (!isset($search)) $search = null;
if (!isset($videos)) $videos = [];
echo new Form(elements: new GroupedFormElement(
    new FormInput('text', 'search', 'Video title', value:$search),
    new FormInput('submit', value:'Search')));
if (empty($videos)) {
    echo 'No video found';
} else {
    foreach ($videos as $video) {
        echo "<a href='./?id={$video->getId()}'>{$video->getTitle()}</a> by <a href='../channel?id={$video->getChannel()}'>{$video->getName()}</a><br/>";
    }
}
