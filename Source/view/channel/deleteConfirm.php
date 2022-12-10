<h1>!You are about to delete your channel!</h1>
<h2>This will delete all your videos</h2>
<p>Confirm your password to continue</p>
<?php

use App\Site\Lib\Forms\Form;
use App\Site\Lib\Forms\FormInput;

if (isset($error)) echo "<p>$error</p>";
echo new Form('./edit.php?delete', 'Delete channel', 'post', elements: new FormInput('password', 'password', '1234', true));
