<?php
$lang = Controller::getLang();
?>
<h1><?php echo htmlspecialchars($lang::getItem('home_title')); ?></h1>
<section class="video-list">
    <ul>
        <?php
        $items = VideoController::getAll();
        foreach ($items as $item) {
            echo '<li><a href="../watch?video=' . urlencode($item->getId()) . '">' . htmlspecialchars($item->getTitle()) . ' - ' . htmlspecialchars($item->getChannel()->getName()) . '</a></li>';
        }
        ?>
    </ul>
</section>