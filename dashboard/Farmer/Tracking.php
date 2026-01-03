<?php
// 1. Session and Connection
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure database connection
$conn = mysqli_connect("localhost", "root", "", "farm");
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }

// 2. Auth Check
if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php"); 
    exit;
}

$email = $_SESSION['email'];

// 3. Get Farmer ID
$stmt_f = mysqli_prepare($conn, "SELECT farmer_id FROM farmers WHERE email = ?");
mysqli_stmt_bind_param($stmt_f, "s", $email);
mysqli_stmt_execute($stmt_f);
$farmer_res = mysqli_stmt_get_result($stmt_f);
$farmer_data = mysqli_fetch_assoc($farmer_res);

if (!$farmer_data) {
    die("Farmer record not found for this email.");
}
$farmer_id = $farmer_data['farmer_id'];

// 4. Fetch Products with Order and Interest Info
$query = "SELECT p.id, p.product_name, p.image_path, p.created_at, p.category,
          o.status as order_status, o.order_id,
          (SELECT COUNT(*) FROM product_interests WHERE product_id = p.id) as interest_count
          FROM products p
          LEFT JOIN orders o ON p.id = o.product_id
          WHERE p.farmer_id = ?
          ORDER BY p.created_at DESC";

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
    <title>Crop Tracking - GreenAgro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .step-container { position: relative; flex: 1; display: flex; flex-direction: column; align-items: center; }
        .step-line { 
            position: absolute; 
            top: 20px; 
            left: 50%; 
            width: 100%; 
            height: 3px; 
            background: #e2e8f0; 
            z-index: 1; 
        }
        .step-active .step-line { background: #10b981; }
        .step-icon { position: relative; z-index: 10; }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<main class="max-w-6xl mx-auto px-6 py-12">
    <div class="mb-10">
        <h1 class="text-3xl font-extrabold text-slate-900 uppercase tracking-tight">
            Crop Life-Cycle <span class="text-emerald-500 font-light">Tracking</span>
        </h1>
        <p class="text-slate-500 mt-2">Monitor the real-time progress of your listed crops.</p>
    </div>

    <div class="space-y-8">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($item = mysqli_fetch_assoc($result)): 
                // STEP LOGIC
                $step1 = true; 
                $step2 = ($item['interest_count'] > 0 || $item['order_id']) ? true : false; 
                $step3 = ($item['order_status'] == 'Confirmed' || $item['order_status'] == 'Completed') ? true : false; 
                $step4 = ($item['order_status'] == 'Completed') ? true : false; 

                /**
                 * IMAGE PATH FIX
                 * Since Tracking.php and the uploads folder are both in dashboard/Farmer/
                 * We just need: uploads/products/filename.jpg
                 */
                $filename = basename($item['image_path']); 
                $img_url = "uploads/products/" . $filename;
            ?>
            
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    
                    <div class="w-full md:w-1/4 flex items-center gap-5 border-b md:border-b-0 md:border-r border-slate-100 pb-4 md:pb-0">
                        <img src="<?= $img_url ?>" 
                             onerror="this.src='https://placehold.co/200x200/ecfdf5/059669?text=Crop'" 
                             class="w-24 h-24 rounded-[2rem] object-cover shadow-sm border-2 border-white">
                        <div>
                            <h3 class="font-bold text-slate-900 leading-tight text-lg"><?= htmlspecialchars($item['product_name']) ?></h3>
                            <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mt-1"><?= $item['category'] ?></p>
                            <p class="text-[10px] text-slate-400 mt-2 uppercase font-bold">Ref ID: #<?= $item['id'] ?></p>
                        </div>
                    </div>

                    <div class="w-full md:w-3/4">
                        <div class="flex justify-between items-start">
                            
                            <div class="step-container <?= $step2 ? 'step-active' : '' ?>">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center step-icon <?= $step1 ? 'bg-emerald-500 text-white' : 'bg-slate-100 text-slate-400' ?>">
                                    <i data-lucide="upload-cloud" class="w-5 h-5"></i>
                                </div>
                                <p class="text-[9px] font-bold uppercase mt-3 tracking-tighter text-center <?= $step1 ? 'text-emerald-600' : 'text-slate-400' ?>">Product<br>Uploaded</p>
                                <div class="step-line"></div>
                            </div>

                            <div class="step-container <?= $step3 ? 'step-active' : '' ?>">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center step-icon <?= $step2 ? 'bg-emerald-500 text-white' : 'bg-slate-100 text-slate-400' ?>">
                                    <i data-lucide="user-plus" class="w-5 h-5"></i>
                                </div>
                                <p class="text-[9px] font-bold uppercase mt-3 tracking-tighter text-center <?= $step2 ? 'text-emerald-600' : 'text-slate-400' ?>">Distributor<br>Found</p>
                                <div class="step-line"></div>
                            </div>

                            <div class="step-container <?= $step4 ? 'step-active' : '' ?>">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center step-icon <?= $step3 ? 'bg-emerald-500 text-white' : 'bg-slate-100 text-slate-400' ?>">
                                    <i data-lucide="truck" class="w-5 h-5"></i>
                                </div>
                                <p class="text-[9px] font-bold uppercase mt-3 tracking-tighter text-center <?= $step3 ? 'text-emerald-600' : 'text-slate-400' ?>">Order<br>In Progress</p>
                                <div class="step-line"></div>
                            </div>

                            <div class="step-container">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center step-icon <?= $step4 ? 'bg-emerald-500 text-white' : 'bg-slate-100 text-slate-400' ?>">
                                    <i data-lucide="award" class="w-5 h-5"></i>
                                </div>
                                <p class="text-[9px] font-bold uppercase mt-3 tracking-tighter text-center <?= $step4 ? 'text-emerald-600' : 'text-slate-400' ?>">Deal<br>Completed</p>
                            </div>

                        </div>
                    </div>
                </div>
                
                <div class="mt-8 pt-5 border-t border-slate-50 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-3 bg-slate-50 px-4 py-2 rounded-2xl">
                        <div class="w-2 h-2 rounded-full animate-ping bg-emerald-500"></div>
                        <p class="text-xs font-bold text-slate-500 tracking-tight">
                            STATUS: 
                            <span class="text-slate-800">
                            <?php 
                                if ($step4) echo "Transaction Finished. Payment settled.";
                                elseif ($step3) echo "Order Confirmed. Awaiting logistics.";
                                elseif ($step2) echo "Interest Received! Confirm the deal to start shipping.";
                                else echo "Broadcasting to distributors...";
                            ?>
                            </span>
                        </p>
                    </div>
                    
                    <?php if(!$step3 && $step2): ?>
                        <a href="crops.php" class="bg-slate-900 text-white text-xs font-black uppercase tracking-widest px-6 py-3 rounded-xl hover:bg-emerald-600 transition-all flex items-center gap-2">
                            Select Distributor <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="text-center py-20 bg-white rounded-[3rem] border border-dashed border-slate-200">
                <i data-lucide="package-search" class="w-12 h-12 text-slate-300 mx-auto mb-4"></i>
                <h3 class="text-xl font-bold text-slate-800">No active tracking found</h3>
                <p class="text-slate-400 text-sm">Upload a crop to begin tracking its journey.</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<script>
    lucide.createIcons();
</script>

</body>
</html>