<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLBL</title>
    <link rel="icon" type="image/webp" href="../Assets/img/image_logo.webp">
</head>
<body>
    <header>
        
    </header>
    <main>
        <?php
            if(isset($viewPath) and is_file($viewPath)) require $viewPath;
            else require __DIR__ . "/error.php";
        ?>
    </main>
    <footer>

    </footer>
</body>
</html>