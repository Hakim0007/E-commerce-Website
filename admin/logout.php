<?php include "../server/configuration.php"; ?>

<?php session_start(); ?>

<?php

if (isset($_GET['logout'])) {
    if (isset($_SESSION['admin_logged_in'])) {
        unset($_SESSION['admin_logged_in']);
        unset($_SESSION['admin_name']);
        unset($_SESSION['admin_email']);
        header('location: login.php');
        exit;
    }
}

?>