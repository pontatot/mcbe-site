<?php
$lang = Controller::getLang() ?? "EN";
//$_POST['title'], $_POST['description'], $_FILES["video_upload"]["tmp_name"]
if (!isset($_SESSION['title'])) $_SESSION['title'] = '';
if (!isset($_SESSION['description'])) $_SESSION['description'] = '';
echo (isset($_GET['error'])? "<h1>{$_GET['error']}</h1>": "")
?>
<form action="../video/upload.php" method="post" enctype="multipart/form-data">
    <label for="video_upload"><?php echo htmlspecialchars($lang::getItem('upload_vido-upload-label')); ?></label>
    <input type="file" id="video_upload" name="video_upload" required>
    <label for="title"><?php echo htmlspecialchars($lang::getItem('upload_video-title-label')); ?></label>
    <input type="text" name="title" placeholder="<?php echo $lang::getItem('upload_video-title-placeholder'); ?>" value="<?php echo $_SESSION['title']; ?>" required id="title">
    <label for="description"><?php echo htmlspecialchars($lang::getItem('upload_video-description-label')); ?></label>
    <textarea name="description" placeholder="<?php echo $lang::getItem('upload_video-description-placeholder'); ?>" id="description"><?php echo htmlspecialchars($_SESSION['description']); ?></textarea>
    <input type="submit" value="<?php echo $lang::getItem('upload_video-upload-button-name'); ?>" name="submit">
</form>