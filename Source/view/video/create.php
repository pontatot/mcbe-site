<?php

use App\Site\Lib\Forms\Form;
use App\Site\Lib\Forms\FormInput;
use App\Site\Lib\Forms\FormTextArea;
use App\Site\Lib\Forms\LabelledFormElement;

echo $error ?? null;
echo (new Form('./edit.php', 'Upload', 'post'))->addElement((new LabelledFormElement('Video',
        new FormInput('file', 'video_upload', required:true, accept:'video/*')))->setId('video_upload'),
    (new LabelledFormElement('Title',
        new FormInput('text', 'title', 'My super video', true, $_POST['title'] ?? null)))->setId('title'),
    (new LabelledFormElement('Description',
        new FormTextArea('description', 'Welcome to my video', value:$_POST['description'] ?? null)))->setId('description'));
