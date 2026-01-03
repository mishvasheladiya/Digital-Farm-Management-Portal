<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Activity Log</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background: #eef1ef;
        font-family: 'Segoe UI', sans-serif;
    }

    .log-container {
        max-width: 1100px;
        margin: 50px auto;
        background: #fff;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 6px 25px rgba(0,0,0,0.08);
        border: 1px solid #e7e7e7;
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #1b5e20;
        margin-bottom: 10px;
    }

    .subtitle {
        color: #666;
        font-size: 15px;
        margin-bottom: 25px;
    }

    /* Filter Buttons */
    .filter-btn {
        background: #f1f3f1;
        border: none;
        padding: 8px 18px;
        border-radius: 30px;
        font-size: 14px;
        margin-right: 10px;
        font-weight: 500;
        transition: 0.2s;
    }

    .filter-btn.active {
        background: #1b5e20;
        color: white;
    }

    .filter-btn:hover {
        background: #d7ddd7;
    }

    /* Table */
    .activity-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
    }

    .activity-table th {
        font-weight: 600;
        color: #444;
        padding-bottom: 8px;
        text-transform: uppercase;
        font-size: 12px;
    }

    .activity-row {
        background: #f9faf9;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        transition: 0.2s;
    }

    .activity-row:hover {
        background: #eef3ee;
        transform: translateY(-2px);
    }

    .activity-row td {
        padding: 14px 18px;
        font-size: 14.5px;
        color: #333;
        vertical-align: middle;
    }

    /* Status colors */
    .success {
        color: #2e7d32;
        font-weight: 600;
    }
    .failed {
        color: #c62828;
        font-weight: 600;
    }

    .log-icon {
        font-size: 20px;
        margin-right: 10px;
        color: #1b5e20;
    }
</style>

</head>

<body>

<?php include_once 'header.php'; ?>

<div class="log-container">

    <h2 class="page-title">
        <i class="bi bi-clock-history me-2"></i>Activity Log
    </h2>
    <p class="subtitle">Track all recent actions performed in your account.</p>

    <!-- Filter Buttons -->
    <div class="mb-4">
        <button class="filter-btn active">Today</button>
        <button class="filter-btn">This Week</button>
        <button class="filter-btn">This Month</button>
        <button class="filter-btn">All</button>
    </div>

    <!-- Activity Table -->
    <table class="activity-table">

        <thead>
            <tr>
                <th>Activity</th>
                <th>Device</th>
                <th>Location</th>
                <th>Status</th>
                <th>Date & Time</th>
            </tr>
        </thead>

        <tbody>

            <tr class="activity-row">
                <td><i class="bi bi-box-arrow-in-right log-icon"></i>Login to account</td>
                <td>Windows • Chrome</td>
                <td>India</td>
                <td class="success">Success</td>
                <td>Today • 3:45 PM</td>
            </tr>

            <tr class="activity-row">
                <td><i class="bi bi-shield-lock log-icon"></i>Password Changed</td>
                <td>Android • Mobile</td>
                <td>India</td>
                <td class="success">Done</td>
                <td>Today • 1:15 PM</td>
            </tr>

            <tr class="activity-row">
                <td><i class="bi bi-person-x log-icon"></i>Failed Login Attempt</td>
                <td>Unknown Device</td>
                <td>Unknown</td>
                <td class="failed">Failed</td>
                <td>Yesterday • 9:10 PM</td>
            </tr>

            <tr class="activity-row">
                <td><i class="bi bi-phone log-icon"></i>New Device Login</td>
                <td>Android • Mobile</td>
                <td>India</td>
                <td class="success">Verified</td>
                <td>2 days ago • 5:22 PM</td>
            </tr>

            <tr class="activity-row">
                <td><i class="bi bi-envelope log-icon"></i>Email Updated</td>
                <td>Windows • Edge</td>
                <td>India</td>
                <td class="success">Updated</td>
                <td>3 days ago • 11:40 AM</td>
            </tr>

        </tbody>

    </table>

</div>

</body>
</html>
