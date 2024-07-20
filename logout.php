<?php
session_start();
session_unset();
session_destroy();
header("Location: http://localhost/swiming%20projet/ap/index.php");
exit();
?>
