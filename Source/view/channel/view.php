<?php
if (!isset($id)) $id = 0;
if (!isset($search)) $search = null;
if (!isset($self)) $self = null;
if (!isset($channel)) return;
if (!isset($subbed)) $subbed = false;
?>
<h1><?php echo $channel->getName() ?></h1>
<h2><?php echo $channel->getSubCount() ?> subscribers</h2>
<?php
    if ($self && $channel->getId() != $self->getId())
echo "<p><a href='./?id={$id}&" . ($subbed ? 'un' : '') . "subscribe'>" . ($subbed ? 'un' : '') . "subscribe</a></p>";
?>
    <p><?php echo $channel->getDescription() ?></p>
<h3>Videos</h3>
<form action="." method="get" enctype="multipart/form-data">
    <label for="search"></label>
    <input type='text' name="search" placeholder="Video title" value='<?php echo $search ?>' id="search"/>
    <input type='hidden' value='$id' name='id'>
    <input type="submit" value="Search">
</form>
<?php
if (empty($videos)) {
    echo 'No video found';
} else {
    foreach ($videos as $video) {
        echo "<a href='../video?id={$video->getId()}'>{$video->getTitle()}</a><br/>";
    }
}