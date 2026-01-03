<?php
// functions.php

function createNotification($conn, $farmer_id, $title, $message, $type = 'info') {
    $sql = "INSERT INTO notifications (farmer_id, title, message, type) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "isss", $farmer_id, $title, $message, $type);
    return mysqli_stmt_execute($stmt);
}
?>