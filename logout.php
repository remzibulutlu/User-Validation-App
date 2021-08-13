<?php
session_start();
session_unset();
session_destroy();

header("Location: soap-service.php");
exit();

?>