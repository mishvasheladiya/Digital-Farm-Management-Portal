<?php
session_start();
require 'config.php'; // Ensure this uses PDO

// 1. Authentication & ID Check
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Distributor') {
    header("Location: ../../components/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    // 2. Fetch Distributor Details
    $stmt = $pdo->prepare("SELECT * FROM distributors WHERE distributor_id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $city = $user['city'] ?? 'Mumbai'; // Default city for weather

    // 3. STATS LOGIC
    // Total Orders Received
    $stmtOrders = $pdo->prepare("SELECT COUNT(*) FROM orders WHERE distributor_id = ?");
    $stmtOrders->execute([$user_id]);
    $total_orders = $stmtOrders->fetchColumn() ?: 0;

    // Total Earnings (Completed Orders)
    $stmtEarn = $pdo->prepare("SELECT SUM(total_price) FROM orders WHERE distributor_id = ? AND status = 'Completed'");
    $stmtEarn->execute([$user_id]);
    $total_earnings = $stmtEarn->fetchColumn() ?: 0;

    // Confirmed/Pending Orders
    $stmtConf = $pdo->prepare("SELECT COUNT(*) FROM orders WHERE distributor_id = ? AND status = 'Confirmed'");
    $stmtConf->execute([$user_id]);
    $confirmed_orders = $stmtConf->fetchColumn() ?: 0;

    // 4. LIVE STOCK LOGIC (Fetching products belonging to this distributor)
    $stmtStock = $pdo->prepare("SELECT id, product_name, stock_quantity, price FROM products WHERE distributor_id = ? ORDER BY stock_quantity ASC LIMIT 6");
    $stmtStock->execute([$user_id]);
    $inventory = $stmtStock->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard | <?= htmlspecialchars($user['company_name']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<main class="max-w-7xl mx-auto px-6 py-8">

    <section class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Distributor Command Center</h2>
            <p class="text-slate-500 text-sm">Welcome back, <span class="font-semibold text-green-600"><?= htmlspecialchars($user['first_name']) ?></span> | <?= htmlspecialchars($user['company_name']) ?></p>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right hidden sm:block">
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Business ID</p>
                <p class="text-sm font-mono text-slate-700"><?= $user['business_id'] ?></p>
            </div>
            <div class="h-10 w-10 bg-green-100 rounded-full flex items-center justify-center border border-green-200">
                <div class="h-2 w-2 bg-green-500 rounded-full animate-ping"></div>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 transition hover:shadow-md">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-indigo-50 rounded-xl text-indigo-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Lifetime Orders</span>
            </div>
            <p class="text-3xl font-bold text-slate-800"><?= number_format($total_orders) ?></p>
            <p class="text-xs text-slate-500 mt-1">Total volume processed</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 transition hover:shadow-md">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-emerald-50 rounded-xl text-emerald-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Net Revenue</span>
            </div>
            <p class="text-3xl font-bold text-slate-800">₹<?= number_format($total_earnings, 2) ?></p>
            <p class="text-xs text-emerald-600 mt-1 font-medium">Completed Payouts</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 transition hover:shadow-md">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-orange-50 rounded-xl text-orange-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Active Tasks</span>
            </div>
            <p class="text-3xl font-bold text-slate-800"><?= $confirmed_orders ?></p>
            <p class="text-xs text-orange-600 mt-1 font-medium">Awaiting fulfillment</p>
        </div>

        <div id="weather-card" class="bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-2xl shadow-lg text-white">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-xs font-bold opacity-80 uppercase tracking-widest"><?= htmlspecialchars($city) ?></h3>
                    <p id="temp" class="text-4xl font-black mt-2">--°C</p>
                </div>
                <div id="weather-icon" class="text-3xl">☁️</div>
            </div>
            <p id="condition" class="text-xs mt-3 font-medium opacity-90 tracking-wide">Fetching live weather...</p>
        </div>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Live Inventory Tracker</h3>
                    <p class="text-xs text-slate-400">Current stock levels for your listed products</p>
                </div>
                <a href="inventory.php" class="px-4 py-2 bg-slate-50 text-slate-600 rounded-xl text-xs font-bold hover:bg-slate-100 transition">Manage All</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach($inventory as $item): 
                    $percent = min(($item['stock_quantity'] / 500) * 100, 100); // Assuming 500 is max capacity
                    $color = ($item['stock_quantity'] < 50) ? 'bg-red-500' : 'bg-green-500';
                ?>
                <div class="p-4 rounded-2xl border border-slate-50 hover:border-green-100 transition group">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-bold text-slate-700 group-hover:text-green-600 transition"><?= htmlspecialchars($item['product_name']) ?></span>
                        <span class="text-xs font-mono text-slate-400"><?= $item['stock_quantity'] ?> kg</span>
                    </div>
                    <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                        <div class="<?= $color ?> h-full transition-all duration-1000" style="width: <?= $percent ?>%"></div>
                    </div>
                    <div class="flex justify-between mt-2">
                        <span class="text-[10px] text-slate-400 font-bold uppercase">Rate: ₹<?= $item['price'] ?>/kg</span>
                        <span class="text-[10px] font-bold <?= $item['stock_quantity'] < 50 ? 'text-red-500' : 'text-slate-300' ?>">
                            <?= $item['stock_quantity'] < 50 ? 'RESTOCK SOON' : 'STABLE' ?>
                        </span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
                <h3 class="font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="h-2 w-2 bg-red-500 rounded-full"></span> 
                    Priority Alerts
                </h3>
                <div class="space-y-4">
                    <?php if($confirmed_orders > 0): ?>
                    <div class="p-4 bg-blue-50 border-l-4 border-blue-500 rounded-r-xl">
                        <p class="text-xs font-bold text-blue-700">ORDER ACTION REQUIRED</p>
                        <p class="text-[11px] text-blue-600 mt-1">You have <?= $confirmed_orders ?> orders that need to be marked as 'Completed'.</p>
                    </div>
                    <?php endif; ?>

                    <div class="p-4 bg-slate-50 border-l-4 border-slate-300 rounded-r-xl">
                        <p class="text-xs font-bold text-slate-700">SERVICE AREA</p>
                        <p class="text-[11px] text-slate-500 mt-1">Currently serving: <?= htmlspecialchars($user['service_area'] ?? 'General') ?></p>
                    </div>
                </div>
            </div>

            <button class="w-full py-4 bg-slate-900 text-white rounded-2xl font-bold text-sm hover:bg-slate-800 transition-all shadow-lg shadow-slate-200">
                Generate Monthly Report
            </button>
        </div>
    </section>
</main>

<script>
    // LIVE WEATHER API
    async function fetchWeather() {
        const city = "<?= $city ?>";
        // You can get a free key from OpenWeatherMap
        const apiKey = "YOUR_API_KEY_HERE"; 
        
        // Using a mock fetch for demonstration if no API key
        try {
            // Uncomment the lines below and add your API Key to use real data
            // const response = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${apiKey}`);
            // const data = await response.json();
            // document.getElementById('temp').innerText = Math.round(data.main.temp) + '°C';
            // document.getElementById('condition').innerText = data.weather[0].description.toUpperCase();

            // Static Placeholder Logic
            document.getElementById('temp').innerText = '28°C';
            document.getElementById('condition').innerText = 'PARTLY CLOUDY';
        } catch (error) {
            console.log("Weather error", error);
        }
    }
    fetchWeather();
</script>

</body>
</html>