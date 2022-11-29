<?php
if (!isset($search)) $search = null;
if (!isset($videos)) $videos = [];

?>
<form action="." method="get" enctype="multipart/form-data">
    <label for="search"></label>
    <input type='text' name="search" placeholder="Video title" value='<?php echo $search; ?>' id="search"/>
    <input type="submit" value="Search">
</form>
<?php
if (empty($videos)) {
    echo 'No video found';
} else {
    foreach ($videos as $video) {
        echo "<a href='./?id={$video->getId()}'>{$video->getTitle()}</a> by <a href='../channel?id={$video->getChannel()}'>{$video->getName()}</a><br/>";
    }
}
