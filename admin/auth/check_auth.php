<?php
// Authentication check - include this at the top of protected pages
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: auth/login.php');
    exit;
}

// Refresh session
$_SESSION['last_activity'] = time();
