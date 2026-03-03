<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login_register.php');
    exit();
}

// Fix image paths
$imagePath = '/images/example.jpg';

// Updated onclick handlers
// Example onclick handler for a button
// <button onclick="window.location.href='/some/path'">Click Me</button>

// Rest of the user_page.php code...