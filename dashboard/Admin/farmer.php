<?php
session_start();
require 'config.php';

// --- LOGIC: HANDLE BLOCK ACTION ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['block_id'])) {
    $block_id = (int)$_POST['block_id'];
    $message = "Farmer hidden from your directory.";
}

// --- LOGIC: FETCH SEARCH QUERY ---
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$query = "SELECT farmer_id, first_name, last_name, city, farm_name FROM farmers";
if (!empty($search)) {
    $query .= " WHERE farm_name LIKE '%$search%' OR city LIKE '%$search%' OR first_name LIKE '%$search%'";
}
$all_farmers = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory | AgriConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #fcfcfd; }
        
        .glass-search {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        
        .farmer-card {
            transition: all 0.3s ease;
            border: 1px solid #f1f5f9;
        }
        .farmer-card:hover {
            border-color: #10b981;
            box-shadow: 0 12px 24px -10px rgba(16, 185, 129, 0.15);
        }
    </style>
</head>
<body class="text-slate-900">

<?php include 'header.php'; ?>

<div class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 py-4 mb-8">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold tracking-tight">Farmers Directory</h1>
            <p class="text-xs text-slate-500 font-medium">Manage and explore agricultural partners</p>
        </div>
        
        <form method="GET" class="relative group w-full md:w-80">
            <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 group-focus-within:text-emerald-500"></i>
            <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" 
                   placeholder="Find a farm..." 
                   class="w-full pl-10 pr-4 py-2 bg-slate-100/50 border-transparent rounded-xl focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all text-sm">
        </form>
    </div>
</div>

<main class="max-w-7xl mx-auto px-6 pb-20">

    <?php if(isset($message)): ?>
        <div class="mb-6 p-3 bg-slate-900 text-white text-xs font-bold rounded-lg flex items-center gap-2 w-fit mx-auto animate-bounce">
            <i data-lucide="info" class="w-3.5 h-3.5"></i> <?= $message ?>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php while($farmer = $all_farmers->fetch_assoc()): ?>
        <div class="farmer-card bg-white rounded-2xl p-5 flex flex-col h-full relative">
            
            <form method="POST" class="absolute top-4 right-4" onsubmit="return confirm('Hide this farmer?');">
                <input type="hidden" name="block_id" value="<?= $farmer['farmer_id'] ?>">
                <button type="submit" class="text-slate-300 hover:text-red-500 transition-colors p-1">
                    <i data-lucide="ban" class="w-4 h-4"></i>
                </button>
            </form>

            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 font-bold">
                    <?= substr($farmer['farm_name'], 0, 1) ?>
                </div>
                <div>
                    <h3 class="font-bold text-slate-800 leading-none mb-1"><?= htmlspecialchars($farmer['farm_name']) ?></h3>
                    <div class="flex items-center gap-1 text-slate-400">
                        <i data-lucide="map-pin" class="w-3 h-3"></i>
                        <span class="text-[11px] font-medium"><?= htmlspecialchars($farmer['city']) ?></span>
                    </div>
                </div>
            </div>

            <div class="bg-slate-50 rounded-xl p-3 mb-6 flex flex-col gap-2">
                <div class="flex justify-between items-center">
                    <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Owner</span>
                    <span class="text-xs font-semibold text-slate-700"><?= htmlspecialchars($farmer['first_name']) ?></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Status</span>
                    <span class="text-[10px] font-black text-emerald-600 bg-emerald-100 px-1.5 py-0.5 rounded uppercase">Verified</span>
                </div>
            </div>

            <div class="mt-auto">
                <a href="farmer_profile.php?id=<?= $farmer['farmer_id'] ?>" 
                   class="w-full bg-slate-50 text-slate-800 border border-slate-100 py-3 rounded-xl text-xs font-bold hover:bg-emerald-600 hover:text-white hover:border-emerald-600 transition-all flex items-center justify-center gap-2">
                    Open Profile
                    <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
        </div>
        <?php endwhile; ?>

        <div class="border-2 border-dashed border-slate-100 rounded-2xl p-5 flex flex-center flex-col items-center justify-center min-h-[220px] opacity-50 hover:opacity-100 transition-opacity cursor-pointer">
            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center mb-2">
                <i data-lucide="plus" class="w-5 h-5 text-slate-400"></i>
            </div>
            <p class="text-xs font-bold text-slate-400">Invite Farmer</p>
        </div>
    </div>
</main>

<script>
    lucide.createIcons();
</script>
</body>
</html>