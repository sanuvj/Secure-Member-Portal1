<?php
session_start();
session_unset();
session_destroy();
setcookie('user', '', time() - 3600, '/'); // Unset the cookie
header('Location: welcome.php');
exit;
?
