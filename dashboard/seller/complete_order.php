<?php
session_start();

/* ---------- DATABASE CONNECTION ---------- */
$conn = mysqli_connect("localhost", "root", "", "farm");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/* ---------- AUTH CHECK ---------- */
if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit;
}

/* ---------- HANDLE STATUS UPDATE ---------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id']) && isset($_POST['action'])) {
    
    $order_id = intval($_POST['order_id']);
    $action = $_POST['action'];
    $new_status = '';

    // Determine status based on the button clicked
    if ($action === 'complete') {
        $new_status = 'Completed';
    } elseif ($action === 'reject') {
        $new_status = 'Cancelled';
    } else {
        header("Location: Tracking.php?error=invalid_action");
        exit;
    }

    // Prepare the update statement
    $query = "UPDATE orders SET status = ? WHERE order_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "si", $new_status, $order_id);
        
        if (mysqli_stmt_execute($stmt)) {
            // Success: Redirect back to tracking with a success message
            header("Location: Tracking.php?msg=" . ($action === 'complete' ? 'success' : 'rejected'));
            exit;
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
} else {
    // If someone tries to access this file directly without POST
    header("Location: Tracking.php");
    exit;
}

mysqli_close($conn);
?>