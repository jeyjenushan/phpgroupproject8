<?php
include '../config.php';
session_start();
session_unset();
session_destroy();

// Set the cookie to expire in the past
setcookie("session_id", "", time() - 3600, "/");

unset($_COOKIE['session_id']);

header('location:login.php');

?>