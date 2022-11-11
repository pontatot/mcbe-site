<?php
    if (!isset($discordUser)) return;
    $lang = Controller::getLang() ?? "EN";
?>
<h1><?php echo $lang::getItem('contact_title'); ?></h1>
<div>
    <img class="icons" src="../Assets/img/discord.png" alt="discord">
    <h3><?php echo $lang::getItem('contact_discord-title'); ?></h3>
    <p><a href="https://discordapp.com/users/630919091015909386"><?php echo $discordUser; ?></a></p>
</div>
<div>
    <img class="icons" src="../Assets/img/mail.png" alt="gmail">
    <h3><?php echo $lang::getItem('contact_mail-title'); ?></h3>
    <p><a href="mailto:mcbe.craft0@gmail.com?subject=Contact%20from%20website&body=Hello%20MCBE%20Craft">mcbe.craft0@gmail.com</a></p>
</div>