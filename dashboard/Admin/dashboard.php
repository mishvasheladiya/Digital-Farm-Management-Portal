
<?php
session_start();
require 'config.php';

/* ======================
   DATA FETCHING LOGIC
====================== */

// 1. Metric Counts
$farmerCount = $conn->query("SELECT COUNT(*) AS total FROM farmers")->fetch_assoc()['total'] ?? 0;
$distributorCount = $conn->query("SELECT COUNT(*) AS total FROM distributors")->fetch_assoc()['total'] ?? 0;
$productCount = $conn->query("SELECT COUNT(*) AS total FROM products")->fetch_assoc()['total'] ?? 0;

// 2. Revenue (Stock Value)
$revenueResult = $conn->query("SELECT IFNULL(SUM(price * stock_quantity),0) AS revenue FROM products");
$revenue = $revenueResult->fetch_assoc()['revenue'];

// 3. Recent Farmers List
$recentFarmers = $conn->query("
    SELECT farmer_id, first_name, email, status 
    FROM farmers 
    ORDER BY created_at DESC 
    LIMIT 5
");

// 4. Recent Products List
$recentProducts = $conn->query("
    SELECT p.product_name, f.first_name, p.price, p.stock_quantity, p.created_at
    FROM products p
    LEFT JOIN farmers f ON p.farmer_id = f.farmer_id
    ORDER BY p.created_at DESC
    LIMIT 5
");

// 5. Low Stock Alerts (Logic from second page)
$lowStockItems = $conn->query("SELECT product_name, stock_quantity FROM products WHERE stock_quantity < 50 LIMIT 3");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); }
    </style>
</head>

<body class="bg-[#F8FAFC] min-h-screen antialiased text-slate-900">

<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto p-6 lg:p-10 space-y-8">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-slate-200 pb-8">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">Dashboard Overview</h1>
            <p class="text-slate-500 font-medium mt-1">Real-time insights into your farming network and inventory.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="export.php"><button class="bg-white border border-slate-200 text-slate-700 px-4 py-2 rounded-xl text-sm font-semibold hover:bg-slate-50 transition-all flex items-center gap-2 shadow-sm">
                <i data-lucide="download" class="w-4 h-4"></i> Export Report
            </button></a>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex items-center justify-between transition hover:shadow-md">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Farmers</p>
                <p class="text-3xl font-black mt-1"><?= number_format($farmerCount) ?></p>
            </div>
            <div class="p-4 bg-emerald-50 text-emerald-600 rounded-2xl">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex items-center justify-between transition hover:shadow-md">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Distributors</p>
                <p class="text-3xl font-black mt-1"><?= number_format($distributorCount) ?></p>
            </div>
            <div class="p-4 bg-blue-50 text-blue-600 rounded-2xl">
                <i data-lucide="truck" class="w-6 h-6"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex items-center justify-between transition hover:shadow-md">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Live Products</p>
                <p class="text-3xl font-black mt-1"><?= number_format($productCount) ?></p>
            </div>
            <div class="p-4 bg-amber-50 text-amber-600 rounded-2xl">
                <i data-lucide="package" class="w-6 h-6"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex items-center justify-between transition hover:shadow-md">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Stock Value</p>
                <p class="text-3xl font-black mt-1">₹<?= number_format($revenue, 0) ?></p>
            </div>
            <div class="p-4 bg-purple-50 text-purple-600 rounded-2xl">
                <i data-lucide="indian-rupee" class="w-6 h-6"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-50 flex justify-between items-center">
                <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-emerald-500 rounded-full"></span>
                    Recent Farmers
                </h2>
                <a href="#" class="text-sm font-bold text-emerald-600 hover:underline">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Farmer ID</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Name</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Email</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php while($row = $recentFarmers->fetch_assoc()): ?>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 text-sm font-bold text-slate-500">#F-<?= $row['farmer_id'] ?></td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-xs">
                                        <?= strtoupper(substr($row['first_name'], 0, 1)) ?>
                                    </div>
                                    <span class="font-semibold text-slate-700"><?= htmlspecialchars($row['first_name']) ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500"><?= htmlspecialchars($row['email']) ?></td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-[10px] font-black uppercase tracking-wider rounded-lg bg-emerald-100 text-emerald-700">
                                    <?= $row['status'] ?>
                                </span>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6">
            <h2 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-5 h-5 text-amber-500"></i>
                Stock Alerts
            </h2>
            <div class="space-y-4">
                <?php if($lowStockItems->num_rows > 0): ?>
                    <?php while($item = $lowStockItems->fetch_assoc()): ?>
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <div>
                            <p class="font-bold text-slate-700 text-sm"><?= $item['product_name'] ?></p>
                            <p class="text-xs text-slate-400 font-medium mt-1">Remaining: <?= $item['stock_quantity'] ?> units</p>
                        </div>
                        <span class="px-2 py-1 bg-amber-100 text-amber-700 text-[10px] font-black rounded-md">LOW</span>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="text-center py-8">
                        <i data-lucide="check-circle" class="w-12 h-12 text-emerald-200 mx-auto mb-3"></i>
                        <p class="text-sm text-slate-400 font-medium">Stock levels are healthy.</p>
                    </div>
                <?php endif; ?>
            </div>
            <button class="w-full mt-6 py-3 border-2 border-dashed border-slate-200 rounded-2xl text-slate-400 text-sm font-bold hover:border-emerald-300 hover:text-emerald-500 transition-all">
                Generate Inventory Report
            </button>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-50 flex justify-between items-center">
            <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                <span class="w-1.5 h-6 bg-amber-500 rounded-full"></span>
                New Inventory Arrivals
            </h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/50">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Product Name</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Associated Farmer</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Unit Price</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Stock Count</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Added Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php while($row = $recentProducts->fetch_assoc()): ?>
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 font-bold text-slate-700"><?= htmlspecialchars($row['product_name']) ?></td>
                        <td class="px-6 py-4 text-sm text-slate-500 font-medium"><?= htmlspecialchars($row['first_name'] ?? 'System') ?></td>
                        <td class="px-6 py-4 text-sm font-black text-slate-800">₹<?= number_format($row['price'], 2) ?></td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-full bg-slate-100 h-1.5 rounded-full max-w-[60px]">
                                    <div class="bg-emerald-500 h-1.5 rounded-full" style="width: 70%"></div>
                                </div>
                                <span class="text-xs font-bold text-slate-500"><?= $row['stock_quantity'] ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-400 font-medium"><?= date('M d, Y', strtotime($row['created_at'])) ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Initialize Lucide Icons
    lucide.createIcons();
</script>

</body>
</html>