<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "unauthorized"]);
    exit;
}

$user_id    = $_SESSION['user_id'];
$product_id = intval($_POST['product_id'] ?? 0);

if ($product_id <= 0) {
    echo json_encode(["status" => "error"]);
    exit;
}

/* Check if already in cart */
$check = $pdo->prepare("
    SELECT id FROM cart 
    WHERE user_id = ? AND product_id = ?
");
$check->execute([$user_id, $product_id]);

if ($check->rowCount() > 0) {
    echo json_encode(["status" => "exists"]);
    exit;
}

/* Insert */
$insert = $pdo->prepare("
    INSERT INTO cart (user_id, product_id, quantity)
    VALUES (?, ?, 1)
");
$insert->execute([$user_id, $product_id]);

echo json_encode(["status" => "success"]);
