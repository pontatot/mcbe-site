<?php
session_start();
$url = 'Location: ./home';
if (isset($_GET['lang'])) $url .= '?lang=' . $_GET['lang'];
header($url);
exit();
