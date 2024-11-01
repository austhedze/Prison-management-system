<?php
session_start();
if ($_SESSION['role'] != 'warder') {
    header('Location: login.php');
    exit;
}
echo "Welcome to Warder Dashboard, " . $_SESSION['username'];
?>
