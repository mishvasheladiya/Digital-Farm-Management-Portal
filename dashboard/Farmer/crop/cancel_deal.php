<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "farm");
if (!$conn) die("DB Error");


/* ---------- INPUT ---------- */
$order_id = intval($_GET['order_id']);

/* ---------- CANCEL ORDER ---------- */
$update = "UPDATE orders SET status='Cancelled' WHERE order_id=?";
$stmt = mysqli_prepare($conn, $update);
mysqli_stmt_bind_param($stmt, "i", $order_id);
mysqli_stmt_execute($stmt);

/* ---------- REDIRECT ---------- */
header("Location: tracking.php?success=cancelled");
exit;
