<?php
$lang = Controller::getLang() ?? "EN";
?>
<div class="settings">
<h2><?php echo $lang::getItem('settings_language'); ?></h2>
<section>
<?php
foreach (Controller::getSupportedLang() as $supportedLang) {
    echo '<a href=".?lang=' . $supportedLang . '"><p>' . $supportedLang . '</p><img class="icons" src="../Assets/img/' . strtolower($supportedLang) . '.png" alt="' . $supportedLang . '"></a>';
}
?>
</section>
<h2><?php echo $lang::getItem('settings_themes'); ?></h2>
<section>
<?php
foreach (Controller::getStyles() as $key => $values) {
    echo '<a href=".?style=' . $key . '" class="' . $key . 'style" >' . $key . '</a>';
}
?>
</section>
</div>