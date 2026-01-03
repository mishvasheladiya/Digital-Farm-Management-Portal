<?php
include 'config.php'; 

if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit;
}

$farmer_id = $_SESSION['farmer_id'];

// --- 1. HANDLE AJAX TOGGLE REQUEST ---
if (isset($_POST['toggle_email'])) {
    $status = $_POST['status']; 
    // FIXED: Changed 'id' to 'farmer_id'
    $update = $conn->prepare("UPDATE farmers SET email_notif_enabled = ? WHERE farmer_id = ?");
    $update->bind_param("ii", $status, $farmer_id);
    $update->execute();
    exit; 
}

// --- 2. FETCH CURRENT USER PREFERENCES ---
// FIXED: Changed 'id' to 'farmer_id'
$pref_query = $conn->prepare("SELECT email_notif_enabled FROM farmers WHERE farmer_id = ?");
$pref_query->bind_param("i", $farmer_id);
$pref_query->execute();
$pref_res = $pref_query->get_result()->fetch_assoc();
$is_enabled = $pref_res['email_notif_enabled'] ?? 1;

// --- 3. FETCH NOTIFICATIONS ---
if ($is_enabled == 1) {
    // This looks for 'farmer_id' in the 'notifications' table (which is correct based on your SQL)
    $query = "SELECT * FROM notifications WHERE farmer_id = ? ORDER BY created_at DESC LIMIT 10";
} else {
    $query = "SELECT * FROM notifications WHERE 1=0"; 
}

$stmt = $conn->prepare($query);
if ($is_enabled == 1) $stmt->bind_param("i", $farmer_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notification Settings & History</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body { background: #f1f7f0; font-family: 'Poppins', sans-serif; }
    .page-title { font-size: 32px; font-weight: 700; color: #2d6a4f; }
    .notify-card {
        background: white; padding: 25px; border-radius: 18px;
        border: 1px solid #d9e9d8; transition: 0.3s;
        box-shadow: 0 5px 18px rgba(0, 0, 0, 0.05); height: 100%;
    }
    .notify-icon {
        width: 50px; height: 50px; border-radius: 12px;
        background: #e8f8ea; display: flex; align-items: center;
        justify-content: center; font-size: 22px; color: #1b8a5a;
    }
    .mute-box { background: #ffe8e8; padding: 15px; border-radius: 14px; border: 1px solid #ffbcbc; }
    
    /* Notification Item Styles */
    .notif-item {
        background: white; border-radius: 15px; padding: 15px;
        margin-bottom: 12px; border-left: 5px solid #059669;
        transition: 0.2s;
    }
    .notif-item.unread { border-left-color: #3b82f6; background: #f0f7ff; }
    .notif-time { font-size: 12px; color: #888; }
</style>
</head>

<body>
<?php include 'header.php'; ?>

<div class="container py-5">
    <h2 class="page-title mb-2">
        <i class="fa-solid fa-bell"></i> Notifications
    </h2>
    <p class="text-muted mb-4">Manage alerts and view your recent activity.</p>

    <div class="row">
        <div class="col-lg-4">
            <h5 class="section-label mb-3">Preferences</h5>
            
            <div class="mute-box mb-4 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold text-danger mb-0"><i class="fa-solid fa-bell-slash"></i> Mute All</h6>
                <div class="form-check form-switch"><input class="form-check-input" type="checkbox"></div>
            </div>

            <div class="space-y-3">
                <div class="notify-card mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="notify-icon"><i class="fa-solid fa-envelope"></i></div>
                        <div><h6 class="mb-0">Email Alerts</h6><small class="text-muted">Status updates</small></div>
                        <div class="form-check form-switch ms-auto"><input class="form-check-input" type="checkbox" checked></div>
                    </div>
                </div>
                
                <div class="notify-card mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="notify-icon"><i class="fa-solid fa-message"></i></div>
                        <div><h6 class="mb-0">SMS Alerts</h6><small class="text-muted">Direct to phone</small></div>
                        <div class="form-check form-switch ms-auto"><input class="form-check-input" type="checkbox"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <h5 class="section-label mb-3">Recent Alerts</h5>
            <div class="notif-container">
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <div class="notif-item <?php echo $row['is_read'] == 0 ? 'unread' : ''; ?> shadow-sm">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark"><?php echo htmlspecialchars($row['title']); ?></h6>
                                    <p class="mb-1 text-muted small"><?php echo htmlspecialchars($row['message']); ?></p>
                                    <span class="notif-time">
                                        <i class="bi bi-clock me-1"></i>
                                        <?php echo date('M d, h:i A', strtotime($row['created_at'])); ?>
                                    </span>
                                </div>
                                <?php if($row['is_read'] == 0): ?>
                                    <span class="badge bg-primary rounded-pill">New</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="text-center py-5 bg-white rounded-4 border">
                        <i class="bi bi-bell-slash display-4 text-muted"></i>
                        <p class="mt-3 text-muted">No notifications yet.</p>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($result->num_rows > 0): ?>
                <div class="text-center mt-4">
                    <button class="btn btn-outline-success btn-sm rounded-pill px-4">Clear All Notifications</button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>