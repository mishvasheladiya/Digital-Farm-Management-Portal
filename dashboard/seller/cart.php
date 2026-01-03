<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../components/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

/* Fetch cart items */
$stmt = $pdo->prepare("
    SELECT 
        c.id AS cart_id,
        c.quantity,
        p.product_name,
        p.price,
        p.category,
        p.image_path,
        f.farm_name
    FROM cart c
    JOIN products p ON c.product_id = p.id
    JOIN farmers f ON p.farmer_id = f.farmer_id
    WHERE c.user_id = ?
");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$subtotal = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Procurement Cart | GreenAgro Supply</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: #f8fafc; 
            color: #0f172a;
        }
        .cart-card { 
            transition: all 0.3s ease;
        }
        .cart-card:hover {
            border-color: #22c55e;
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="antialiased">

<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto px-6 py-12">
    <div class="mb-10">
        <h1 class="text-3xl font-extrabold tracking-tight">Procurement <span class="text-green-600">Cart</span></h1>
        <p class="text-slate-500 mt-1 font-medium text-sm">Review your selected commodities before initiating contract.</p>
    </div>

    <?php if (!$cart_items): ?>
        <div class="bg-white border border-dashed border-slate-300 rounded-[2rem] py-24 text-center">
            <div class="bg-slate-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                <i data-lucide="shopping-cart" class="w-10 h-10 text-slate-300"></i>
            </div>
            <h2 class="text-2xl font-bold text-slate-900">Your cart is currently empty</h2>
            <p class="text-slate-500 mt-2 max-w-sm mx-auto">Looks like you haven't added any fresh produce to your procurement list yet.</p>
            <a href="crop.php" class="mt-8 inline-flex items-center gap-2 bg-green-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-green-700 transition-all">
                Browse Marketplace <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>
    <?php else: ?>

    <div class="flex flex-col lg:flex-row gap-8">
        
        <div class="flex-1 space-y-4">
            <div class="flex items-center justify-between px-4 mb-2">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Item Details</span>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Subtotal</span>
            </div>

            <?php foreach ($cart_items as $item): 
                $img = $item['image_path'] ? "../Farmer/".$item['image_path'] : "https://placehold.co/100x100";
                $item_total = $item['price'] * $item['quantity'];
                $subtotal += $item_total;
            ?>
            <div class="cart-card bg-white border border-slate-200 p-5 rounded-2xl flex items-center gap-6 shadow-sm">
                <div class="relative">
                    <img src="<?= $img ?>" class="w-24 h-24 rounded-xl object-cover border border-slate-100 shadow-inner">
                    <span class="absolute -top-2 -right-2 bg-slate-900 text-white text-[10px] font-bold px-2 py-1 rounded-lg">
                        Qty: <?= $item['quantity'] ?>
                    </span>
                </div>

                <div class="flex-1">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="text-[10px] font-bold text-green-600 uppercase tracking-wider"><?= $item['category'] ?></span>
                            <h3 class="text-lg font-bold text-slate-900 leading-tight mb-1"><?= htmlspecialchars($item['product_name']) ?></h3>
                            <div class="flex items-center gap-1 text-slate-500">
                                <i data-lucide="map-pin" class="w-3 h-3 text-slate-400"></i>
                                <p class="text-xs font-medium"><?= htmlspecialchars($item['farm_name']) ?></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-extrabold text-slate-900">₹<?= number_format($item_total, 0) ?></p>
                            <p class="text-[11px] text-slate-400 font-semibold">₹<?= number_format($item['price'], 0) ?> / unit</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4 mt-4 pt-4 border-t border-slate-50">
                        <button class="text-xs font-bold text-slate-400 hover:text-red-500 flex items-center gap-1 transition-colors">
                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Remove
                        </button>
                        <button class="text-xs font-bold text-slate-400 hover:text-green-600 flex items-center gap-1 transition-colors">
                            <i data-lucide="heart" class="w-3.5 h-3.5"></i> Save for later
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="lg:w-[400px]">
            <div class="bg-white border border-slate-200 rounded-[2rem] p-8 sticky top-24 shadow-xl shadow-slate-200/50">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Order Overview</h2>
                
                <div class="space-y-4 mb-8">
                    <div class="flex justify-between text-sm">
                        <span class="font-medium text-slate-500">Cart Subtotal</span>
                        <span class="font-bold text-slate-900">₹<?= number_format($subtotal, 0) ?></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="font-medium text-slate-500">Estimated Logistics</span>
                        <span class="font-bold text-green-600 italic">TBD</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="font-medium text-slate-500">Platform Fee</span>
                        <span class="font-bold text-slate-900">₹0</span>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex justify-between items-center">
                        <span class="text-base font-bold text-slate-900">Total Payable</span>
                        <span class="text-2xl font-black text-slate-900 tracking-tight">₹<?= number_format($subtotal, 0) ?></span>
                    </div>
                </div>

                <div class="space-y-3">
                    <a href="checkout.php"
                       class="flex items-center justify-center gap-2 w-full bg-slate-900 text-white py-4 rounded-2xl font-bold hover:bg-green-600 transition-all shadow-lg shadow-slate-200">
                        Proceed to Checkout <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </a>
                    <a href="catalog.php"
                       class="flex items-center justify-center gap-2 w-full bg-white text-slate-500 py-3 rounded-2xl font-bold text-sm border border-slate-100 hover:bg-slate-50 transition-all">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i> Add more items
                    </a>
                </div>

                <div class="mt-8 pt-8 border-t border-slate-100 grid grid-cols-2 gap-4">
                    <div class="flex flex-col items-center text-center">
                        <i data-lucide="shield-check" class="w-5 h-5 text-green-500 mb-1"></i>
                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Verified Farms</span>
                    </div>
                    <div class="flex flex-col items-center text-center">
                        <i data-lucide="truck" class="w-5 h-5 text-green-500 mb-1"></i>
                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Global Logistics</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php endif; ?>
</div>

<script>lucide.createIcons();</script>
</body>
</html>