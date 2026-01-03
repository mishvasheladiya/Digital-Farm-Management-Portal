<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Security Center - Farmer Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: 'Inter', sans-serif;
        background: #f4f7f4;
        color: #222;
    }

    /* FULL PAGE CONTAINER */
    .wrapper {
        width: 100%;
        padding: 30px 40px;
    }

    .page-title {
        font-size: 30px;
        font-weight: 700;
        margin-bottom: 25px;
        color: #1b5e20;
    }

    .grid {
        display: grid;
        width: 100%;
        grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
        gap: 25px;
    }

    .card {
        background: white;
        padding: 25px;
        border-radius: 18px;
        box-shadow: 0 4px 18px rgba(0,0,0,0.08);
        border: 1px solid #e5e5e5;
        transition: 0.3s;
        width: 100%;
    }

    .card:hover {
        transform: translateY(-4px);
    }

    .card h3 {
        font-size: 19px;
        color: #1b5e20;
        margin-bottom: 12px;
    }

    .card p {
        font-size: 14.5px;
        color: #444;
        line-height: 1.6;
    }

    .toggle {
        width: 55px;
        height: 28px;
        background: #ccc;
        border-radius: 20px;
        position: relative;
        cursor: pointer;
        margin-top: 10px;
    }

    .toggle::after {
        content: "";
        width: 22px;
        height: 22px;
        background: white;
        border-radius: 50%;
        position: absolute;
        top: 3px;
        left: 3px;
        transition: 0.3s;
    }

    .toggle.active {
        background: #43a047;
    }

    .toggle.active::after {
        left: 30px;
    }

    .device-table {
        width: 100%;
        margin-top: 15px;
        border-collapse: collapse;
    }

    .device-table th,
    .device-table td {
        text-align: left;
        padding: 10px;
        font-size: 14px;
    }

    .device-table tr:nth-child(even) {
        background: #f7faf7;
    }

    .btn-danger {
        margin-top: 18px;
        background: #c62828;
        color: white;
        padding: 10px 18px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        transition: 0.25s;
    }

    .btn-danger:hover {
        background: #8e0000;
    }
</style>
</head>
<body>

<?php include_once 'header.php'; ?>

<div class="wrapper">

<h2 class="page-title">Security Center</h2>

<div class="grid">

    <!-- Security Status -->
    <div class="card">
        <h3>🛡 Overall Security Status</h3>
        <p>Your account is moderately protected. Improve security by enabling 2-Factor Authentication.</p>
    </div>

    <!-- Login Protection -->
    <div class="card">
        <h3>🔐 Login Protection</h3>
        <p>Receive alerts whenever someone logs into your account from a new device.</p>
        <div class="toggle active"></div>
    </div>

    <!-- 2FA -->
    <div class="card">
        <h3>📱 Two-Factor Authentication (2FA)</h3>
        <p>Protect your account by requiring an OTP during login.</p>
        <div class="toggle"></div>
    </div>

    <!-- Recovery Options -->
    <div class="card">
        <h3>🛠 Account Recovery Options</h3>
        <p>Email: farmer@example.com</p>
        <p>Phone: +91 98765 43210</p>
        <p>Keep these up to date to avoid losing access.</p>
    </div>

    <!-- Device Management -->
    <div class="card">
        <h3>💻 Active Devices</h3>
        <table class="device-table">
            <tr>
                <th>Device</th><th>Status</th>
            </tr>
            <tr>
                <td>Windows Chrome</td><td>Active now</td>
            </tr>
            <tr>
                <td>Android Mobile</td><td>2 hours ago</td>
            </tr>
        </table>
        <button class="btn-danger">Logout All Devices</button>
    </div>

    <!-- Alerts -->
    <div class="card">
        <h3>⚠ Suspicious Activity Alerts</h3>
        <p>No suspicious login attempts detected.</p>
        <div class="toggle active"></div>
    </div>

</div>

</div>

</body>
</html>
