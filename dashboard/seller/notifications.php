<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notification Settings</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background: #f1f7f0;
        font-family: 'Poppins', sans-serif;
    }

    .page-title {
        font-size: 32px;
        font-weight: 700;
        color: #2d6a4f;
    }

    .notify-card {
        background: white;
        padding: 25px;
        border-radius: 18px;
        border: 1px solid #d9e9d8;
        transition: 0.3s;
        box-shadow: 0 5px 18px rgba(0, 0, 0, 0.05);
    }
    .notify-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }

    .notify-icon {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        background: #e8f8ea;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        color: #1b8a5a;
    }

    .section-label {
        font-weight: 600;
        color: #2d6a4f;
    }

    .preview-box {
        background: #e8f8ea;
        border: 1px solid #c5e9c3;
        border-radius: 14px;
        padding: 15px;
        box-shadow: inset 0 0 10px rgba(0,0,0,0.05);
    }

    .mute-box {
        background: #ffe8e8;
        padding: 15px;
        border-radius: 14px;
        border: 1px solid #ffbcbc;
    }
</style>
</head>

<body>
<?php include 'header.php'; ?>
<div class="container py-5">

    <!-- HEADER -->
    <h2 class="page-title mb-2">
        <i class="fa-solid fa-bell"></i> Notification Settings
    </h2>
    <p class="text-muted mb-4">Manage how you want to receive alerts & updates.</p>


    <!-- MUTE ALL -->
    <div class="mute-box mb-4 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold text-danger mb-0">
            <i class="fa-solid fa-bell-slash"></i> Mute All Notifications
        </h6>

        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox">
        </div>
    </div>


    <div class="row g-4">

        <!-- Email Alerts -->
        <div class="col-md-4">
            <div class="notify-card">
                <div class="notify-icon">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <h4 class="mt-3">Email Alerts</h4>
                <p class="text-muted">Receive important updates via email.</p>

                <div class="form-check form-switch mt-3">
                    <label class="form-check-label fw-bold">Enable Email Alerts</label>
                    <input class="form-check-input" type="checkbox">
                </div>
            </div>
        </div>

        <!-- SMS Alerts -->
        <div class="col-md-4">
            <div class="notify-card">
                <div class="notify-icon">
                    <i class="fa-solid fa-message"></i>
                </div>
                <h4 class="mt-3">SMS Alerts</h4>
                <p class="text-muted">Get alerts directly on your phone.</p>

                <div class="form-check form-switch mt-3">
                    <label class="form-check-label fw-bold">Enable SMS Notifications</label>
                    <input class="form-check-input" type="checkbox">
                </div>
            </div>
        </div>

        <!-- App Notifications -->
        <div class="col-md-4">
            <div class="notify-card">
                <div class="notify-icon">
                    <i class="fa-solid fa-bell"></i>
                </div>
                <h4 class="mt-3">Push Notifications</h4>
                <p class="text-muted">Instant alerts inside the app.</p>

                <div class="form-check form-switch mt-3">
                    <label class="form-check-label fw-bold">Enable Push Notifications</label>
                    <input class="form-check-input" type="checkbox">
                </div>
            </div>
        </div>


        <!-- Weather Alerts -->
        <div class="col-md-4">
            <div class="notify-card">
                <div class="notify-icon">
                    <i class="fa-solid fa-cloud-sun"></i>
                </div>
                <h4 class="mt-3">Weather Alerts</h4>
                <p class="text-muted">Rain, storm & temperature warnings.</p>

                <div class="form-check form-switch">
                    <label class="form-check-label fw-bold">Enable Weather Alerts</label>
                    <input class="form-check-input" type="checkbox">
                </div>
            </div>
        </div>

        <!-- Tips & Guidance -->
        <div class="col-md-4">
            <div class="notify-card">
                <div class="notify-icon">
                    <i class="fa-solid fa-seedling"></i>
                </div>
                <h4 class="mt-3">Farming Tips</h4>
                <p class="text-muted">Daily tips to improve farming efficiency.</p>

                <div class="form-check form-switch">
                    <label class="form-check-label fw-bold">Enable Tips</label>
                    <input class="form-check-input" type="checkbox">
                </div>
            </div>
        </div>

        <!-- Order / Market Alerts -->
        <div class="col-md-4">
            <div class="notify-card">
                <div class="notify-icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <h4 class="mt-3">Order Alerts</h4>
                <p class="text-muted">Updates about your purchases.</p>

                <div class="form-check form-switch">
                    <label class="form-check-label fw-bold">Enable Order Notifications</label>
                    <input class="form-check-input" type="checkbox">
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>
