<?php
$user = \App\Site\Lib\UserConnexion::getInstance()->getConnectedUserChannel();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $bodyPagetitle ?? 'Unknown'; ?></title>
    <link rel="icon" type="image/webp" href="../Assets/img/image_logo.webp">
</head>
<body>
    <header>
        <?php
        echo "<a href='../channel/log.php'>" . ($user ? $user->getName() : 'log in') . "</a>";
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