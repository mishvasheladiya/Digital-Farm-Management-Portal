<?php
// handle_security.php
require_once "config.php"; 
session_start();

// Set header for JSON response
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$user_id = $_SESSION['user_id'];

// Get the JSON data from the request
$input = file_get_contents('php://input');
$data = json_decode($input, true);
$action = $data['action'] ?? '';

// --- ACTION: UPDATE SETTINGS (2FA / ALERTS) ---
if ($action === 'update_setting') {
    $type = $data['type']; // '2fa' or 'alerts'
    $value = $data['value'] ? 1 : 0;
    
    // Determine which column to update based on the type
    $column = ($type === '2fa') ? 'two_fa' : 'login_alerts';
    
    $stmt = $conn->prepare("UPDATE farmers SET $column = ? WHERE farmer_id = ?");
    $stmt->bind_param("ii", $value, $user_id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
}

// --- ACTION: REVOKE SINGLE DEVICE ---
if ($action === 'revoke_device') {
    $id = intval($data['id']);
    
    // Ensure the session belongs to the logged-in user for security
    $stmt = $conn->prepare("DELETE FROM user_sessions WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

// --- ACTION: LOGOUT ALL OTHER DEVICES ---
if ($action === 'logout_all') {
    $current_sid = session_id();
    
    // Delete all sessions for this user EXCEPT the current one
    $stmt = $conn->prepare("DELETE FROM user_sessions WHERE user_id = ? AND session_id != ?");
    $stmt->bind_param("is", $user_id, $current_sid);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>