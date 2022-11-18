<?php
$lang = Controller::getLang();
if (!isset($_SESSION['channel_username'])) $_SESSION['channel_username'] = '';
echo (isset($_GET['error'])? "<h1>{$_GET['error']}</h1>": "")
?>
<form action="../channel/login.php" method="post" enctype="multipart/form-data">
    <label for="channel_username"><?php echo htmlspecialchars($lang::getItem('login_username-label')); ?></label>
    <input type="text" name="channel_username" placeholder="<?php echo $lang::getItem('login_username-placeholder'); ?>" value="<?php echo $_SESSION['channel_username']; ?>" required id="channel_username">
    <label for="password"><?php echo htmlspecialchars($lang::getItem('login_password-label')); ?></label>
    <input type="password" name="password" placeholder="<?php echo $lang::getItem('login_password-placeholder'); ?>" required id="password">
    <input type="submit" value="<?php echo $lang::getItem('login_submit-button'); ?>" name="submit">
</form>