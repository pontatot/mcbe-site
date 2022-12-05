<?php

use App\Site\Lib\Forms\FormInput;
use App\Site\Lib\Forms\LabelledFormElement;

if (!isset($username)) $username = null;
if (isset($error) and $error) echo "<p>$error</p>";
echo (new \App\Site\Lib\Forms\Form('./log.php', 'Log in', 'post'))->addElement((new LabelledFormElement('Username',
        new FormInput('text', 'username', 'MCBE Craft', true, $_POST['username'] ?? null)))->setId('username'),
    (new LabelledFormElement('Password',
        new FormInput('password', 'password', '1234', true)))->setId('password'));
