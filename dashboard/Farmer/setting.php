<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }
        .settings-card {
            border-radius: 15px;
            padding: 25px;
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: 0.2s;
            cursor: pointer;
        }
        .settings-card:hover {
            transform: translateY(-5px);
        }
        .settings-icon {
            font-size: 35px;
            color: #4CAF50;
            margin-right: 20px;
        }
        .section-title {
            font-size: 32px !important;
            font-weight: 700 !important;
            color: #2f6e3f;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>

<body>
<?php include 'header.php'; ?>
<div class="container py-5">

    <h2 class="section-title mb-4"> Settings</h2>

    <div class="row g-4">

        <!-- Row 1 -->
        <div class="col-md-4">
            <a href="profile_settings.php">
                <div class="settings-card d-flex align-items-center">
                    <i class="bi bi-person-circle settings-icon"></i>
                    <div>
                        <h5 class="mb-1">Profile Settings</h5>
                        <p class="text-muted mb-0">Update your personal details</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="security.php">
                <div class="settings-card d-flex align-items-center">
                    <i class="bi bi-shield-lock settings-icon"></i>
                    <div>
                        <h5 class="mb-1">Security</h5>
                        <p class="text-muted mb-0">Secure your account</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="notifications.php">
                <div class="settings-card d-flex align-items-center">
                    <i class="bi bi-bell settings-icon"></i>
                    <div>
                        <h5 class="mb-1">Notifications</h5>
                        <p class="text-muted mb-0">Control alerts & reminders</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Row 2 -->
        <div class="col-md-4">
            <a href="language.php">
                <div class="settings-card d-flex align-items-center">
                    <i class="bi bi-translate settings-icon"></i>
                    <div>
                        <h5 class="mb-1">Language</h5>
                        <p class="text-muted mb-0">Select preferred language</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="privacy.php">
                <div class="settings-card d-flex align-items-center">
                    <i class="bi bi-lock settings-icon"></i>
                    <div>
                        <h5 class="mb-1">Privacy</h5>
                        <p class="text-muted mb-0">Manage privacy settings</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="app_settings.php">
                <div class="settings-card d-flex align-items-center">
                    <i class="bi bi-gear settings-icon"></i>
                    <div>
                        <h5 class="mb-1">App Settings</h5>
                        <p class="text-muted mb-0">General application options</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Row 3 -->
        <div class="col-md-4">
            <a href="theme_mode.php">
                <div class="settings-card d-flex align-items-center">
                    <i class="bi bi-moon-stars settings-icon"></i>
                    <div>
                        <h5 class="mb-1">Mode</h5>
                        <p class="text-muted mb-0">Light / Dark theme</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="change_password.php">
                <div class="settings-card d-flex align-items-center">
                    <i class="bi bi-key settings-icon"></i>
                    <div>
                        <h5 class="mb-1">Change Password</h5>
                        <p class="text-muted mb-0">Update your password</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="activity_log.php">
                <div class="settings-card d-flex align-items-center">
                    <i class="bi bi-clock-history settings-icon"></i>
                    <div>
                        <h5 class="mb-1">Account Activity</h5>
                        <p class="text-muted mb-0">Login history & activity logs</p>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>

</body>
</html>
