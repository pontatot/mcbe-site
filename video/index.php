<?php
session_start();
$url = 'Location: ../' . (isset($_GET['lang'])? "?lang=" . $_GET['lang'] : '');
header($url);
exit();