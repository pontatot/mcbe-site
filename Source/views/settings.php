<?php
$lang = Controller::getLang() ?? "EN";
?>
<div class="settings">
<h2><?php echo htmlspecialchars($lang::getItem('settings_language')); ?></h2>
<section>
<?php
foreach (Controller::getSupportedLang() as $supportedLang) {
    echo '<a href=".?lang=' . urlencode($supportedLang) . '"><p>' . htmlspecialchars($supportedLang) . '</p><img class="icons" src="../Assets/img/' . rawurlencode(strtolower($supportedLang)) . '.png" alt="' . htmlspecialchars($supportedLang) . '"></a>';
}
?>
</section>
<h2><?php echo htmlspecialchars($lang::getItem('settings_themes')); ?></h2>
<section>
<?php
foreach (Controller::getStyles() as $key => $values) {
    echo '<a href=".?style=' . urlencode($key) . '" class="' . $key . 'style" >' . htmlspecialchars($key) . '</a>';
}
?>
</section>
</div>