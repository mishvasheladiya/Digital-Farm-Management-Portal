<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Distributor') {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

$distributor_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'] ?? 0;

try {
    $sql = "INSERT INTO product_interests (product_id, distributor_id)
            VALUES (:product_id, :distributor_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':product_id' => $product_id,
        ':distributor_id' => $distributor_id
    ]);

    echo json_encode(['status' => 'success']);
} catch (PDOException $e) {
    // Duplicate interest
    echo json_encode(['status' => 'already']);
}
