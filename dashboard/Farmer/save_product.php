<?php
require_once 'config.php';

/* --------------------------------
   SECURITY: Check Login
-------------------------------- */
if (!isset($_SESSION['farmer_id'])) {
    die("Unauthorized access");
}

$farmer_id = $_SESSION['farmer_id'];

/* --------------------------------
   Get Form Data
-------------------------------- */
$category       = $_POST['category'] ?? '';
$product_name   = $_POST['product_name'] ?? '';
$price          = $_POST['price'] ?? 0;
$farm_location  = $_POST['farm_location'] ?? '';
$harvest_date   = $_POST['harvest_date'] ?? null;
$stock_quantity = $_POST['stock_quantity'] ?? 0;

/* --------------------------------
   Image Upload
-------------------------------- */
$image_path = null;

if (!empty($_FILES['product_image']['name'])) {
    $upload_dir = "uploads/products/";

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_name = time() . "_" . basename($_FILES['product_image']['name']);
    $target_file = $upload_dir . $file_name;

    $image_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'webp'];

    if (!in_array($image_type, $allowed)) {
        die("Invalid image format");
    }

    if (!move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
        die("Image upload failed");
    }

    $image_path = $target_file;
}

/* --------------------------------
   Insert Into Products Table
-------------------------------- */
$sql = "INSERT INTO products 
        (farmer_id, category, product_name, price, farm_location, harvest_date, stock_quantity, image_path)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "issdssis",
    $farmer_id,
    $category,
    $product_name,
    $price,
    $farm_location,
    $harvest_date,
    $stock_quantity,
    $image_path
);

if (mysqli_stmt_execute($stmt)) {
    header("Location: dashboard.php?success=1");
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
