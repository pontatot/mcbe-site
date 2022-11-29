<?php
if (!isset($search)) $search = null;
?>
    <form action="." method="get" enctype="multipart/form-data">
        <label for="search"></label>
        <input type='text' name="search" placeholder="Channel name" value='<?php echo $search ?>' id="search"/>
        <input type="submit" value="Search">
    </form>
<?php
if (empty($channels)) {
    echo 'No channel found';
} else {
    foreach ($channels as $channel) {
        echo "<a href='./?id={$channel->getId()}'>{$channel->getName()}</a><br/>";
    }
}