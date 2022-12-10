<?php

use App\Site\Lib\Forms\FormInput;
use App\Site\Lib\Forms\FormTextArea;
use App\Site\Lib\Forms\LabelledFormElement;

if (!isset($channel)) $channel = new \App\Site\Model\Channel();
if (isset($error)) echo "<p>$error</p>";

echo (isset($_GET['error'])? "<h1>{$_GET['error']}</h1>": "");
echo (new \App\Site\Lib\Forms\Form('./edit.php', 'Sign up', 'post'))->addElement((new LabelledFormElement('Channel name',
        new FormInput('text', 'channel_username', 'MCBE Craft', true, $channel->getName() ?? null)))->setId('channel_username'),
    (new LabelledFormElement('Email',
        new FormInput('email', 'email', 'mcbe.craft0@gmail.com', true, $channel->getEmail() ?? null)))->setId('email'),
    (new LabelledFormElement('Channel description',
        new FormTextArea('channel_description', 'Welcome to my channel', false, $channel->getDescription() ?? null)))->setId('channel_description'),
    (new LabelledFormElement('Password',
        new FormInput('password', 'password', '1234', true)))->setId('password'),
    (new LabelledFormElement('Confirm your password',
        new FormInput('password', 'passwordConf', '1234', true)))->setId('passwordConf'));