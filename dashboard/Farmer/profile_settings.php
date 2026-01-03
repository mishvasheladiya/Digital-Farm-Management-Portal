<?php
$base_url = "/farm/";
require_once "../../components/db.php"; 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Auth Check
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$farmer_id = $_SESSION['user_id'];
$update_success = false;
$update_error = false;

// 2. Handle Profile Update (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $farm_name  = $_POST['farm_name'];
    $farm_type  = $_POST['farm_type'];
    $country    = $_POST['country'];
    $address    = $_POST['address'];
    $city       = $_POST['city'];
    $state      = $_POST['state'];
    $pincode    = $_POST['pincode'];
    $lat        = !empty($_POST['latitude']) ? $_POST['latitude'] : null;
    $lon        = !empty($_POST['longitude']) ? $_POST['longitude'] : null;
    $crops      = $_POST['main_crops'];
    $irrigation = $_POST['irrigation_method'];
    
    $weather_metrics = isset($_POST['weather_metrics']) ? implode(',', $_POST['weather_metrics']) : '';

    $sql_update = "UPDATE farmers SET 
                    first_name = ?, last_name = ?, email = ?, farm_name = ?, 
                    farming_type = ?, country = ?, address = ?, city = ?, 
                    state = ?, postal_code = ?, latitude = ?, longitude = ?, 
                    main_crops = ?, irrigation_method = ?, weather_metrics = ? 
                   WHERE farmer_id = ?";
    
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("sssssssssssssssi", 
        $first_name, $last_name, $email, $farm_name, 
        $farm_type, $country, $address, $city, 
        $state, $pincode, $lat, $lon, 
        $crops, $irrigation, $weather_metrics, $farmer_id
    );

    if ($stmt->execute()) {
        $update_success = true;

        /* ---------- TRIGGER NOTIFICATION MSG (NEW) ---------- */
        $notif_title = "Settings Updated";
        $notif_msg = "Your profile settings and farm preferences were successfully updated.";
        $notif_type = "info"; // Can be 'success', 'info', or 'warning'

        $notif_sql = "INSERT INTO notifications (farmer_id, title, message, type, is_read) VALUES (?, ?, ?, ?, 0)";
        $notif_stmt = $conn->prepare($notif_sql);
        $notif_stmt->bind_param("isss", $farmer_id, $notif_title, $notif_msg, $notif_type);
        $notif_stmt->execute();
        $notif_stmt->close();
        /* --------------------------------------------------- */

    } else {
        $update_error = true;
    }
}

// 3. Fetch Current Data (GET)
$sql_fetch = "SELECT * FROM farmers WHERE farmer_id = ?";
$stmt_fetch = $conn->prepare($sql_fetch);
$stmt_fetch->bind_param("i", $farmer_id);
$stmt_fetch->execute();
$user = $stmt_fetch->get_result()->fetch_assoc();

$user_metrics = explode(',', $user['weather_metrics'] ?? '');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings | GreenAgro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; font-family: 'Inter', sans-serif; }
        .card { border-radius: 15px; padding: 25px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .section-title { font-size: 28px; font-weight: 700; color: #1b4332; }
        .form-label { font-weight: 600; color: #2d6a4f; font-size: 0.9rem; }
        .btn-save { background: #2d6a4f; color: white; padding: 12px 30px; font-weight: 600; border-radius: 10px; transition: 0.3s; }
        .btn-save:hover { background: #1b4332; color: white; transform: translateY(-2px); }
        .form-control:focus, .form-select:focus { border-color: #52b788; box-shadow: 0 0 0 0.25rem rgba(82, 183, 136, 0.25); }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title">Profile Settings</h2>
        <a href="profile.php" class="btn btn-outline-secondary btn-sm rounded-pill">View Profile</a>
    </div>

    <?php if ($update_success): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert" style="background-color: #d1e7dd; color: #0f5132;">
            <i class="bi bi-check-circle-fill me-2"></i> <strong>Success!</strong> Your profile and a notification alert have been updated.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="card mb-4">
            <h5 class="mb-4 text-success"><i class="bi bi-person-circle me-2"></i>Personal Information</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($user['first_name'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($user['last_name'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <h5 class="mb-4 text-success"><i class="bi bi-house-door-fill me-2"></i>Farm Information</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Farm Name</label>
                    <input type="text" name="farm_name" class="form-control" value="<?= htmlspecialchars($user['farm_name'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Farming Type</label>
                    <select name="farm_type" class="form-select">
                        <option value="crop" <?= ($user['farming_type'] ?? '') =="crop"?"selected":"" ?>>Crop Only</option>
                        <option value="livestock" <?= ($user['farming_type'] ?? '') =="livestock"?"selected":"" ?>>Livestock Only</option>
                        <option value="both" <?= ($user['farming_type'] ?? '') =="both"?"selected":"" ?>>Both</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Country</label>
                    <input type="text" name="country" class="form-control" value="<?= htmlspecialchars($user['country'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($user['address'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">City</label>
                    <input type="text" name="city" class="form-control" value="<?= htmlspecialchars($user['city'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">State</label>
                    <input type="text" name="state" class="form-control" value="<?= htmlspecialchars($user['state'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Pincode</label>
                    <input type="text" name="pincode" class="form-control" value="<?= htmlspecialchars($user['postal_code'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Latitude</label>
                    <input type="text" name="latitude" class="form-control" value="<?= $user['latitude'] ?? '' ?>" placeholder="22.3039">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Longitude</label>
                    <input type="text" name="longitude" class="form-control" value="<?= $user['longitude'] ?? '' ?>" placeholder="70.8022">
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <h5 class="mb-4 text-success"><i class="bi bi-gear-fill me-2"></i>Preferences</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Main Crops</label>
                    <input type="text" name="main_crops" class="form-control" value="<?= htmlspecialchars($user['main_crops'] ?? '') ?>" placeholder="Ex: Wheat, Corn, Rice">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Irrigation Method</label>
                    <select name="irrigation_method" class="form-select">
                        <option value="rainfed" <?= ($user['irrigation_method'] ?? '') =="rainfed"?"selected":"" ?>>Rainfed</option>
                        <option value="drip" <?= ($user['irrigation_method'] ?? '') =="drip"?"selected":"" ?>>Drip Irrigation</option>
                        <option value="sprinkler" <?= ($user['irrigation_method'] ?? '') =="sprinkler"?"selected":"" ?>>Sprinkler</option>
                        <option value="flood" <?= ($user['irrigation_method'] ?? '') =="flood"?"selected":"" ?>>Flood Irrigation</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label d-block mb-2">Tracked Weather Metrics</label>
                    <div class="bg-light p-3 rounded">
                        <?php 
                        $available_metrics = ["temperature" => "Temperature", "rainfall" => "Rainfall", "soil_moisture" => "Soil Moisture"];
                        foreach ($available_metrics as $key => $label): 
                        ?>
                            <div class="form-check form-check-inline me-4">
                                <input class="form-check-input" type="checkbox" name="weather_metrics[]" value="<?= $key ?>" id="check_<?= $key ?>"
                                <?= in_array($key, $user_metrics) ? "checked" : "" ?>>
                                <label class="form-check-label" for="check_<?= $key ?>"><?= $label ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-save shadow">Save All Changes</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>