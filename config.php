<?php
session_start();
if (!isset($base_url)) {
    $base_url = '/farm/';
}

define('DB_HOST', 'localhost');
define('DB_NAME', 'farm');
define('DB_USER', 'root');
define('DB_PASS', '');
define('SITE_NAME', 'GreenAgro');
define('SITE_TAGLINE', 'PREMIUM ORGANIC MARKETPLACE');
?>