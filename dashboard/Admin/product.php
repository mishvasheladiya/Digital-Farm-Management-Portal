<?php
session_start();
require 'config.php';

// 1. HARDCODED CATEGORIES
$categories = ['Vegetables', 'Fruits', 'Grains', 'Pulses', 'Spices', 'Flowers', 'Other'];

// 2. GET FILTER VALUES
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$category = isset($_GET['category']) ? $conn->real_escape_string($_GET['category']) : '';

// 3. CONSTRUCT SQL
$query = "SELECT p.*, f.first_name, f.last_name, f.farm_name 
          FROM products p 
          LEFT JOIN farmers f ON p.farmer_id = f.farmer_id 
          WHERE 1=1"; 

if (!empty($search)) {
    $query .= " AND (p.product_name LIKE '%$search%' 
                OR f.first_name LIKE '%$search%' 
                OR f.farm_name LIKE '%$search%' 
                OR p.category LIKE '%$search%')";
}

if (!empty($category)) {
    $query .= " AND p.category = '$category'";
}

$query .= " ORDER BY p.created_at DESC";
$result = $conn->query($query);

// Data for the "Add Product" Farmer Dropdown
$farmers_list = $conn->query("SELECT farmer_id, farm_name, first_name FROM farmers");

// STATS
$total_products = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        
        /* Smooth Notification Animation */
        .toast-enter { transform: translateX(120%); opacity: 0; }
        .toast-visible { transform: translateX(0); opacity: 1; }
    </style>
</head>
<body class="bg-[#F8FAFC] min-h-screen antialiased text-slate-900">

<div id="notification" class="fixed top-6 right-6 z-[100] transition-all duration-500 ease-in-out toast-enter">
    <div class="bg-white border-l-4 border-emerald-500 shadow-[0_10px_40px_rgba(0,0,0,0.08)] rounded-2xl p-4 flex items-center gap-4 min-w-[320px]">
        <div class="bg-emerald-100 p-2 rounded-xl text-emerald-600">
            <i data-lucide="check-circle-2" class="w-6 h-6"></i>
        </div>
        <div>
            <p class="font-black text-slate-800 text-xs uppercase tracking-wider">Success</p>
            <p class="text-sm text-slate-500 font-medium">Product added successfully!</p>
        </div>
        <button onclick="closeNotification()" class="ml-auto text-slate-300 hover:text-slate-500">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
    </div>
</div>

