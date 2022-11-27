<?php
if (!isset($username)) $username = null;
if (isset($error) and $error) echo "<p>$error</p>";
echo "
<form action=\"./log.php\" method=\"post\" enctype=\"multipart/form-data\">
    <label for=\"username\">Username</label>
    <input type='text' name=\"username\" value='hugdp' placeholder=\"Username\" id=\"username\" required/>
    <label for=\"password\">Password</label>
    <input type='password' name=\"password\" placeholder=\"Password\" id=\"password\" required/>
    <input type=\"submit\" value=\"Search\">
</form>";