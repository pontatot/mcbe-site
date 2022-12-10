<?php

use App\Site\Lib\UserConnexion;

$user = UserConnexion::getInstance()->getConnectedUserChannel();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Test website">
    <title><?php echo $bodyPagetitle ?? 'Unknown'; ?></title>
    <link rel="icon" type="image/webp" href="../Assets/img/image_logo.webp">
</head>
<body>
    <header>
        <?php
        if ($user) {
            echo "<a href='../channel/?id={$user->getId()}'>{$user->getName()}</a> <a href='../channel/log.php'>log out</a> <a href='../video/edit.php'>upload</a>";
        } else {
            echo "<a href='../channel/log.php'>log in</a> <a href='../channel/edit.php'>sign up</a>";
        }
        ?>
        <p>
            <a href="../video">Videos</a>
            <a href="../channel">Channels</a>
        </p>
    </header>
    <main>
        <?php
            if(isset($bodyViewPath) && is_file($bodyViewPath)) require $bodyViewPath;
            else require __DIR__ . "/error.php";
        ?>
    </main>
    <footer>

    </footer>
</body>
</html>