<?php 
$base_url = "/farm/";
session_start();

// Example values – replace with your database fetch values
$user = [
    "first_name" => "Mishva",
    "last_name" => "Sheladiya",
    "email" => "mishva@example.com",
    "farm_name" => "Green Valley Farm",
    "farm_type" => "Crop",
    "country" => "India",
    "address" => "Main Street, Rajkot",
    "city" => "Rajkot",
    "state" => "Gujarat",
    "pincode" => "360001",
    "latitude" => "22.3039",
    "longitude" => "70.8022",
    "main_crops" => "Wheat, Corn",
    "irrigation" => "Drip Irrigation",
    "weather_metrics" => ["Temperature", "Rainfall"]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile Settings</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
body { background: #f4f6f9; }
.card {
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}
.section-title {
    font-size: 32px;
    font-weight: 700;
    color: #2f6e3f; 
}
.form-label { font-weight: 600; color: #2f6e3f; }
.btn-save {
    background: #2f6e3f;
    color: white;
    padding: 10px 25px;
    font-weight: 600;
}
</style>
</head>

<body>
<?php include 'header.php'; ?>

<div class="container py-5">
<h2 class="section-title mb-4">Profile Settings</h2>

<form action="update_profile.php" method="POST">
<div class="card mb-4">
    <h4 class="mb-3 text-success">Personal Information</h4>

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" value="<?= $user['first_name'] ?>">
        </div>

        <div class="col-md-6">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" value="<?= $user['last_name'] ?>">
        </div>

        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>">
        </div>
    </div>
</div>

<div class="card mb-4">
    <h4 class="mb-3 text-success">Farm Information</h4>

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Farm Name</label>
            <input type="text" name="farm_name" class="form-control" value="<?= $user['farm_name'] ?>">
        </div>

        <div class="col-md-6">
            <label class="form-label">Farming Type</label>
            <select name="farm_type" class="form-select">
                <option <?= $user['farm_type']=="Crop"?"selected":"" ?>>Crop</option>
                <option <?= $user['farm_type']=="Livestock"?"selected":"" ?>>Livestock</option>
                <option <?= $user['farm_type']=="Both"?"selected":"" ?>>Both</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Country</label>
            <input type="text" name="country" class="form-control" value="<?= $user['country'] ?>">
        </div>

        <div class="col-md-6">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" value="<?= $user['address'] ?>">
        </div>

        <div class="col-md-6">
            <label class="form-label">City</label>
            <input type="text" name="city" class="form-control" value="<?= $user['city'] ?>">
        </div>

        <div class="col-md-6">
            <label class="form-label">State</label>
            <input type="text" name="state" class="form-control" value="<?= $user['state'] ?>">
        </div>

        <div class="col-md-4">
            <label class="form-label">Pincode</label>
            <input type="text" name="pincode" class="form-control" value="<?= $user['pincode'] ?>">
        </div>

        <div class="col-md-4">
            <label class="form-label">Latitude</label>
            <input type="text" name="latitude" class="form-control" value="<?= $user['latitude'] ?>">
        </div>

        <div class="col-md-4">
            <label class="form-label">Longitude</label>
            <input type="text" name="longitude" class="form-control" value="<?= $user['longitude'] ?>">
        </div>
    </div>
</div>

<div class="card mb-4">
    <h4 class="mb-3 text-success">Preferences</h4>

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Main Crops</label>
            <input type="text" name="main_crops" class="form-control" value="<?= $user['main_crops'] ?>" placeholder="Ex: Wheat, Corn, Rice">
        </div>

        <div class="col-md-6">
            <label class="form-label">Irrigation Method</label>
            <input type="text" name="irrigation" class="form-control" value="<?= $user['irrigation'] ?>">
        </div>

        <div class="col-md-12">
            <label class="form-label">Weather Metrics</label><br>

            <?php 
            $metrics = ["Temperature", "Rainfall", "Soil Moisture"];
            foreach ($metrics as $m): 
            ?>
                <label class="me-3">
                    <input type="checkbox" name="weather_metrics[]" value="<?= $m ?>"
                    <?= in_array($m, $user['weather_metrics']) ? "checked" : "" ?>> <?= $m ?>
                </label>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-save">Save Changes</button>

</form>
</div>

</body>
</html>
