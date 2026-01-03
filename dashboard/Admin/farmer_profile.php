<?php
session_start();
require 'config.php';

if (!isset($_GET['id'])) { die("Access Denied."); }
$f_id = intval($_GET['id']);

// 1. Fetch Farmer Details
$farmer_query = $conn->prepare("SELECT * FROM farmers WHERE farmer_id = ?");
$farmer_query->bind_param("i", $f_id);
$farmer_query->execute();
$farmer = $farmer_query->get_result()->fetch_assoc();

// 2. Calculate Stats (Using your products table structure)
$stats_query = $conn->prepare("SELECT COUNT(*) as total_items, SUM(stock_quantity) as total_stock, SUM(price * stock_quantity) as total_value FROM products WHERE farmer_id = ?");
$stats_query->bind_param("i", $f_id);
$stats_query->execute();
$stats = $stats_query->get_result()->fetch_assoc();

// 3. Fetch All Products for this Farmer
$products_query = $conn->prepare("SELECT * FROM products WHERE farmer_id = ? ORDER BY created_at DESC");
$products_query->bind_param("i", $f_id);
$products_query->execute();
$products = $products_query->get_result();

if (!$farmer) { die("Farmer not found."); }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $farmer['first_name'] ?> | Admin Insights</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: -0.01em; }
        .bento-card { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .glass-nav { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(0,0,0,0.05); }
        @media print { .no-print { display: none !important; } }
    </style>
</head>
<body class="bg-[#FBFBFE] text-slate-900">

<nav class="glass-nav sticky top-0 z-50 w-full px-6 py-3 no-print">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <a href="javascript:history.back()" class="group flex items-center gap-3 py-1.5 px-2 -ml-2 rounded-2xl hover:bg-slate-50 transition-all duration-300">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white border border-slate-100 shadow-sm group-hover:border-blue-200 group-hover:text-blue-600 transition-all">
                <i data-lucide="chevron-left" class="w-5 h-5 transition-transform group-hover:-translate-x-0.5"></i>
            </div>
            <div class="flex flex-col">
                <span class="text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 leading-none mb-1">Navigation</span>
                <span class="text-sm font-bold text-slate-700 group-hover:text-slate-900 transition-colors">Return to Dashboard</span>
            </div>
        </a>

        <div class="flex items-center gap-4">
            <span class="inline-flex items-center gap-2.5 rounded-full bg-emerald-50 px-4 py-2 text-[11px] font-black uppercase tracking-widest text-emerald-700 ring-1 ring-inset ring-emerald-600/10">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                Live System
            </span>
        </div>
    </div>
</nav>

<div id="printable-area">
    <main class="max-w-7xl mx-auto p-6 lg:p-10">

        <div class="flex flex-col lg:flex-row gap-10 items-start mb-12">
            <div class="flex items-center gap-8 flex-1">
                <div class="w-32 h-32 md:w-44 md:h-44 rounded-[2.5rem] bg-slate-900 flex items-center justify-center text-white text-6xl font-black shadow-2xl relative">
                    <span class="relative z-10"><?= substr($farmer['first_name'], 0, 1) ?></span>
                    <div class="absolute inset-0 bg-gradient-to-tr from-blue-600 to-transparent opacity-40 rounded-[2.5rem]"></div>
                </div>
                <div>
                    <h1 class="text-5xl font-black text-slate-900 leading-tight"><?= $farmer['first_name'] . " " . $farmer['last_name'] ?></h1>
                    <p class="text-xl text-blue-600 font-semibold mb-4"><?= $farmer['farm_name'] ?></p>
                    <div class="flex gap-2">
                        <span class="bg-blue-50 text-blue-700 px-4 py-1.5 rounded-xl text-xs font-bold border border-blue-100 italic"><?= $farmer['farming_type'] ?? 'Organic' ?> Specialist</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 w-full lg:w-auto">
                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Inventory</p>
                    <h4 class="text-3xl font-black text-slate-900"><?= $stats['total_items'] ?: 0 ?></h4>
                </div>
                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Total Stock</p>
                    <h4 class="text-3xl font-black text-slate-900"><?= number_format($stats['total_stock'] ?: 0) ?>kg</h4>
                </div>
                <div class="bg-blue-600 p-6 rounded-[2rem] shadow-xl shadow-blue-100 text-white col-span-2 md:col-span-1">
                    <p class="text-[10px] font-black text-blue-200 uppercase tracking-widest mb-2">Market Value</p>
                    <h4 class="text-3xl font-black italic">₹<?= number_format($stats['total_value'] ?: 0) ?></h4>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <h3 class="font-extrabold text-xl mb-8 flex items-center justify-between">
                        Farm Dossier <i data-lucide="shield-check" class="text-emerald-500 w-5 h-5"></i>
                    </h3>
                    
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400"><i data-lucide="mail" class="w-5 h-5"></i></div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Email Address</p>
                                <p class="font-bold text-slate-700 text-sm"><?= $farmer['email'] ?></p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400"><i data-lucide="phone" class="w-5 h-5"></i></div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Mobile</p>
                                <p class="font-bold text-slate-700 text-sm"><?= $farmer['mobile'] ?></p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400"><i data-lucide="map-pin" class="w-5 h-5"></i></div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Base Location</p>
                                <p class="font-bold text-slate-700 text-sm"><?= $farmer['address'] ?></p>
                                <p class="text-[11px] text-slate-400"><?= $farmer['city'] ?>, <?= $farmer['state'] ?></p>
                            </div>
                        </div>
                    </div>

                    <button onclick="generatePDF()" class="no-print w-full mt-10 bg-slate-900 text-white py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-600 transition-all shadow-xl shadow-slate-200 flex items-center justify-center gap-3">
                        <i data-lucide="file-text" class="w-4 h-4"></i> Generate Profile PDF
                    </button>
                </div>
            </div>

            <div class="lg:col-span-8">
                <h3 class="text-2xl font-black tracking-tight text-slate-900 mb-8">Active Inventory Details</h3>

                <div class="grid grid-cols-1 gap-6">
                    <?php if ($products->num_rows > 0): ?>
                        <?php while($p = $products->fetch_assoc()): ?>
                        <div class="bg-white rounded-[2.5rem] border border-slate-100 p-6 shadow-sm flex flex-col md:flex-row gap-8 items-center">
                            <div class="w-full md:w-44 h-44 rounded-[2rem] overflow-hidden bg-slate-100 shrink-0">
                                <img src="../Farmer/<?= $p['image_path'] ?>" class="w-full h-full object-cover" onerror="this.src='https://placehold.co/400x400?text=Crop'">
                            </div>

                            <div class="flex-1 grid grid-cols-2 md:grid-cols-3 gap-y-6 gap-x-4">
                                <div class="col-span-2">
                                    <span class="text-[9px] font-black text-blue-500 uppercase tracking-widest"><?= $p['category'] ?></span>
                                    <h4 class="text-2xl font-black text-slate-900"><?= $p['product_name'] ?></h4>
                                </div>
                                
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Unit Price</p>
                                    <p class="text-xl font-black text-slate-900 italic">₹<?= $p['price'] ?><small class="text-[10px] not-italic">/kg</small></p>
                                </div>

                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Quantity</p>
                                    <p class="font-bold text-slate-700"><?= $p['stock_quantity'] ?> kg</p>
                                </div>

                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Harvest Date</p>
                                    <p class="font-bold text-slate-700"><?= date('M d, Y', strtotime($p['harvest_date'])) ?></p>
                                </div>

                                <div class="col-span-2 md:col-span-1">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Origin</p>
                                    <p class="font-bold text-slate-700 truncate"><?= $p['farm_location'] ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="p-20 text-center bg-white rounded-[3rem] border-2 border-dashed border-slate-100">
                            <p class="text-slate-400 font-bold">No products found for this profile.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    lucide.createIcons();

    function generatePDF() {
        const element = document.getElementById('printable-area');
        
        // Hide elements that shouldn't be in PDF if they aren't marked no-print
        const options = {
            margin:       [0.5, 0.5],
            filename:     'Farmer_Profile_<?= $farmer['first_name'] ?>.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2, useCORS: true, letterRendering: true },
            jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
        };

        // Generate the PDF
        html2pdf().set(options).from(element).save();
    }
</script>

</body>
</html>