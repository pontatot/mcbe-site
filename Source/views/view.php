<?php
$lang = Controller::getLang();
$style = Controller::getStyle();
if (!isset($viewPath)) return;
if (!isset($title)) $title = "";
$channel = (isset($_SESSION['Channel']) and $_SESSION['Channel'] != '') ? ChannelController::getChannel($_SESSION['Channel']) : null;
$channelName = $channel ? $channel->getName() : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo htmlspecialchars($title); ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "../Assets/css/style.css">
    <link rel="icon" type="image/png" href="../Assets/img/image_logo.png">
    <style>
        :root {
            --bg-color: 
<?php
echo $style['bg-color'] . "; --text-color: {$style['text-color']}; --link-color: {$style['link-color']};"
 ?>
        }
<?php
    if (isset($customStyle)) echo htmlspecialchars($customStyle);
 ?>
    </style>
</head>
<body>
<header>
    <nav>
        <div class="hamburger-menu">
            <input id="left_menu_toggle" class="hidden_item" type="checkbox" />
            <label class="left_menu_btn menu_btn" for="left_menu_toggle">
                <img class="icon" src="../Assets/img/burger-bar.png">
            </label>

            <ul class="left_menu_box menu_box">
                <?php

                foreach (['home', 'settings', 'contact'] as $page) echo '<li><a class="left_menu_item menu_item" href="../' . $page . '/">' . htmlspecialchars($lang::getItem($page . '_page')) . '</a></li>'
                ?>
            </ul>
        </div>
        <div>
            <h1><?php echo htmlspecialchars($title); ?></h1>
        </div>
        <div class="hamburger-menu">
            <input id="right_menu_toggle" class="hidden_item" type="checkbox" />
            <label class="right_menu_btn menu_btn" for="right_menu_toggle">
                <h2><?php echo htmlspecialchars(($channelName) ? $channelName: ''); ?></h2>
                <img class="icon" src="../Assets/img/image_logo.png" alt="MCBE">
            </label>

            <ul class="right_menu_box menu_box">
<?php
function createLinkItem($localpage, $localtitle, $lang) {
    echo '<li><a class="right_menu_item menu_item" href="../' . $localpage . '">' . htmlspecialchars($lang::getItem($localtitle . '_page')) . '</a></li>';
}
if (isset($_SESSION['Channel']) and $_SESSION['Channel'] != null and $_SESSION['Channel'] != '') {
    createLinkItem('channel/signout.php', 'signout', $lang);
    createLinkItem('upload', 'upload', $lang);
} else {
    createLinkItem('channel', 'login', $lang);
    createLinkItem('channel/?page=signup', 'signup', $lang);
}
?>
            </ul>
        </div>
<!--        <div>-->
<!--            <div>-->
<!--                --><?php
//                if (isset($_SESSION['Channel']) and $_SESSION['Channel'] != '') {
//                    echo '<div><a href="."><p>' . htmlspecialchars($_SESSION['Channel']) . '</p><img class="icons" src="../Assets/img/login.png" alt="Login"></a></div>';
//                } else {
//                    echo '<div><a href="../login/"><p>' . htmlspecialchars($lang::getItem('login_page')) . '</p><img class="icons" src="../Assets/img/login.png" alt="Login"></a></div>';
//                }
//                ?>
<!--                <div><a href="../settings/"><p>--><?php //echo htmlspecialchars($lang::getItem('settings_page')); ?><!--</p><img class="icons" src="../Assets/img/settings.png" alt="Settings"></a></div>-->
<!--            </div>-->
<!--            <ul>-->
<!--                --><?php
//                foreach (['home', 'upload', 'contact'] as $page) echo '<li><a href="../' . $page . '/">' . htmlspecialchars($lang::getItem($page . '_page')) . '</a></li>'
//                ?>
<!--            </ul>-->
<!--        </div>-->
    </nav>
</header>
<main>
    <?php
        if (is_file($viewPath)) require $viewPath
    ?>
</main>
<footer>
    <div>
        <div>
            <a href="../home/">
                <p><?php echo htmlspecialchars($lang::getItem('website_foot')) ?></p>
                <img class="icon" src="../Assets/img/image_logo.png" alt="MCBE">
            </a>
        </div>
    </div>
</footer>
</body>
</html>