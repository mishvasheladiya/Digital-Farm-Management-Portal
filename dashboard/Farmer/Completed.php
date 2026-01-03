<?php
// 1. Session Handling
require 'config.php'; 

if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}

// 2. Auth Check
if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php"); 
    exit;
}

$email = $_SESSION['email'];

// 3. Get Farmer ID with Error Catching
$stmt_f = mysqli_prepare($conn, "SELECT farmer_id FROM farmers WHERE email = ?");
mysqli_stmt_bind_param($stmt_f, "s", $email);
mysqli_stmt_execute($stmt_f);
$farmer_res = mysqli_stmt_get_result($stmt_f);
$farmer_data = mysqli_fetch_assoc($farmer_res);

if (!$farmer_data) {
    echo "<div style='padding:20px; background:#fee2e2; color:#b91c1c; font-family:sans-serif;'>";
    echo "<b>Farmer record not found!</b><br>";
    echo "Email in Session: " . htmlspecialchars($email) . "<br>";
    echo "Check your 'farmers' table to see if this email exists exactly.";
    echo "</div>";
    exit;
}
$farmer_id = $farmer_data['farmer_id'];

// 4. Fetch ONLY Completed Orders (FIXED: Combined first_name and last_name)
$query = "SELECT o.*, p.product_name, p.image_path, p.category, 
          CONCAT(d.first_name, ' ', d.last_name) as distributor_name
          FROM orders o
          JOIN products p ON o.product_id = p.id
          JOIN distributors d ON o.distributor_id = d.distributor_id
          WHERE o.farmer_id = ? AND o.status = 'Completed'
          ORDER BY o.created_at DESC";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $farmer_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed Orders - GreenAgro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<main class="max-w-6xl mx-auto px-6 py-12">
    <div class="flex justify-between items-end mb-10">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 uppercase tracking-tight">
                Order <span class="text-emerald-500 font-light">History</span>
            </h1>
            <p class="text-slate-500 mt-2">View all your successfully completed transactions.</p>
        </div>
        <a href="Tracking.php" class="text-sm font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-2">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Tracking
        </a>
    </div>

    <div class="space-y-6">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($order = mysqli_fetch_assoc($result)): 
                // Path handling: uses the image_path from products table
                $filename = basename($order['image_path']); 
                $img_url = "../../uploads/products/" . $filename; 
            ?>
            
            <div class="bg-white rounded-[2.5rem] p-6 shadow-sm border border-slate-100 flex flex-col md:flex-row items-center gap-6 hover:border-emerald-200 transition-colors">
                <div class="relative">
                    <img src="<?= $img_url ?>" 
                         onerror="this.src='https://placehold.co/200x200/ecfdf5/059669?text=Crop'" 
                         class="w-24 h-24 rounded-[2rem] object-cover border-2 border-white shadow-sm">
                    <div class="absolute -bottom-2 -right-2 bg-emerald-500 text-white p-1.5 rounded-full border-2 border-white">
                        <i data-lucide="check" class="w-4 h-4"></i>
                    </div>
                </div>

                <div class="flex-1 text-center md:text-left">
                    <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest"><?= htmlspecialchars($order['category']) ?></p>
                    <h3 class="font-bold text-slate-900 text-xl leading-tight"><?= htmlspecialchars($order['product_name']) ?></h3>
                    <div class="flex flex-wrap justify-center md:justify-start gap-x-6 gap-y-2 mt-2">
                        <div class="flex items-center gap-2 text-slate-400 text-xs">
                            <i data-lucide="user" class="w-3 h-3"></i>
                            <span>Buyer: <b class="text-slate-700"><?= htmlspecialchars($order['distributor_name']) ?></b></span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-400 text-xs">
                            <i data-lucide="calendar" class="w-3 h-3"></i>
                            <span>Completed: <b class="text-slate-700"><?= date('M d, Y', strtotime($order['created_at'])) ?></b></span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center md:items-end gap-3 border-t md:border-t-0 md:border-l border-slate-50 pt-4 md:pt-0 md:pl-8 min-w-[180px]">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Payout Received</p>
                    <p class="text-2xl font-black text-slate-900">₹<?= number_format($order['total_price'], 2) ?></p>
                    
                    <a href="view_receipt.php?order_id=<?= $order['order_id'] ?>" 
                       class="bg-slate-100 text-slate-600 hover:bg-emerald-500 hover:text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                        View Receipt
                    </a>
                </div>
            </div>

            <?php endwhile; ?>
        <?php else: ?>
            <div class="text-center py-20 bg-white rounded-[3rem] border border-dashed border-slate-200">
                <i data-lucide="history" class="w-12 h-12 text-slate-300 mx-auto mb-4"></i>
                <h3 class="text-xl font-bold text-slate-800">No completed orders yet</h3>
                <p class="text-slate-400 text-sm">Finish a crop lifecycle to see your records here.</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<script>lucide.createIcons();</script>
</body>
</html>