<?php
    if (!isset($video)) return;
    if (!isset($comments)) $comments = [];
?>
    <video controls>
        <source src="../Assets/vid/<?php echo $video->getId() . '.' . $video->getExtension() ?>" type="video/mp4">
    </video>
    <h1><?php echo $video->getTitle()?></h1>
    <h2><a href='../channel?id=<?php echo $video->getChannel()?>'><?php echo $video->getName()?></a></h2>
    <h3><?php echo $video->getUpload()?></h3>
    <p>Views:<?php echo $video->getViewCount()?></p>
    <p><a href='./?id=<?php echo $video->getId()?>&like'>thumbs up</a>: <?php echo $video->getThumbsUpCount()?></p>
    <p><a href='./?id=<?php echo $video->getId()?>&dislike'>thumbs down</a>: <?php echo $video->getThumbsDownCount()?></p>
    <p><?php echo $video->getDescription()?></p>
    <h3>Comments</h3>
    <form action="./?id=<?php echo $video->getId()?>" method="post" enctype="multipart/form-data">
        <label for="content"></label>
        <textarea name="content" placeholder="comment" id="content"></textarea>
        <input type="submit" value="Post">
    </form>
<?php
foreach ($comments as $comment) {
    echo "<p><a href='../channel?id={$comment->getChannelId()}'>{$comment->getName()}</a>: {$comment->getContent()}</p>";
}