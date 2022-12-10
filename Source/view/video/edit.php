<?php

use App\Site\Lib\Forms\Form;
use App\Site\Lib\Forms\FormInput;
use App\Site\Lib\Forms\FormTextArea;
use App\Site\Lib\Forms\GroupedFormElement;
use App\Site\Lib\Forms\LabelledFormElement;
use App\Site\Lib\Forms\RawFormElement;

if (!isset($video) | !isset($channel)) return;
echo $error ?? null;
echo (new Form('./edit.php?id=' . $video->getId(), method:'post'))->addElement(
    new RawFormElement("<video controls><source src='../Assets/vid/{$video->getId()}.{$video->getExtension()}' type='video/mp4'></video>"),
    (new LabelledFormElement('Title',
        new FormInput('text', 'title', 'My super video', true, $video->getTitle())))->setId('title'),
    (new LabelledFormElement('Description',
        new FormTextArea('description', 'Welcome to my video', value:$video->getDescription())))->setId('description'),
    new GroupedFormElement(
            new FormInput('submit', value:'Edit'), new RawFormElement("<a href='./?id={$video->getId()}'>" . new FormInput('button', value:'Cancel') . "</a>")
    ));
