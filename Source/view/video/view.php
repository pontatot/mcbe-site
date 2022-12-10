<?php

use App\Site\Lib\Forms\Form;
use App\Site\Lib\Forms\FormInput;
use App\Site\Lib\Forms\FormTextArea;
use App\Site\Lib\Forms\GroupedFormElement;

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
<?php
if (!isset($thumb)) {
    echo "<p><a href='./?id={$video->getId()}&like'>thumbs up</a>: {$video->getThumbsUpCount()}</p>";
    echo "<p><a href='./?id={$video->getId()}&dislike'>thumbs down</a>: {$video->getThumbsDownCount()}</p>";
} else {
    if ($thumb) {
        echo "<p><a href='./?id={$video->getId()}&unlike'>remove thumbs up</a>: {$video->getThumbsUpCount()}</p>";
        echo "<p><a href='./?id={$video->getId()}&dislike'>thumbs down</a>: {$video->getThumbsDownCount()}</p>";
    } else {
        echo "<p><a href='./?id={$video->getId()}&like'>thumbs up</a>: {$video->getThumbsUpCount()}</p>";
        echo "<p><a href='./?id={$video->getId()}&unlike'>remove thumbs down</a>: {$video->getThumbsDownCount()}</p>";
    }
}

if ($channel && $channel->getId() == $video->getChannel()) {
    echo "<p><a href='./edit.php?id={$video->getId()}'>Edit</a> <a href='./edit.php?id={$video->getId()}&delete'>Delete</a></p>";
}
echo "<p>{$video->getDescription()}</p><h3>Comments</h3>";
if ($channel) echo (new Form("./?id={$video->getId()}", method:'post'))->addElement(new GroupedFormElement(
    new FormTextArea('content', 'Super video, I love it', true),
    new FormInput('submit', value:'Post')));
foreach ($comments as $comment) {
    if ($channel && $channel->getId() == $comment->getChannelId()) {
        if (isset($_GET['comment']) && $_GET['comment'] == $comment->getId()) {
            echo "<p><a href='../channel?id={$comment->getChannelId()}'>{$comment->getName()}</a>: " . (new Form("./?id={$video->getId()}", method:'post'))->addElement(new GroupedFormElement(
                    new FormTextArea('edit', 'Super video, I love it', true, $comment->getContent()),
                    new FormInput('hidden', 'comment', value:$comment->getId()),
                    new FormInput('submit', value:'Edit'))) . "</p>";
        } else {
            echo "<p><a href='../channel?id={$comment->getChannelId()}'>{$comment->getName()}</a>: {$comment->getContent()} <a href='./?id={$video->getId()}&comment={$comment->getId()}'>Edit</a> <a href='./?id={$video->getId()}&comment={$comment->getId()}&delete'>Delete</a></p>";
        }
    } else {
        echo "<p><a href='../channel?id={$comment->getChannelId()}'>{$comment->getName()}</a>: {$comment->getContent()}</p>";
    }


}