<?php
session_start();
require 'config.php';

/* ---------- AUTH CHECK ---------- */
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Distributor') {
    header("Location: ../../components/login.php");
    exit;
}

$dist_id = $_SESSION['user_id'];

/* ---------- FILTERS ---------- */
$search   = $_GET['search'] ?? '';
$category = $_GET['category'] ?? 'All';

try {
    /**
     * LOGIC UPDATE:
     * We exclude products only if they have an order that is NOT 'Cancelled'.
     * If an order was 'Cancelled', the product should reappear here.
     */
    $sql = "
        SELECT 
            p.*,
            f.farm_name,
            f.city AS location,
            (SELECT COUNT(*) FROM product_interests WHERE product_id = p.id) AS active_leads
        FROM products p
        JOIN farmers f ON p.farmer_id = f.farmer_id
        WHERE p.id NOT IN (
            SELECT product_id 
            FROM orders 
            WHERE status IN ('Confirmed', 'Completed')
        )
    ";

    $params = [];

    if ($search) {
        $sql .= " AND (p.product_name LIKE :search OR f.farm_name LIKE :search)";
        $params['search'] = "%$search%";
    }

    if ($category !== 'All') {
        $sql .= " AND p.category = :category";
        $params['category'] = $category;
    }

    $sql .= " ORDER BY p.created_at DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Global Sourcing Terminal | GreenAgro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; background: #f8fafc; color: #0f172a; }
        .glass-sidebar { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); }
        .pro-card { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); border: 1px solid #e2e8f0; background: white; }
        .pro-card:hover { border-color: #22c55e; transform: translateY(-4px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05); }
    </style>
</head>

<body class="antialiased">

<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
        <div>
            <p class="text-green-600 font-bold text-xs uppercase tracking-widest mb-2">Marketplace Terminal</p>
            <h1 class="text-4xl font-extrabold tracking-tight">Commodity Exchange</h1>
        </div>
        <div class="bg-white px-4 py-2 rounded-2xl border flex items-center gap-3">
            <div class="flex -space-x-2">
                <div class="w-8 h-8 rounded-full bg-green-100 border-2 border-white flex items-center justify-center text-[10px] text-green-600 font-bold">●</div>
                <div class="w-8 h-8 rounded-full bg-slate-300 border-2 border-white text-[10px] flex items-center justify-center font-bold">+12</div>
            </div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Live Inventory</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
        <aside class="lg:col-span-1">
            <div class="glass-sidebar rounded-3xl p-8 border sticky top-8 h-fit shadow-sm">
                <form method="GET" class="space-y-8">
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Global Search</label>
                        <div class="relative mt-3">
                            <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                            <input name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search crops..."
                                   class="w-full pl-11 pr-4 py-3.5 rounded-2xl bg-slate-50 border-slate-200 border focus:ring-4 focus:ring-green-500/10 focus:border-green-500 outline-none transition-all text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sector</label>
                        <div class="mt-4 flex flex-col gap-2">
                            <?php
                            $cats = ['All','Vegetable','Fruit','Grains','Pulse','Spice','Flower','Other'];
                            foreach ($cats as $c):
                                $isSelected = ($category === $c);
                            ?>
                            <label class="flex items-center justify-between p-3 rounded-xl cursor-pointer transition-all <?= $isSelected ? 'bg-green-50 border-green-200 border' : 'hover:bg-slate-50' ?>">
                                <input type="radio" name="category" value="<?= $c ?>" <?= $isSelected ? 'checked' : '' ?> class="hidden" onchange="this.form.submit()">
                                <span class="text-sm font-bold <?= $isSelected ? 'text-green-700' : 'text-slate-600' ?>"><?= $c ?></span>
                                <?php if($isSelected): ?> <i data-lucide="check-circle-2" class="w-4 h-4 text-green-600"></i> <?php endif; ?>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </form>
            </div>
        </aside>

        <main class="lg:col-span-3">
            <div class="space-y-6">
                <?php if ($products): ?>
                    <?php foreach ($products as $item): 
                        $img = $item['image_path'] ? "../Farmer/".$item['image_path'] : "https://placehold.co/600x400?text=Commodity";
                        $stock_percent = min(($item['stock_quantity'] / 1000) * 100, 100);
                    ?>
                    <div class="pro-card rounded-3xl p-2 flex flex-col md:flex-row gap-6 items-stretch overflow-hidden">
                        <div class="relative w-full md:w-56 h-48 md:h-auto overflow-hidden rounded-2xl">
                            <img src="<?= $img ?>" class="w-full h-full object-cover">
                        </div>

                        <div class="flex-1 py-4 pr-6 pl-4 md:pl-0 flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start">
                                    <h3 class="text-xl font-extrabold text-slate-900"><?= htmlspecialchars($item['product_name']) ?></h3>
                                    <span class="text-xl font-black text-green-600">₹<?= number_format($item['price']) ?></span>
                                </div>
                                <p class="text-xs font-bold text-slate-400 uppercase mt-1">
                                    <i data-lucide="map-pin" class="inline w-3 h-3 mr-1"></i><?= htmlspecialchars($item['location']) ?> • <?= htmlspecialchars($item['farm_name']) ?>
                                </p>

                                <div class="grid grid-cols-2 gap-4 mt-6">
                                    <div class="space-y-1">
                                        <span class="text-[9px] text-slate-400 font-black uppercase tracking-widest">Available Stock</span>
                                        <p class="text-sm font-bold"><?= number_format($item['stock_quantity']) ?> kg</p>
                                        <div class="w-full h-1 bg-slate-100 rounded-full"><div class="h-full bg-green-500 w-[<?= $stock_percent ?>%]"></div></div>
                                    </div>
                                    <div class="space-y-1">
                                        <span class="text-[9px] text-slate-400 font-black uppercase tracking-widest">Market Demand</span>
                                        <p class="text-sm font-bold"><?= $item['active_leads'] ?> active interests</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 mt-6">
                                <button onclick="addToCart(<?= $item['id'] ?>)" class="flex-1 bg-green-600 text-white h-12 rounded-xl font-bold hover:bg-green-700 transition-all flex items-center justify-center gap-2">
                                    <i data-lucide="shopping-cart" class="w-4 h-4"></i> Secure Quantity
                                </button>
                                <button onclick="markInterested(<?= $item['id'] ?>)" class="px-4 h-12 rounded-xl border-2 border-slate-100 hover:bg-orange-50 hover:text-orange-500 transition-all">
                                    <i data-lucide="star" class="w-5 h-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="bg-white rounded-[3rem] p-20 text-center border-2 border-dashed">
                        <i data-lucide="package-search" class="w-12 h-12 mx-auto text-slate-300 mb-4"></i>
                        <h2 class="text-2xl font-bold text-slate-900">No Inventory Available</h2>
                        <p class="text-slate-500 mt-2">Check back later for fresh listings or try a different category.</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</div>

<script>
    lucide.createIcons();

    function markInterested(id) {
        fetch("mark_interested.php", {
            method: "POST",
            headers: {"Content-Type":"application/x-www-form-urlencoded"},
            body: "product_id=" + id
        })
        .then(r=>r.json())
        .then(d=>{
            if(d.status==="success") { location.reload(); } 
            else { alert(d.message || "Already in watchlist."); }
        });
    }

    function addToCart(productId) {
        fetch("add_to_cart.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "product_id=" + productId
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === "success") { window.location.href = "cart.php"; } 
            else { alert(data.message || "Stock unavailable."); }
        });
    }
</script>
</body>
</html>