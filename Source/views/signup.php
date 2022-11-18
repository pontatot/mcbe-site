<?php
$lang = Controller::getLang();
if (!isset($_SESSION['channel_username'])) $_SESSION['channel_username'] = '';
if (!isset($_SESSION['email'])) $_SESSION['email'] = '';
if (!isset($_SESSION['channel_description'])) $_SESSION['channel_description'] = '';
echo (isset($_GET['error'])? "<h1>{$_GET['error']}</h1>": "")
?>
<form action="../channel/signup.php" method="post" enctype="multipart/form-data">
    <label for="channel_username"><?php echo htmlspecialchars($lang::getItem('signup_username-label')); ?></label>
    <input type="text" name="channel_username" placeholder="<?php echo $lang::getItem('signup_username-placeholder'); ?>" value="<?php echo $_SESSION['channel_username']; ?>" required id="channel_username">
    <label for="email"><?php echo htmlspecialchars($lang::getItem('signup_email-label')); ?></label>
    <input type="text" name="email" placeholder="<?php echo $lang::getItem('signup_email-placeholder'); ?>" value="<?php echo $_SESSION['email']; ?>" required id="email">
    <label for="channel_description"><?php echo htmlspecialchars($lang::getItem('signup_description-label')); ?></label>
    <textarea name="channel_description" placeholder="<?php echo $lang::getItem('signup_description-placeholder'); ?>" required id="channel_description"><?php echo $_SESSION['channel_description']; ?></textarea>
    <label for="password"><?php echo htmlspecialchars($lang::getItem('signup_password-label')); ?></label>
    <input type="password" name="password" placeholder="<?php echo $lang::getItem('signup_password-placeholder'); ?>" required id="password">
    <label for="passwordConf"><?php echo htmlspecialchars($lang::getItem('signup_passwordConf-label')); ?></label>
    <input type="password" name="passwordConf" placeholder="<?php echo $lang::getItem('signup_passwordConf-placeholder'); ?>" required id="passwordConf">
    <input type="submit" value="<?php echo $lang::getItem('signup_submit-button'); ?>" name="submit">
</form>