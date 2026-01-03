<?php
session_start();

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Initialize cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // If product is already in cart, increase quantity
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        // Otherwise, add it with a quantity of 1
        $_SESSION['cart'][$product_id] = 1;
    }

    // Redirect back to market with a success message
    header("Location: market.php?added=true");
    exit();
}