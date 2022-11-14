<?php
$lang = Controller::getLang() ?? "EN";
$style = Controller::getStyle();
if (!isset($viewPath)) return;
if (!isset($title)) $title = "";
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
<?php
echo "--bg-color: {$style['bg-color']}; --text-color: {$style['text-color']}; --link-color: {$style['link-color']};"
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
        <div>
            <div>
                <div><a href="../settings/"><p><?php echo htmlspecialchars($lang::getItem('settings_page')); ?></p><img class="icons" src="../Assets/img/settings.png" alt="Settings"></a></div>
            </div>
            <ul>
                <?php
                foreach (['home', 'upload', 'contact'] as $page) echo '<li><a href="../' . $page . '/">' . htmlspecialchars($lang::getItem($page . '_page')) . '</a></li>'
                ?>
            </ul>
        </div>
    </nav>
</header>
<main>
    <?php
        if (is_file($viewPath)) require $viewPath
    ?>
</main>
<footer>
    <a href="../home/">
        <p><?php echo htmlspecialchars($lang::getItem('website_foot')) ?></p>
        <img class="icons" src="../Assets/img/image_logo.png" alt="MCBE">
    </a>
</footer>
</body>
</html>