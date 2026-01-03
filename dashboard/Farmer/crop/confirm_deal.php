<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "farm");
if (!$conn) die("DB Error");

/* ---------- 2. INPUT ---------- */
$dist_id = intval($_GET['dist_id']);
$prod_id = intval($_GET['prod_id']);

/* ---------- 3. GET PRODUCT DETAILS ---------- */
// We need name and quantity for the notification and total price
$q = "SELECT farmer_id, product_name, price, stock_quantity, category FROM products WHERE id=?";
$stmt = mysqli_prepare($conn, $q);
mysqli_stmt_bind_param($stmt, "i", $prod_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($res);

if (!$product) { die("Product not found"); }

/* ---------- 4. PREVENT DUPLICATE ORDER ---------- */
$check = mysqli_prepare($conn, "SELECT order_id FROM orders WHERE product_id=?");
mysqli_stmt_bind_param($check, "i", $prod_id);
mysqli_stmt_execute($check);
if (mysqli_num_rows(mysqli_stmt_get_result($check)) > 0) {
    header("Location: ".strtolower($product['category']).".php?error=already_confirmed");
    exit;
}

/* ---------- 5. INSERT ORDER ---------- */
$total_price = $product['price'] * $product['stock_quantity'];
$insert_order = "INSERT INTO orders (product_id, farmer_id, distributor_id, quantity, price, total_price, status)
                 VALUES (?, ?, ?, ?, ?, ?, 'Confirmed')";

$stmt2 = mysqli_prepare($conn, $insert_order);
mysqli_stmt_bind_param($stmt2, "iiiidd", 
    $prod_id, 
    $product['farmer_id'], 
    $dist_id, 
    $product['stock_quantity'], 
    $product['price'], 
    $total_price
);
mysqli_stmt_execute($stmt2);

/* ---------- 6. INSERT NOTIFICATION ---------- */
$notif_title = "Deal Confirmed! 🎉";
$notif_msg = "You have successfully confirmed the deal for " . $product['product_name'] . ". Total value: ₹" . number_format($total_price, 2);
$notif_sql = "INSERT INTO notifications (farmer_id, title, message, type) VALUES (?, ?, ?, 'success')";
$stmt_notif = mysqli_prepare($conn, $notif_sql);
mysqli_stmt_bind_param($stmt_notif, "iss", $product['farmer_id'], $notif_title, $notif_msg);
mysqli_stmt_execute($stmt_notif);

/* ---------- 7. REMOVE INTERESTS ---------- */
$del = mysqli_prepare($conn, "DELETE FROM product_interests WHERE product_id=?");
mysqli_stmt_bind_param($del, "i", $prod_id);
mysqli_stmt_execute($del);

/* ---------- 8. REDIRECT ---------- */
$category = strtolower($product['category']);
header("Location: {$category}.php?success=confirmed");
exit;
?>