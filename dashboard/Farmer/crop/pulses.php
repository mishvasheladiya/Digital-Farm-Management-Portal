<?php
session_start();

/* ---------- 1. DATABASE CONNECTION ---------- */
$conn = mysqli_connect("localhost", "root", "", "farm");
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }

/* ---------- 2. AUTH & FARMER DATA ---------- */
if (!isset($_SESSION['email']) || $_SESSION['user_type'] !== 'Farmer') {
    header("Location: ../../../components/login.php"); 
    exit;
}

$email = $_SESSION['email'];
$sql_f = "SELECT farmer_id FROM farmers WHERE email = ?";
$stmt_f = mysqli_prepare($conn, $sql_f);
mysqli_stmt_bind_param($stmt_f, "s", $email);
mysqli_stmt_execute($stmt_f);
$res_f = mysqli_stmt_get_result($stmt_f);
$farmer = mysqli_fetch_assoc($res_f);
$farmer_id = $farmer['farmer_id'];

/* ---------- 3. FETCH DATA & ANALYTICS (Logic updated for Re-opening) ---------- */
/**
 * Logic: confirmed_order will only hold an ID if there is an order 
 * that is NOT 'Cancelled'. If a deal is cancelled, the subquery 
 * returns NULL, letting the "Inquiries" button show again.
 */
$query = "SELECT p.*, 
          (SELECT o.order_id FROM orders o 
           WHERE o.product_id = p.id AND o.status != 'Cancelled' LIMIT 1) as confirmed_order,
          (SELECT o.status FROM orders o 
           WHERE o.product_id = p.id AND o.status != 'Cancelled' LIMIT 1) as current_order_status,
          (SELECT COUNT(*) FROM product_interests WHERE product_id = p.id) as interest_count 
          FROM products p 
          WHERE p.farmer_id = ? AND p.category = 'Pulses' 
          ORDER BY p.created_at DESC";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $farmer_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$crops = [];
