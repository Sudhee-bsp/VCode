<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: loginadmin.php');
}
session_destroy();
header('location: loginadmin.php');
?>