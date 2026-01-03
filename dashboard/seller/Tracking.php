<?php
session_start();

/* ---------- DATABASE CONNECTION ---------- */
$conn = mysqli_connect("localhost", "root", "", "farm");
if (!$conn) die("DB Error: " . mysqli_connect_error());

/* ---------- AUTH CHECK ---------- */
if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit;
}

$email = $_SESSION['email'];

/* ---------- GET DISTRIBUTOR ID ---------- */
$stmt_d = mysqli_prepare($conn, "SELECT distributor_id FROM distributors WHERE email = ?");
mysqli_stmt_bind_param($stmt_d, "s", $email);
mysqli_stmt_execute($stmt_d);
$dist_res = mysqli_stmt_get_result($stmt_d);
$dist_data = mysqli_fetch_assoc($dist_res);

if (!$dist_data) {
    die("Distributor record not found.");
}
$dist_id = $dist_data['distributor_id'];

/* ---------- FETCH ORDERS FOR THIS DISTRIBUTOR ---------- */
$query = "SELECT 
            o.order_id, o.status as order_status, o.created_at,
            p.id as product_id, p.product_name, p.category, p.image_path,
            f.first_name as farmer_name
          FROM orders o
          JOIN products p ON o.product_id = p.id
          JOIN farmers f ON o.farmer_id = f.farmer_id
          WHERE o.distributor_id = ?
          ORDER BY o.created_at DESC";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $dist_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Purchase Tracking - GreenAgro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .step-container { position: relative; flex: 1; display: flex; flex-direction: column; align-items: center; }
        .step-line { position: absolute; top: 20px; left: 50%; width: 100%; height: 3px; background: #e2e8f0; z-index: 1; }
        .step-active .step-line { background: #10b981; }
        .step-error .step-line { background: #f43f5e; }
        .step-icon { position: relative; z-index: 10; }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<main class="max-w-6xl mx-auto px-6 py-12">
    <div class="mb-10">
        <h1 class="text-3xl font-extrabold text-slate-900 uppercase tracking-tight">
            Order <span class="text-emerald-500 font-light">Journey</span>
        </h1>
        <p class="text-slate-500 mt-2">Monitor your active purchases and manage order status.</p>
    </div>

    <div class="space-y-8">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($item = mysqli_fetch_assoc($result)): 
                // LOGIC FOR TRACKING STEPS
                $status = $item['order_status'];
                $is_cancelled = ($status == 'Cancelled');
                
                $step1 = true; // Order Placed (Always true if it exists)
                $step2 = ($status == 'Confirmed' || $status == 'Completed'); 
                $step3 = ($status == 'Completed'); 
                
                // Image Handling
                $img_url = "../Farmer/" . $item['image_path'];
            ?>
            
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    
                    <div class="w-full md:w-1/4 flex items-center gap-5 border-b md:border-b-0 md:border-r border-slate-100 pb-4 md:pb-0">
                        <img src="<?= $img_url ?>" 
                             onerror="this.src='https://placehold.co/200x200?text=Crop'" 
                             class="w-20 h-20 rounded-2xl object-cover shadow-sm border border-slate-50">
                        <div>
                            <h3 class="font-bold text-slate-900 leading-tight"><?= htmlspecialchars($item['product_name']) ?></h3>
                            <p class="text-[10px] font-black text-emerald-600 uppercase mt-1">Farmer: <?= htmlspecialchars($item['farmer_name']) ?></p>
                            <p class="text-[9px] text-slate-400 mt-1">ID: #ORD-<?= $item['order_id'] ?></p>
                        </div>
                    </div>

                    <div class="w-full md:w-3/4">
                        <div class="flex justify-between items-start">
                            
                            <div class="step-container <?= ($step2 && !$is_cancelled) ? 'step-active' : ($is_cancelled ? 'step-error' : '') ?>">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center step-icon <?= $is_cancelled ? 'bg-rose-500 text-white' : 'bg-emerald-500 text-white' ?>">
                                    <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                                </div>
                                <p class="text-[9px] font-bold uppercase mt-3 text-center text-slate-600">Order<br>Placed</p>
                                <div class="step-line"></div>
                            </div>

                            <div class="step-container <?= ($step3 && !$is_cancelled) ? 'step-active' : ($is_cancelled ? 'step-error' : '') ?>">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center step-icon <?= $step2 ? ($is_cancelled ? 'bg-rose-500 text-white' : 'bg-emerald-500 text-white') : 'bg-slate-100 text-slate-400' ?>">
                                    <i data-lucide="<?= $is_cancelled ? 'x-circle' : 'check-circle' ?>" class="w-5 h-5"></i>
                                </div>
                                <p class="text-[9px] font-bold uppercase mt-3 text-center text-slate-600"><?= $is_cancelled ? 'Order<br>Rejected' : 'Farmer<br>Confirmed' ?></p>
                                <div class="step-line"></div>
                            </div>

                            <div class="step-container">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center step-icon <?= $step3 ? 'bg-emerald-500 text-white' : 'bg-slate-100 text-slate-400' ?>">
                                    <i data-lucide="package-check" class="w-5 h-5"></i>
                                </div>
                                <p class="text-[9px] font-bold uppercase mt-3 text-center text-slate-600">Delivery<br>Received</p>
                            </div>

                        </div>
                    </div>
                </div>
                
                <div class="mt-8 pt-5 border-t border-slate-50 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-3 bg-slate-50 px-4 py-2 rounded-2xl">
                        <div class="w-2 h-2 rounded-full <?= ($step3 || $is_cancelled) ? 'bg-slate-300' : 'animate-ping bg-emerald-500' ?>"></div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-tight">
                            Status: 
                            <span class="<?= $is_cancelled ? 'text-rose-600' : 'text-slate-800' ?>">
                            <?php 
                                if ($is_cancelled) echo "Order Rejected. Contact support if this was a mistake.";
                                elseif ($step3) echo "Transaction Completed. Inventory updated.";
                                elseif ($step2) echo "Farmer has confirmed! Click 'Mark as Received' once items arrive.";
                                else echo "Waiting for Farmer to accept the deal...";
                            ?>
                            </span>
                        </p>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <?php if(!$step3 && !$is_cancelled): ?>
                            <form action="complete_order.php" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                <input type="hidden" name="order_id" value="<?= $item['order_id'] ?>">
                                <input type="hidden" name="action" value="reject">
                                <button type="submit" class="border border-rose-200 text-rose-600 text-xs font-black uppercase tracking-widest px-6 py-3 rounded-xl hover:bg-rose-50 transition-all flex items-center gap-2">
                                    Reject <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>

                            <?php if($status == 'Confirmed'): ?>
                                <form action="complete_order.php" method="POST">
                                    <input type="hidden" name="order_id" value="<?= $item['order_id'] ?>">
                                    <input type="hidden" name="action" value="complete">
                                    <button type="submit" class="bg-emerald-600 text-white text-xs font-black uppercase tracking-widest px-6 py-3 rounded-xl hover:bg-emerald-700 shadow-lg shadow-emerald-100 transition-all flex items-center gap-2">
                                        Mark as Received <i data-lucide="check" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="text-center py-24 bg-white rounded-[3rem] border-2 border-dashed border-slate-100">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="truck" class="w-10 h-10 text-slate-300"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800">No shipments found</h3>
                <p class="text-slate-400 text-sm max-w-xs mx-auto mt-2">You haven't purchased any crops yet. Start browsing the marketplace!</p>
                <a href="crop.php" class="mt-8 inline-block bg-slate-900 text-white px-8 py-3 rounded-2xl text-xs font-bold uppercase tracking-widest hover:bg-emerald-600 transition-all">Go to Marketplace</a>
            </div>
        <?php endif; ?>
    </div>
</main>

<script>
    lucide.createIcons();
</script>

</body>
</html>