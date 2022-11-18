<?php
session_start();
unset($_SESSION['Channel']);
$url = 'Location: ../home';
header($url);
exit();