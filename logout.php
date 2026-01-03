<?php
$base_url = '/farm/';
session_start();
session_unset();  // Unset all session variables
session_destroy(); // Destroy the session

// Redirect to login page
header("Location: " . $base_url . "index.php");
exit();
?>
