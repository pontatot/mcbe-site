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
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="MCBE Site">
    <meta property="og:title" content="<?php echo htmlspecialchars($title); ?>">
    <meta property="og:description" content="This is an example">
    <meta property="og:image" content="https://mcbe-site.42web.io/Assets/img/image_logo.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@pontatot">
    <meta name="twitter:creator" content="@MCBE-Craft">
    <meta content="https://mcbe-site.42web.io/home/" property="og:url" />
    <meta content="#1E2640" data-react-helmet="true" name="theme-color" />
    <link rel="stylesheet" href= "../Assets/css/style.css">
    <link rel="icon" type="image/png" href="../Assets/img/image_logo.png">
    <style>
        :root {
<?php
echo "--bg-color: {$style['bg-color']}; --text-color: {$style['text-color']}; --link-color: {$style['link-color']};"
 ?>
        }
    </style>
</head>
<body>
<header>
    <nav>
        <div>
            <div>
                <div class="langIcon"><a href="../settings/"><p><?php echo $lang::getItem('settings_page'); ?></p><img class="icons" src="../Assets/img/settings.png" alt="Settings"></a></div>
            </div>
            <ul>
                <?php
                foreach (['home', 'upload', 'contact'] as $page) echo '<li><a href="../' . $page . '/">' . $lang::getItem($page . '_page') . '</a></li>'
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
        <p><?php echo $lang::getItem('website_foot') ?></p>
        <img class="icons" src="../Assets/img/image_logo.png" alt="MCBE">
    </a>
</footer>
</body>
</html>