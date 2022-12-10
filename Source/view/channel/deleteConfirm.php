<h1>!You are about to delete your channel!</h1>
<p>Confirm your password to continue</p>
<?php
if (isset($error)) echo "<p>$error</p>";
echo new \App\Site\Lib\Forms\Form('./edit.php?delete', 'Delete channel', 'post', elements: new \App\Site\Lib\Forms\FormInput('password', 'password', '1234', true));
