<?php
    if (!isset($video)) return;
    function getUrl(string $action, string $vid) : string {
        return "../video/$action.php?video=" . urlencode($vid);
    }
    $lang = Controller::getLang();
    $videoElement = VideoController::get($video);
?>
<video controls>
    <source src="../Assets/vid/<?php echo rawurlencode($video) . '.' . rawurlencode($videoElement->getExtension()) ?>" type="video/mp4">
</video>
<h1><?php echo  htmlspecialchars($videoElement->getTitle()); ?></h1>
<h2><?php echo  htmlspecialchars($videoElement->getChannel()->getName()); ?></h2>
<p><?php echo  htmlspecialchars($videoElement->getDescription()); ?></p>
<?php
foreach (['delete', 'download'] as $action) echo '<a class="link" href="' . getUrl($action, $video) . '">' . $lang::getItem('watch_' . $action) . '</a>';
?>