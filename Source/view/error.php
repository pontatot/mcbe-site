<?php
if (!isset($error)) $error = "Error";
if (!isset($code)) $code = 400;
?>
<h1>
    <?php
    echo "Error $code: " . htmlspecialchars($error);
    ?>
</h1>
<?php

if (isset($redirect) && $redirect) echo "<a href=' ". $redirect . "'>Redirecting in 5 seconds...</a>";
