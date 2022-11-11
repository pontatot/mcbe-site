<?php
$lang = Controller::getLang() ?? "EN";
$style = Controller::getStyle() ?? "1";
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
    if ($style == 2) {
        echo '--bg-color: #0C1618; --sext-color: #FAF4D3; --loink-color: #004643;';
    } else {
        echo '--bg-color: #04080F; --sext-color: #A1C6EA; --loink-color: #507DBC;';
    }
 ?>
        }
    </style>
</head>
<body>
<header>
    <nav>
        <div>
            <div>
                <?php
                    foreach (['en', 'fr'] as $l) {
                        echo '<div class="langIcon"><a href=".' . Controller::getUrlParams(['lang']) . ((Controller::getUrlParams(['lang']) != '?')? '&' : '') . 'lang=' . $l . '"><p>' . htmlspecialchars($lang::getItem('lang_' . $l)) . '</p><img class="icons" src="../Assets/img/' . $l . '.png" alt="' . htmlspecialchars($lang::getItem('lang_' . $l)) . '"></a></div>';
                    }
                ?>
            </div>
            <ul>
                <?php
                foreach (['home', 'upload', 'about', 'contact'] as $page) echo '<li><a href="../' . $page . '/">' . $lang::getItem($page . '_page') . '</a></li>'
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