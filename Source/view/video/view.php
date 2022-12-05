<?php

use App\Site\Lib\Forms\FormInput;
use App\Site\Lib\Forms\FormTextArea;

if (!isset($video)) return;
if (!isset($comments)) $comments = [];
if (!isset($channel)) $channel = null;
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
<?php
if ($channel && $channel->getId() == $video->getChannel()) {
    echo "<p><a href='./edit.php?id={$video->getId()}'>Edit</a></p>";
}
echo "<p>{$video->getDescription()}</p><h3>Comments</h3>";
if ($channel) echo (new \App\Site\Lib\Forms\Form("./?id={$video->getId()}", method:'post'))->addElement(new \App\Site\Lib\Forms\FormElementGroup(
    new FormTextArea('content', 'Super video, I love it', true),
    new FormInput('submit', value:'Post')));
foreach ($comments as $comment) {
    echo "<p><a href='../channel?id={$comment->getChannelId()}'>{$comment->getName()}</a>: {$comment->getContent()}</p>";
}