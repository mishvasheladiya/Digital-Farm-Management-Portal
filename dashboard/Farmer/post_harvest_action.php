<?php
session_start();

/* ---------------- DATABASE CONNECTION ---------------- */
$conn = mysqli_connect("localhost", "root", "", "farm");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

/* ---------------- AUTH CHECK ---------------- */
// Check for farmer_id
if (!isset($_SESSION['farmer_id'])) {
    die("Unauthorized access. Please login again.");
}

$farmer_id = $_SESSION['farmer_id'];

/* ---------------- FORM METHOD CHECK ---------------- */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../Admin/product.php");
    exit;
}

/* ---------------- SANITIZE FUNCTION ---------------- */
function clean($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/* ---------------- FETCH & CLEAN INPUT ---------------- */
$category      = clean($_POST['category'] ?? '');
$product_name  = clean($_POST['variety_name'] ?? '');
$price         = clean($_POST['price'] ?? 0);
$farmer_name   = clean($_POST['farmer_name'] ?? '');
$email         = clean($_POST['email'] ?? '');
$phone         = clean($_POST['phone'] ?? '');
$address       = clean($_POST['address'] ?? '');
$stock         = clean($_POST['stock'] ?? 0);
$harvest_date  = clean($_POST['harvest_date'] ?? '');

/* ---------------- IMAGE UPLOAD ---------------- */
$file_path = "";
if (isset($_FILES['crop_image']) && $_FILES['crop_image']['error'] === 0) {
    // Save inside Farmer/uploads/products/
    $upload_dir = "uploads/products/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_ext  = pathinfo($_FILES['crop_image']['name'], PATHINFO_EXTENSION);
    $file_name = "product_" . time() . "_" . rand(1000, 9999) . "." . $file_ext;
    $file_path = $upload_dir . $file_name;

    move_uploaded_file($_FILES['crop_image']['tmp_name'], $file_path);
}

/* ---------------- INSERT INTO PRODUCTS DATABASE ---------------- */
$sql = "INSERT INTO products 
        (farmer_id, name, email, mobile, category, product_name, price, farm_location, harvest_date, stock_quantity, image_path) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "isssssdsiss", 
    $farmer_id, $farmer_name, $email, $phone, $category, 
    $product_name, $price, $address, $harvest_date, $stock, $file_path
);

if (mysqli_stmt_execute($stmt)) {
    
    /* 1. NOTIFICATION FOR FARMER (Database) */
    $f_notif_sql = "INSERT INTO notifications (farmer_id, title, message, is_read, created_at) VALUES (?, 'Product Added', ?, 0, NOW())";
    $f_msg = "Successfully added $product_name to your catalog.";
    $f_stmt = mysqli_prepare($conn, $f_notif_sql);
    mysqli_stmt_bind_param($f_stmt, "is", $farmer_id, $f_msg);
    mysqli_stmt_execute($f_stmt);

    /* 2. NOTIFICATION FOR ADMIN (Database) */
    // Using farmer_id = 0 to represent Admin system alerts
    $a_notif_sql = "INSERT INTO notifications (farmer_id, title, message, is_read, created_at) VALUES (0, 'New Inventory Alert', ?, 0, NOW())";
    $a_msg = "Farmer $farmer_name just added $product_name ($stock KG).";
    $a_stmt = mysqli_prepare($conn, $a_notif_sql);
    mysqli_stmt_bind_param($a_stmt, "s", $a_msg);
    mysqli_stmt_execute($a_stmt);

    /* ---------------- SUCCESS REDIRECT ---------------- */
    // Redirecting from Farmer folder to Admin folder
    header("Location: post_harvest_success.php?msg=success");
    exit;

} else {
    header("Location: product.php?msg=error");
    exit;
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>