<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto p-6 lg:p-10 space-y-8">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight">Product Inventory</h1>
            <p class="text-slate-500 font-medium mt-1">
                <?php if(!empty($search) || !empty($category)): ?>
                    Showing <span class="text-emerald-600 font-bold"><?= $total_products ?></span> matching items
                <?php else: ?>
                    Manage and monitor all farm produce across the platform.
                <?php endif; ?>
            </p>
        </div>
        <button onclick="document.getElementById('addModal').classList.remove('hidden')" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl font-semibold transition-all shadow-lg shadow-emerald-200 flex items-center gap-2">
            <i data-lucide="plus" class="w-5 h-5"></i> Add Product
        </button>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <form method="GET" id="filterForm" class="p-6 border-b border-slate-50 flex flex-col md:flex-row gap-4 justify-between bg-slate-50/30">
            <div class="relative w-full md:w-96">
                <i data-lucide="search" class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" 
                       placeholder="Press Enter to search..." 
                       class="w-full pl-12 pr-4 py-3 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all bg-white shadow-sm">
            </div>
            
            <div class="flex items-center gap-3">
                <select name="category" onchange="this.form.submit()" class="px-4 py-3 rounded-2xl border border-slate-200 bg-white text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 outline-none shadow-sm min-w-[180px]">
                    <option value="">All Categories</option>
                    <?php foreach($categories as $cat): ?>
                        <option value="<?= $cat ?>" <?= $category == $cat ? 'selected' : '' ?>><?= $cat ?></option>
                    <?php endforeach; ?>
                </select>

                <?php if(!empty($search) || !empty($category)): ?>
                    <a href="?" class="p-3 bg-slate-200 text-slate-700 rounded-2xl hover:bg-slate-300 transition-all">
                        <i data-lucide="rotate-ccw" class="w-5 h-5"></i>
                    </a>
                <?php endif; ?>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80">
                        <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase tracking-widest">Product</th>
                        <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase tracking-widest">Category</th>
                        <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase tracking-widest">Farmer</th>
                        <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase tracking-widest text-center">Stock</th>
                        <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase tracking-widest">Price</th>
                        <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase tracking-widest text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php if($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-2xl overflow-hidden bg-slate-100 border border-slate-100 flex-shrink-0">
                                        <?php 
                                            $imgName = basename($row['image_path']);
                                            $imgPath = "../Farmer/uploads/products/" . $imgName;
                                        ?>
                                        <?php if(!empty($imgName)): ?>
                                            <img src="<?= $imgPath ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        <?php else: ?>
                                            <div class="w-full h-full flex items-center justify-center text-slate-300"><i data-lucide="image" class="w-6 h-6"></i></div>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 leading-tight"><?= htmlspecialchars($row['product_name']) ?></p>
                                        <p class="text-[10px] text-slate-400 mt-1 font-bold uppercase italic">Harvest: <?= date('d M', strtotime($row['harvest_date'])) ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-[10px] font-black uppercase"><?= htmlspecialchars($row['category']) ?></span>
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-slate-700">
                                <?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?>
                                <p class="text-[10px] text-slate-400"><?= htmlspecialchars($row['farm_name']) ?></p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-black text-slate-700"><?= $row['stock_quantity'] ?> KG</span>
                            </td>
                            <td class="px-6 py-4 font-black text-slate-900">₹<?= number_format($row['price'], 2) ?></td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg"><i data-lucide="edit-3" class="w-4 h-4"></i></button>
                                    <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="px-6 py-24 text-center text-slate-400">No products found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="addModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden">
        <div class="p-6 border-b flex justify-between items-center">
            <h2 class="font-black uppercase tracking-tight">Add New Product</h2>
            <button onclick="document.getElementById('addModal').classList.add('hidden')"><i data-lucide="x"></i></button>
        </div>
        <form action="add_product_process.php" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            <input type="text" name="product_name" placeholder="Product Name" class="w-full p-3 border rounded-xl" required>
            <select name="category" class="w-full p-3 border rounded-xl">
                <?php foreach($categories as $cat): ?>
                    <option value="<?= $cat ?>"><?= $cat ?></option>
                <?php endforeach; ?>
            </select>
            <select name="farmer_id" class="w-full p-3 border rounded-xl">
                <?php while($f = $farmers_list->fetch_assoc()): ?>
                    <option value="<?= $f['farmer_id'] ?>"><?= $f['farm_name'] ?> (<?= $f['first_name'] ?>)</option>
                <?php endwhile; ?>
            </select>
            <div class="grid grid-cols-2 gap-4">
                <input type="number" name="price" placeholder="Price (₹)" class="p-3 border rounded-xl" required>
                <input type="number" name="stock" placeholder="Stock (KG)" class="p-3 border rounded-xl" required>
            </div>
            <input type="date" name="harvest_date" class="w-full p-3 border rounded-xl" required>
            <input type="file" name="product_image" class="w-full text-sm">
            <button type="submit" class="w-full bg-slate-900 text-white p-4 rounded-2xl font-bold">Save Product</button>
        </form>
    </div>
</div>

<script>
    lucide.createIcons();

    // NOTIFICATION LOGIC
    function closeNotification() {
        const notif = document.getElementById('notification');
        notif.classList.remove('toast-visible');
        notif.classList.add('toast-enter');
    }

    function showNotification() {
        const notif = document.getElementById('notification');
        notif.classList.remove('toast-enter');
        notif.classList.add('toast-visible');
        
        // Auto-hide after 4 seconds
        setTimeout(closeNotification, 4000);
    }

    // Check URL for success message
    window.onload = () => {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('msg') === 'success') {
            showNotification();
            
            // Clean the URL (removes ?msg=success without refreshing page)
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    };
</script>
</body>
</html>