<?php
session_start();
require 'config.php'; // Ensure this uses $conn = new mysqli(...)

// 1. Handle Status Update Logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];
    
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
    $stmt->bind_param("si", $new_status, $order_id);
    $stmt->execute();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// 2. Fetch Real Orders with Farmer Email
// Note: We join with the farmers table to get the 'email' column
$sql = "SELECT o.*, p.product_name, p.category, f.email as farmer_email
        FROM orders o
        LEFT JOIN products p ON o.product_id = p.id
        LEFT JOIN farmers f ON o.farmer_id = f.farmer_id
        ORDER BY o.created_at DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Farmer Orders - Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background: linear-gradient(135deg, #eef2f3, #dfe9f3);
        font-family: "Poppins", sans-serif;
        margin: 0 !important;
        padding: 0 !important;
    }

    .container-full {
        width: 100% !important;
        max-width: 100% !important;
    }

    .inner-section { padding: 20px 40px; }

    .page-title {
        font-size: 30px;
        font-weight: 700;
        color: #222;
        letter-spacing: .5px;
        margin-top: 5px;
    }

    .search-box {
        border-radius: 18px;
        border: none;
        padding: 15px 20px;
        font-size: 16px;
        box-shadow: 0 4px 18px rgba(0,0,0,0.08);
    }

    .order-card {
        padding: 25px;
        border-radius: 25px;
        background: rgba(255,255,255,0.75);
        backdrop-filter: blur(10px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        transition: .35s;
        border: 1px solid rgba(255,255,255,0.4);
    }

    .order-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.2);
    }

    .icon-box {
        width: 70px;
        height: 70px;
        border-radius: 18px;
        background: linear-gradient(135deg, #7dd56f, #28a745);
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .icon-box i { color: #fff; font-size: 32px; }

    /* Original Chip Colors */
    .chip {
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        display: inline-block;
    }

    .confirmed, .pending { background: #ffecb5; color: #664d03; }
    .completed { background: #d1e7dd; color: #0f5132; }
    .cancelled { background: #f8d7da; color: #842029; }

    .tag {
        background: #e7f1ff;
        padding: 5px 12px;
        border-radius: 30px;
        font-size: 13px;
        color: #0b5ed7;
        font-weight: 500;
        margin-right: 6px;
    }

    .top-controls button {
        border-radius: 12px;
        font-weight: 500;
        padding: 10px 18px;
    }

    .status-dropdown {
        border: 1px solid rgba(0,0,0,0.1);
        border-radius: 8px;
        font-size: 12px;
        padding: 4px;
        background: white;
    }
</style>

</head>
<body>

<div class="container-full">
<?php include 'header.php'; ?>

<div class="inner-section">

    <h2 class="page-title mb-4">Farmer Orders</h2>

    <input type="text" id="orderSearch" class="form-control search-box mb-4" placeholder="🔍 Search by Email, Product, or Order ID">

    <div class="mb-4 top-controls">
        <button class="btn btn-dark me-2" onclick="filterCards('all')">All Orders</button>
        <button class="btn btn-success me-2" onclick="filterCards('completed')">Completed</button>
        <button class="btn btn-warning me-2" onclick="filterCards('confirmed')">Confirmed</button>
        <button class="btn btn-danger" onclick="filterCards('cancelled')">Cancelled</button>
    </div>

    <div class="row gy-4" id="orderContainer">

        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): 
                $statusClass = strtolower($row['status']);
            ?>
            <div class="col-md-6 order-card-wrapper" data-status="<?php echo $statusClass; ?>">
                <div class="order-card">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <div class="icon-box me-3">
                                <i class="bi bi-basket-fill"></i>
                            </div>

                            <div>
                                <h5 class="fw-bold mb-1">Order #<?php echo $row['order_id']; ?></h5>
                                <p class="text-muted mb-1">Farmer: <strong><?php echo htmlspecialchars($row['farmer_email'] ?? 'ID: '.$row['farmer_id']); ?></strong></p>

                                <span class="tag"><?php echo htmlspecialchars($row['product_name'] ?? 'General Product'); ?></span>
                                <span class="tag"><?php echo htmlspecialchars($row['category'] ?? 'Crop'); ?></span>
                            </div>
                        </div>
                        
                        <form method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                            <select name="status" class="status-dropdown" onchange="this.form.submit()">
                                <option value="Confirmed" <?php if($row['status'] == 'Confirmed') echo 'selected'; ?>>Confirmed</option>
                                <option value="Completed" <?php if($row['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                                <option value="Cancelled" <?php if($row['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                            </select>
                            <input type="hidden" name="update_status" value="1">
                        </form>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold fs-5">₹ <?php echo number_format($row['total_price'], 2); ?></span>
                        <span class="chip <?php echo $statusClass; ?>">
                            <?php echo $row['status']; ?>
                        </span>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <p class="text-muted">No orders found.</p>
            </div>
        <?php endif; ?>

    </div>
</div>
</div>

<script>
    // Real-time Search
    document.getElementById('orderSearch').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        document.querySelectorAll('.order-card-wrapper').forEach(card => {
            card.style.display = card.textContent.toLowerCase().includes(filter) ? '' : 'none';
        });
    });

    // Quick Filters
    function filterCards(status) {
        document.querySelectorAll('.order-card-wrapper').forEach(card => {
            card.style.display = (status === 'all' || card.getAttribute('data-status') === status) ? '' : 'none';
        });
    }
</script>

</body>
</html>