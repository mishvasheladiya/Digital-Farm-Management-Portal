<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Common Fields
    $seller_type = $_POST['seller_type'];
    $first_name  = $_POST['firstname'];
    $last_name   = $_POST['lastname'];
    $mobile      = $_POST['mobile'];
    $email       = $_POST['email'];
    $password    = $_POST['password'];

    /* ---------------- FARMER REGISTRATION ---------------- */
    if ($seller_type === "Farmer") {

        $farm_name        = $_POST['farm-name'] ?? null;
        $farming_type     = $_POST['farming-type'] ?? 'both';
        $country          = $_POST['country'] ?? 'India';
        $address          = $_POST['address'] ?? null;
        $city             = $_POST['city'] ?? null;
        $state            = $_POST['state-province'] ?? null;
        $postal_code      = $_POST['postal-code'] ?? null;
        $latitude         = $_POST['latitude'] ?? null;
        $longitude        = $_POST['longitude'] ?? null;
        $main_crops       = $_POST['main-crops'] ?? null;
        $irrigation       = $_POST['irrigation-method'] ?? null;
        $weather_metrics  = isset($_POST['weather-metrics'])
                            ? implode(',', $_POST['weather-metrics'])
                            : null;

        $sql = "INSERT INTO farmers 
        (first_name, last_name, mobile, email, password,
         farm_name, farming_type, country, address, city, state,
         postal_code, latitude, longitude, main_crops, irrigation_method, weather_metrics)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssssssssssssssss",
            $first_name, $last_name, $mobile, $email, $password,
            $farm_name, $farming_type, $country, $address, $city, $state,
            $postal_code, $latitude, $longitude, $main_crops, $irrigation, $weather_metrics
        );
    }

    /* ---------------- DISTRIBUTOR REGISTRATION ---------------- */
    elseif ($seller_type === "Distributor") {

        $company_name = $_POST['company-name'];
        $business_id  = $_POST['business-id'] ?? null;
        $country      = $_POST['d-country'] ?? 'India';
        $address      = $_POST['d-address'] ?? null;
        $city         = $_POST['d-city'] ?? null;
        $state        = $_POST['d-state-province'] ?? null;
        $postal_code  = $_POST['d-postal-code'] ?? null;
        $service_area = $_POST['service-area'] ?? null;
        $products     = $_POST['products'] ?? null;
        $min_order    = $_POST['min-order'] ?? null;

        $sql = "INSERT INTO distributors
        (first_name, last_name, mobile, email, password,
         company_name, business_id, country, address, city, state,
         postal_code, service_area, products, min_order)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssssssssssd",
            $first_name, $last_name, $mobile, $email, $password,
            $company_name, $business_id, $country, $address, $city, $state,
            $postal_code, $service_area, $products, $min_order
        );
    } 
    else {
        echo "Invalid Seller Type";
        exit;
    }

    /* ---------------- EXECUTE & NOTIFY ---------------- */
    if ($stmt->execute()) {
        // Get the ID of the person who just registered
        $new_user_id = $stmt->insert_id;

        // Prepare Welcome Notification
        $notif_title = "Welcome to GreenAgro!";
        $notif_msg = "Hello $first_name! Your account has been created. Start exploring your dashboard.";
        
        // Insert into notifications table
        // Note: Ensure your notifications table has farmer_id or a generic user_id column
        $notif_sql = "INSERT INTO notifications (farmer_id, title, message, is_read) VALUES (?, ?, ?, 0)";
        $notif_stmt = $conn->prepare($notif_sql);
        $notif_stmt->bind_param("iss", $new_user_id, $notif_title, $notif_msg);
        $notif_stmt->execute();
        $notif_stmt->close();

        echo "
        <script>
            alert('Account created successfully');
            window.location.href = 'login.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Registration failed: {$stmt->error}');
            window.history.back();
        </script>
        ";
    }

    $stmt->close();
    $conn->close();
}
?>