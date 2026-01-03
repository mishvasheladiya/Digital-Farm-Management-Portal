<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>App Settings - Farmer Portal</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: "Poppins", sans-serif;
        background: #eef2ee;
        color: #333;
    }

    /* Header Section */
    .hero {
        color: #1b5e20;
        padding-left: 45px ;
    }

    .hero h1 {
        font-size: 34px;
        font-weight: 700;
    }

    .hero p {
        margin-top: 6px;
        font-size: 16px;
        opacity: 0.9;
    }

    /* Main Container */
    .container {
        padding: 40px 80px;
    }

    .settings-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .settings-card {
        background: white;
        padding: 25px;
        border-radius: 18px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        transition: 0.3s;
        cursor: pointer;
        border: 1px solid #e8e8e8;
    }

    .settings-card:hover {
        transform: translateY(-5px);
    }

    .settings-card h3 {
        font-size: 18px;
        font-weight: 600;
        color: #1b5e20;
        margin-bottom: 10px;
    }

    .settings-card p {
        font-size: 14px;
        color: #555;
    }

    /* Account Section */
    .section-title {
        font-size: 22px;
        font-weight: 600;
        color: #1b5e20;
        margin-bottom: 18px;
        margin-top: 8px;
    }

    .card {
        background: white;
        padding: 25px;
        border-radius: 18px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        margin-bottom: 30px;
    }

    .btn-danger {
        background: #c62828;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: 0.25s;
    }

    .btn-danger:hover {
        background: #8e0000;
    }
</style>
</head>

<body>

<?php include_once 'header.php'; ?>

<!-- Header -->
<div class="hero">
    <h1>App Settings</h1>
    <p>Customize your app experience.</p>
</div>

<div class="container">

    <!-- Settings Menu -->
    <div class="settings-grid">

        <div class="settings-card" onclick="window.location.href='general_settings.php'">
            <h3>General Settings</h3>
            <p>Theme, mode, animations, and dashboard preferences.</p>
        </div>

        <div class="settings-card" onclick="window.location.href='notification_settings.php'">
            <h3>Notification Settings</h3>
            <p>Weather alerts, market updates, and message notifications.</p>
        </div>

        <div class="settings-card" onclick="window.location.href='language_settings.php'">
            <h3>Language</h3>
            <p>Select your preferred language.</p>
        </div>

        <div class="settings-card" onclick="window.location.href='privacy_settings.php'">
            <h3>Privacy</h3>
            <p>Control what data you share and manage permissions.</p>
        </div>

        <div class="settings-card" onclick="window.location.href='security_settings.php'">
            <h3>Security</h3>
            <p>Manage login protection, 2FA, and active devices.</p>
        </div>

        <div class="settings-card" onclick="window.location.href='app_preferences.php'">
            <h3>App Preferences</h3>
            <p>Customize the app layout and behavior.</p>
        </div>

    </div>

    <!-- Account Management (Only this stays here) -->
    <h2 class="section-title">Account Management</h2>

    <div class="card">
        <p style="font-size:14px;margin-bottom:15px;">
            Permanently remove your account and all saved data.
        </p>
        <button class="btn-danger">Delete Account</button>
    </div>

</div>

</body>
</html>
