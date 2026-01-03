<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['product_id']);
    $action = $_POST['action'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if ($action === 'remove' || $action === 'wishlist') {
        // Remove from Cart
        if (($key = array_search($product_id, $_SESSION['cart'])) !== false) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index
        }

        // If 'wishlist', you could add logic to save to a DB or a wishlist session
        if ($action === 'wishlist') {
            if (!isset($_SESSION['wishlist'])) {
                $_SESSION['wishlist'] = [];
            }
            if (!in_array($product_id, $_SESSION['wishlist'])) {
                $_SESSION['wishlist'][] = $product_id;
            }
        }

        echo json_encode(['success' => true, 'message' => 'Cart updated']);
        exit;
    }
}

echo json_encode(['success' => false, 'message' => 'Invalid request']);