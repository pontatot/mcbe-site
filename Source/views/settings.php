<?php
$lang = Controller::getLang() ?? "EN";
?>
<form action="." method="post" enctype="multipart/form-data">
    <h2><?php echo $lang::getItem('settings_language'); ?></h2>
    <section>
    <?php
    foreach (Controller::getSupportedLang() as $supportedLang) {
        echo '<label for="lang_' . $supportedLang . '">' . $supportedLang . '</label>
    <input type="radio" id="lang_' . $supportedLang . '" name="lang" value="' . $supportedLang . '" ' . ($supportedLang==$lang? 'checked' : '') . '>';
    }
    ?>
    </section>
    <h2><?php echo $lang::getItem('settings_themes'); ?></h2>
    <section>
    <?php
    foreach (Controller::getStyles() as $key => $values) {
        echo '<div style="background-color:' . $values['bg-color'] . '" onMouseOver="this.style.backgroundColor=\'' . $values['link-color'] . '\'" onMouseOut="this.style.backgroundColor=\'' . $values['bg-color'] . '\'"><label style="color:' . $values['text-color'] . '" for="style_' . $key . '">' . $key . '</label>
    <input type="radio" id="style_' . $key . '" name="style" value="' . $key . '" ' . ($key==Controller::getStyleName()? 'checked' : '') . '></div>';
    }
    ?>
    </section>
    <input type="submit" value="<?php echo $lang::getItem('settings_submit'); ?>">
</form>