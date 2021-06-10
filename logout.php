<?php
session_start();
$_SESSION = array();
unset($_SESSION);
session_unset();
session_destroy();
session_write_close();
header('Location: /index.php');
exit;