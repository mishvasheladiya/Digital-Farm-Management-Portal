<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mode Settings</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }
        .settings-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0px 4px 18px rgba(0,0,0,0.08);
            transition: .2s;
        }

        .settings-card:hover {
            transform: translateY(-2px);
            box-shadow: 0px 6px 22px rgba(0,0,0,0.12);
        }

        .mode-icon {
            font-size: 45px;
            padding: 18px;
            border-radius: 14px;
            color: white;
        }

        .light { background: #ffc107; }
        .dark { background: #0d6efd; }
        .auto { background: #20c997; }

        .page-title {
            font-size: 26px;
            font-weight: 700;
        }

        .section-title {
            font-size: 22px;
            font-weight: 600;
            margin-top: 50px;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<div class="container py-5">

    <h2 class="page-title mb-4"><i class="bi bi-palette me-2"></i>App Mode Settings</h2>

    <p class="text-muted mb-5">
        Choose how you want your application theme to look. You can select Light, Dark, or Auto mode.
    </p>

    <div class="row g-4">

        <!-- LIGHT MODE -->
        <div class="col-md-4">
            <div class="settings-card">
                <div class="d-flex align-items-center mb-3">
                    <div class="mode-icon light">
                        <i class="bi bi-brightness-high"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0">Light Mode</h5>
                        <small class="text-muted">Bright and clear interface</small>
                    </div>
                </div>
                <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" id="lightMode">
                    <label class="form-check-label" for="lightMode">Enable Light Mode</label>
                </div>
            </div>
        </div>

        <!-- DARK MODE -->
        <div class="col-md-4">
            <div class="settings-card">
                <div class="d-flex align-items-center mb-3">
                    <div class="mode-icon dark">
                        <i class="bi bi-moon"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0">Dark Mode</h5>
                        <small class="text-muted">Soft on the eyes</small>
                    </div>
                </div>
                <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" id="darkMode">
                    <label class="form-check-label" for="darkMode">Enable Dark Mode</label>
                </div>
            </div>
        </div>

        <!-- AUTO MODE -->
        <div class="col-md-4">
            <div class="settings-card">
                <div class="d-flex align-items-center mb-3">
                    <div class="mode-icon auto">
                        <i class="bi bi-circle-half"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0">Automatic Mode</h5>
                        <small class="text-muted">Follows system settings</small>
                    </div>
                </div>
                <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" id="autoMode">
                    <label class="form-check-label" for="autoMode">Enable Auto Mode</label>
                </div>
            </div>
        </div>

    </div>


    <!-- NEW SECTION BELOW -->
    <h3 class="section-title"><i class="bi bi-sliders me-2"></i>Advanced Display Preferences</h3>
    <div class="row g-4 mt-1">

        <!-- COLOR ACCENT -->
        <div class="col-md-6">
            <div class="settings-card">
                <h5><i class="bi bi-droplet-half me-2"></i>Theme Accent Color</h5>
                <p class="text-muted mb-3">Choose your preferred theme color.</p>

                <div class="d-flex gap-3">
                    <button class="btn rounded-circle" style="width:40px;height:40px;background:#0d6efd"></button>
                    <button class="btn rounded-circle" style="width:40px;height:40px;background:#198754"></button>
                    <button class="btn rounded-circle" style="width:40px;height:40px;background:#dc3545"></button>
                    <button class="btn rounded-circle" style="width:40px;height:40px;background:#fd7e14"></button>
                </div>
            </div>
        </div>

        <!-- FONT SIZE -->
        <div class="col-md-6">
            <div class="settings-card">
                <h5><i class="bi bi-text-paragraph me-2"></i>Font Size</h5>
                <p class="text-muted mb-2">Adjust text size for better readability.</p>

                <select class="form-select">
                    <option>Default</option>
                    <option>Small</option>
                    <option>Large</option>
                    <option>Extra Large</option>
                </select>
            </div>
        </div>

        <!-- HIGH CONTRAST -->
        <div class="col-md-6">
            <div class="settings-card">
                <h5><i class="bi bi-eye me-2"></i>High Contrast Mode</h5>
                <p class="text-muted mb-2">Better visibility for low-vision users.</p>

                <div class="form-check form-switch mt-2">
                    <input class="form-check-input" type="checkbox" id="highContrast">
                    <label class="form-check-label" for="highContrast">Enable High Contrast</label>
                </div>
            </div>
        </div>

        <!-- ANIMATIONS -->
        <div class="col-md-6">
            <div class="settings-card">
                <h5><i class="bi bi-magic me-2"></i>UI Animations</h5>
                <p class="text-muted mb-2">Control interface animations.</p>

                <div class="form-check form-switch mt-2">
                    <input class="form-check-input" type="checkbox" id="animations">
                    <label class="form-check-label" for="animations">Enable Animations</label>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>