$total_stock = 0;
$total_value = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $crops[] = $row;
    $total_stock += $row['stock_quantity'];
    $total_value += ($row['price'] * $row['stock_quantity']);
}
$total_items = count($crops);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pulses Inventory | GreenAgro Pro</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { background-color: #f8fafc; color: #1e293b; font-family: 'Plus Jakarta Sans', sans-serif; }
        .item-row { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: 1px solid transparent; }
        .item-row:hover {
            background-color: #ffffff;
            box-shadow: 0 20px 25px -5px rgba(79, 70, 229, 0.06);
            transform: translateY(-2px);
            border-color: #e0e7ff;
        }
        #distributorList::-webkit-scrollbar { width: 6px; }
        #distributorList::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>
<body class="antialiased">

<?php include '../header.php'; ?>

<main class="max-w-7xl mx-auto px-6 py-10">
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-[2rem] border border-indigo-100 shadow-sm flex items-center gap-5">
            <div class="bg-indigo-50 p-4 rounded-2xl text-indigo-600"><i data-lucide="layers" class="w-6 h-6"></i></div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Pulse Categories</p>
                <p class="text-2xl font-extrabold text-slate-800"><?= $total_items ?> Varieties</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-[2rem] border border-indigo-100 shadow-sm flex items-center gap-5">
            <div class="bg-indigo-50 p-4 rounded-2xl text-indigo-500"><i data-lucide="weight" class="w-6 h-6"></i></div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Weight</p>
                <p class="text-2xl font-extrabold text-slate-800"><?= number_format($total_stock) ?> <span class="text-sm font-medium">kg</span></p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-[2rem] border border-indigo-100 shadow-sm flex items-center gap-5">
            <div class="bg-indigo-50 p-4 rounded-2xl text-indigo-600"><i data-lucide="wallet" class="w-6 h-6"></i></div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Inventory Value</p>
                <p class="text-2xl font-extrabold text-slate-800">₹<?= number_format($total_value, 0) ?></p>
            </div>
        </div>
    </div>

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
        <div>
            <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 uppercase">Pulses<span class="text-indigo-500 font-light ml-2">Stock</span></h1>
            <p class="text-slate-500 mt-2 font-medium">Manage your protein-rich legume inventory and wholesale pricing.</p>
        </div>
        <a href="Catalog.php" class="flex items-center gap-2 bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold hover:bg-indigo-600 shadow-lg transition-all active:scale-95">
            <i data-lucide="plus" class="w-5 h-5"></i>
            Add New Pulse
        </a>
    </div>

    <div class="space-y-4">
        <div class="hidden md:grid grid-cols-12 px-10 py-3 text-[11px] font-black uppercase tracking-[0.2em] text-slate-400">
            <div class="col-span-5">Legume Identification</div>
            <div class="col-span-2">Stock in Hand</div>
            <div class="col-span-2">Market Rate</div>
            <div class="col-span-2 text-center">Buyer Interest</div>
            <div class="col-span-1 text-right">Action</div>
        </div>

        <?php if ($total_items > 0): ?>
            <?php foreach ($crops as $item): 
                $img_path = !empty($item['image_path']) ? "../" . $item['image_path'] : "https://placehold.co/400x400?text=Pulses";
                $low_stock = ($item['stock_quantity'] < 50); 
            ?>
            <div class="item-row bg-white/60 border border-slate-100 rounded-[2.5rem] p-5 md:px-10 md:py-6 grid grid-cols-1 md:grid-cols-12 items-center gap-6">
                
                <div class="col-span-1 md:col-span-5 flex items-center gap-6">
                    <img src="<?= $img_path ?>" 
                         onerror="this.src='https://placehold.co/400x400/e0e7ff/4338ca?text=Pulses'"
                         class="w-20 h-20 rounded-[1.8rem] object-cover shadow-sm border-2 border-white" alt="Pulse">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 leading-none mb-2"><?= htmlspecialchars($item['product_name']) ?></h3>
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-400 uppercase tracking-wider">
                            <i data-lucide="archive" class="w-3.5 h-3.5 text-indigo-500"></i> Storage: <?= htmlspecialchars($item['farm_location']) ?>
                        </span>
                    </div>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <p class="text-[10px] font-bold text-slate-400 uppercase mb-2 md:hidden">Quantity</p>
                    <div class="flex items-baseline gap-1">
                        <span class="text-2xl font-black <?= $low_stock ? 'text-rose-500' : 'text-slate-800' ?>">
                            <?= number_format($item['stock_quantity']) ?>
                        </span>
                        <span class="text-xs font-bold text-slate-400 uppercase">kg</span>
                    </div>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <p class="text-[10px] font-bold text-slate-400 uppercase mb-2 md:hidden">Rate</p>
                    <div class="text-2xl font-black text-slate-900">
                        <span class="text-indigo-500 text-sm font-bold mr-0.5">₹</span><?= number_format($item['price'], 2) ?>
                    </div>
                </div>

                <div class="col-span-1 md:col-span-2 flex flex-col items-center">
                    <p class="text-[10px] font-bold text-slate-400 uppercase mb-2 md:hidden">Buyer Interest</p>
                    
                    <?php if($item['confirmed_order']): ?>
                        <div class="flex flex-col items-center">
                            <span class="text-slate-400 text-[10px] font-bold uppercase tracking-widest italic opacity-60">
                                Trade Locked
                            </span>
                            <span class="text-indigo-600 text-[9px] font-black uppercase"><?= $item['current_order_status'] ?></span>
                        </div>
                    <?php elseif($item['interest_count'] > 0): ?>
                        <button onclick="openInterestModal(<?= $item['id'] ?>, '<?= htmlspecialchars($item['product_name']) ?>')" 
                                class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-slate-900 transition-all shadow-md flex items-center gap-2">
                            <i data-lucide="hand-metal" class="w-4 h-4"></i>
                            <?= $item['interest_count'] ?> Inquiries
                        </button>
                    <?php else: ?>
                        <span class="text-slate-300 text-xs font-bold uppercase tracking-widest">No Bids</span>
                    <?php endif; ?>
                </div>

                <div class="col-span-1 md:col-span-1 flex justify-end">
                    <?php if ($item['confirmed_order']): ?>
                        <span class="flex items-center gap-1.5 px-4 py-2 bg-emerald-100 text-emerald-700 rounded-2xl text-[10px] font-black uppercase tracking-wider border border-emerald-200 shadow-sm">
                            <i data-lucide="check-circle" class="w-3.5 h-3.5"></i> Confirmed
                        </span>
                    <?php else: ?>
                        <button onclick="requestSecureDelete(<?= $item['id'] ?>, '<?= addslashes($item['product_name']) ?>')" 
                                class="p-3 bg-rose-50 text-rose-600 rounded-2xl hover:bg-rose-600 hover:text-white transition-all">
                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="py-32 text-center bg-white rounded-[4rem] border border-indigo-100 shadow-sm">
                <div class="bg-indigo-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="shopping-bag" class="w-10 h-10 text-indigo-200"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-800 tracking-tight">No Pulse Records</h3>
                <a href="Catalog.php" class="inline-block mt-8 bg-indigo-600 text-white px-10 py-4 rounded-full font-bold shadow-lg hover:bg-indigo-700 transition-all">Add First Pulse</a>
            </div>
        <?php endif; ?>
    </div>
</main>

<div id="interestModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white w-full max-w-lg rounded-[2.5rem] shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
        <div class="px-8 py-6 bg-indigo-600 text-white flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold" id="modalProdName">Negotiation Leads</h2>
                <p class="text-indigo-100 text-[10px] font-black uppercase tracking-[0.2em] mt-1">Direct Wholesale Inquiries</p>
            </div>
            <button onclick="closeModal()" class="p-2 hover:bg-indigo-500 rounded-xl transition-colors">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>
        
        <div id="distributorList" class="p-6 max-h-[400px] overflow-y-auto space-y-3"></div>
    </div>
</div>

<script>
    lucide.createIcons();

    function openInterestModal(productId, productName) {
        document.getElementById('modalProdName').innerText = productName;
        const modal = document.getElementById('interestModal');
        const list = document.getElementById('distributorList');
        
        modal.classList.remove('hidden');
        list.innerHTML = `<div class="py-10 text-center"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-500 mx-auto"></div></div>`;

        fetch(`fetch_interests.php?product_id=${productId}`)
            .then(res => res.json())
            .then(data => {
                if(data.length > 0) {
                    list.innerHTML = data.map(d => `
                        <div class="flex items-center justify-between p-4 bg-indigo-50/50 rounded-2xl border border-indigo-100 hover:border-indigo-300 transition-colors">
                            <div>
                                <p class="font-bold text-slate-800">${d.first_name} ${d.last_name}</p>
                                <p class="text-[10px] font-bold text-indigo-600 uppercase tracking-tight">${d.company_name} • ${d.city}</p>
                            </div>
                            <button onclick="confirmDeal(${d.distributor_id}, ${productId})" 
                                    class="bg-slate-900 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-indigo-600 shadow-sm transition-all">
                                Accept Bid
                            </button>
                        </div>
                    `).join('');
                } else {
                    list.innerHTML = `<p class="text-center py-10 text-slate-400 font-medium">No distributors have bid on this stock yet.</p>`;
                }
            })
            .catch(err => {
                list.innerHTML = `<p class="text-center py-10 text-rose-500 font-medium">Server connection failed.</p>`;
            });
    }

    function closeModal() {
        document.getElementById('interestModal').classList.add('hidden');
    }

    function confirmDeal(distId, prodId) {
        if(confirm("Accept this inquiry? This will initiate the trade documentation process with the distributor.")) {
            window.location.href = `confirm_deal.php?dist_id=${distId}&prod_id=${prodId}`;
        }
    }

    function requestSecureDelete(id, name) {
        if (confirm(`SYSTEM CLEARANCE:\n\nAre you sure you want to delete ${name} from your inventory?`)) {
            window.location.href = `delete_product.php?id=${id}`;
        }
    }
</script>
</body>
</html>