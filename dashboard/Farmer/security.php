<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Security Settings</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background: #eef5ee;
        font-family: 'Poppins', sans-serif;
    }

    .page-title {
        font-size: 34px;
        font-weight: 800;
        color: #22543d;
        letter-spacing: -0.5px;
    }

    .subtitle {
        font-size: 15px;
        color: #779d84;
        margin-top: -5px;
    }

    .security-card {
        background: white;
        padding: 28px;
        border-radius: 20px;
        border: 1px solid #d3e8d1;
        transition: 0.3s ease;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.09);
        position: relative;
        overflow: hidden;
    }

    .security-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
    }

    .security-card:hover::after {
        opacity: 1;
    }

    .security-card::after {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: 20px;
        background: linear-gradient(135deg, rgba(45,106,79,0.06), rgba(255,255,255,0));
        opacity: 0;
        transition: 0.3s;
    }

    .security-icon {
        width: 65px;
        height: 65px;
        border-radius: 16px;
        background: #e3f6e6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: #1e774d;
        box-shadow: inset 0 0 8px rgba(0,0,0,0.05);
    }

    .btn-green {
        background: #2d6a4f;
        padding: 10px 22px;
        color: white;
        border-radius: 12px;
        border: none;
        font-size: 15px;
        font-weight: 500;
        transition: 0.2s;
    }

    .btn-green:hover {
        background: #22543d;
    }

    .meter-box {
        background: white;
        border-radius: 20px;
        padding: 25px;
        border: 1px solid #d3efd3;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
    }

    .strength-bar {
        height: 16px;
        border-radius: 10px;
        background: linear-gradient(to right, #f94144, #f8961e, #90be6d, #2d6a4f);
        transition: width 0.5s;
    }

    .strength-status {
        background: #2d6a4f;
        border-radius: 20px;
        padding: 6px 16px;
        font-size: 13px;
        color: white;
    }

    .device-card {
        background: #f3faf3;
        border: 1px solid #cae9cb;
        padding: 14px;
        border-radius: 14px;
        margin-bottom: 12px;
        transition: 0.2s;
    }

    .device-card:hover {
        background: #e9f7ea;
    }

    .danger-btn {
        background: #b91c1c;
        color: white;
        padding: 10px 18px;
        border-radius: 12px;
        font-weight: 600;
        border: none;
    }

    .danger-btn:hover {
        background: #921414;
    }

</style>
</head>

<body>
<?php include 'header.php'; ?>
<div class="container py-5">

    <!-- HEADER -->
    <h2 class="page-title">
        <i class="fa-solid fa-shield-halved"></i> Security Center
    </h2>
    <p class="subtitle">Advanced tools to protect your account and personal information.</p>


    <!-- SECURITY METER -->
    <div class="meter-box mt-4 mb-5">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-success"><i class="bi bi-shield-check"></i> Account Protection Score</h5>
            <span class="strength-status">Good Security</span>
        </div>
        <div class="strength-bar mt-3"></div>
        <p class="text-muted mt-2 mb-0">Improve your account protection for stronger security.</p>
    </div>


    <!-- MAIN SECTION -->
    <div class="row g-4">

        <!-- Password -->
        <div class="col-md-4">
            <div class="security-card">
                <div class="security-icon">
                    <i class="fa-solid fa-key"></i>
                </div>
                <h4 class="mt-3 mb-2">Password Security</h4>
                <p class="text-muted mb-3">Update your password to keep your account protected.</p>
                <button class="btn-green w-100">Change Password</button>
            </div>
        </div>

        <!-- 2FA -->
        <div class="col-md-4">
            <div class="security-card">
                <div class="security-icon">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <h4 class="mt-3 mb-2">Two-Factor Authentication</h4>
                <p class="text-muted">Add an extra layer of security using OTP verification.</p>

                <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label fw-semibold ms-2">Enable 2FA</label>
                </div>
            </div>
        </div>

        <!-- Login Alerts -->
        <div class="col-md-4">
            <div class="security-card">
                <div class="security-icon">
                    <i class="fa-solid fa-bell"></i>
                </div>
                <h4 class="mt-3 mb-2">Login Alerts</h4>
                <p class="text-muted">Receive alerts when your account is accessed.</p>
                <button class="btn-green w-100">Enable Alerts</button>
            </div>
        </div>

        <!-- Recovery -->
        <div class="col-md-4">
            <div class="security-card">
                <div class="security-icon">
                    <i class="fa-solid fa-envelope-circle-check"></i>
                </div>
                <h4 class="mt-3 mb-2">Recovery Options</h4>
                <p class="text-muted">Set your backup email and recovery phone.</p>
                <button class="btn-green w-100">Update Recovery Info</button>
            </div>
        </div>

        <!-- Devices -->
        <div class="col-md-8">
            <div class="security-card">
                <div class="security-icon">
                    <i class="fa-solid fa-laptop-code"></i>
                </div>
                <h4 class="mt-3">Logged-In Devices</h4>
                <p class="text-muted">Manage and view devices currently signed in.</p>

                <div class="device-card"><b>Android Phone</b> — Active now</div>
                <div class="device-card"><b>Chrome (Windows)</b> — 2 hours ago</div>
                <div class="device-card"><b>Chrome (Linux)</b> — 3 days ago</div>

                <button class="danger-btn mt-2"><i class="bi bi-power"></i> Logout All Devices</button>
            </div>
        </div>

    </div>
</div>

</body>
</html>
