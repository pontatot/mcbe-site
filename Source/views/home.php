<?php
$lang = Controller::getLang() ?? "EN";
?>
<h1><?php echo $lang::getItem('home_title') ?></h1>
<section class="video-list">
    <ul>
        <?php
        $items = VideoController::getAll();
//        $items = scandir("../Assets/vid");
//        if (!$items) $items = ['', ''];
//        unset($items[0], $items[1]);
        foreach ($items as $item) {
            echo '<li class=\"grid-item\"><a href="../watch?video=' . urlencode($item->getId()) . '">' . htmlspecialchars($item->getTitle()) . ' - ' . htmlspecialchars($item->getChannel()->getName()) . '</a></li>';
        }
        ?>
    </ul>
</section>