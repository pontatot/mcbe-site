<?php

use App\Site\Lib\Forms\FormInput;

if (!isset($search)) $search = null;
echo new \App\Site\Lib\Forms\Form(elements: new \App\Site\Lib\Forms\GroupedFormElement(
    new FormInput('text', 'search', 'Video title', value:$_GET['search'] ?? null),
    new FormInput('submit', value:'Search')));
if (empty($channels)) {
    echo 'No channel found';
} else {
    foreach ($channels as $channel) {
        echo "<a href='./?id={$channel->getId()}'>{$channel->getName()}</a><br/>";
    }
}