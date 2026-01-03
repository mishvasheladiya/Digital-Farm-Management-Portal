<?php
session_start();
require 'config.php';

// --- LOGIC: UPDATE STATUS (ACTIVE/BLOCKED/PENDING) ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $dist_id = intval($_POST['dist_id']);
    $new_status = $_POST['status'];
    
    $stmt = $conn->prepare("UPDATE distributors SET status = ? WHERE distributor_id = ?");
    $stmt->bind_param("si", $new_status, $dist_id);
    
    if ($stmt->execute()) {
        $message = "Status updated to " . strtoupper($new_status) . " successfully.";
    } else {
        $message = "Error updating status: " . $conn->error;
    }
}

// --- AJAX LOGIC: FETCH FULL DISTRIBUTOR PROFILE ---
if (isset($_GET['get_dist_profile'])) {
    $did = intval($_GET['get_dist_profile']);
    $stmt = $conn->prepare("SELECT * FROM distributors WHERE distributor_id = ?");
    $stmt->bind_param("i", $did);
    $stmt->execute();
    $dist = $stmt->get_result()->fetch_assoc();

    if ($dist) {
        $statusColor = $dist['status'] == 'active' ? 'bg-green-500' : ($dist['status'] == 'blocked' ? 'bg-red-500' : 'bg-yellow-500');
        echo '
        <div class="flex items-center justify-between mb-8">
            <button onclick="showSection(\'distList\')" class="flex items-center gap-2 text-blue-600 font-bold group">
                <span class="group-hover:-translate-x-1 transition-transform">←</span> Back to List
            </button>
            <div class="flex gap-3">
                <form method="POST" class="flex gap-2">
                    <input type="hidden" name="dist_id" value="'.$dist['distributor_id'].'">
                    <input type="hidden" name="update_status" value="1">
                    '.($dist['status'] != 'active' ? '<button name="status" value="active" class="bg-green-100 text-green-700 px-4 py-2 rounded-xl text-sm font-bold hover:bg-green-600 hover:text-white transition">Activate</button>' : '').'
                    '.($dist['status'] != 'blocked' ? '<button name="status" value="blocked" class="bg-red-100 text-red-700 px-4 py-2 rounded-xl text-sm font-bold hover:bg-red-600 hover:text-white transition">Block</button>' : '').'
                </form>
            </div>
        </div>

        <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white mb-10 shadow-2xl relative overflow-hidden">
            <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
                <div class="w-32 h-32 rounded-3xl bg-blue-500 flex items-center justify-center text-4xl font-bold border-4 border-white/10">
                    '.substr($dist['company_name'], 0, 1).'
                </div>
                <div class="flex-1 text-center md:text-left">
                    <h2 class="text-4xl font-bold mb-2">'.$dist['company_name'].'</h2>
                    <p class="text-blue-300 font-medium mb-4">Business ID: '.$dist['business_id'].'</p>
                    <div class="flex flex-wrap justify-center md:justify-start gap-3">
                        <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider '.$statusColor.' text-white">'.$dist['status'].'</span>
                        <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-white/10 backdrop-blur text-white">'.$dist['city'].', '.$dist['state'].'</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100">
                <h3 class="font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-2 bg-blue-600 rounded-full"></span> Contact Information
                </h3>
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] uppercase font-bold text-gray-400 tracking-widest mb-1">Point of Contact</p>
                        <p class="text-gray-800 font-medium">'.$dist['first_name'].' '.$dist['last_name'].'</p>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-bold text-gray-400 tracking-widest mb-1">Email Address</p>
                        <p class="text-gray-800 font-medium">'.$dist['email'].'</p>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-bold text-gray-400 tracking-widest mb-1">Mobile Number</p>
                        <p class="text-gray-800 font-medium">'.$dist['mobile'].'</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm">
                    <h3 class="font-bold text-gray-800 mb-6">Service & Logistics</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400 tracking-widest mb-1">Service Area</p>
                            <p class="text-gray-800">'.$dist['service_area'].'</p>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400 tracking-widest mb-1">Min. Order Value</p>
                            <p class="text-blue-600 font-bold text-lg">₹'.number_format($dist['min_order'], 2).'</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-[10px] uppercase font-bold text-gray-400 tracking-widest mb-1">Registered Address</p>
                            <p class="text-gray-600">'.$dist['address'].', '.$dist['city'].', '.$dist['state'].' - '.$dist['postal_code'].'</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm">
                    <h3 class="font-bold text-gray-800 mb-4">Product Portfolio</h3>
                    <p class="text-gray-600 leading-relaxed">'.$dist['products'].'</p>
                </div>
            </div>
        </div>';
    }
    exit;
}

// --- FETCH DATA FOR LISTING ---
$all_distributors = $conn->query("SELECT * FROM distributors ORDER BY created_at DESC");
$total_count = $conn->query("SELECT COUNT(*) as total FROM distributors")->fetch_assoc()['total'];
$active_count = $conn->query("SELECT COUNT(*) as total FROM distributors WHERE status='active'")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Distributor Directory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .section { display: none; }
        .show { display: block; animation: fade 0.4s ease-in-out; }
        @keyframes fade { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<?php include 'header.php'; ?>
<body class="bg-gray-100 min-h-screen">

<main class="max-w-7xl mx-auto p-6">
    
    <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-6">
        <div>
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Distributors</h1>
            <p class="text-gray-500 mt-2 font-medium">Manage your supply chain network and partner accounts.</p>
        </div>
        <div class="flex gap-4">
            <div class="bg-white p-5 rounded-3xl shadow-sm border border-gray-100 min-w-[140px]">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Partners</p>
                <p class="text-2xl font-black text-gray-800"><?= $total_count ?></p>
            </div>
            <div class="bg-white p-5 rounded-3xl shadow-sm border border-gray-100 min-w-[140px]">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Active Now</p>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    <p class="text-2xl font-black text-green-600"><?= $active_count ?></p>
                </div>
            </div>
        </div>
    </div>

    <?php if(isset($message)): ?>
        <div class="bg-blue-600 text-white p-4 mb-6 rounded-2xl shadow-lg flex justify-between items-center">
            <span class="font-medium"><?= $message ?></span>
            <button onclick="this.parentElement.remove()" class="text-white/50 hover:text-white">✕</button>
        </div>
    <?php endif; ?>

    <div id="distList" class="section show">
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 border-b border-gray-50 flex flex-col md:flex-row justify-between items-center gap-4">
                <h3 class="text-xl font-bold text-gray-800">Partner Directory</h3>
                <div class="relative w-full md:w-80">
                    <input type="text" id="distSearch" placeholder="Search company or city..." class="w-full bg-gray-50 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-blue-500 transition">
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] uppercase tracking-widest text-gray-400 font-bold border-b border-gray-50">
                            <th class="px-8 py-5">Company</th>
                            <th class="px-8 py-5">Service Area</th>
                            <th class="px-8 py-5">Min Order</th>
                            <th class="px-8 py-5">Status</th>
                            <th class="px-8 py-5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php while($dist = $all_distributors->fetch_assoc()): ?>
                        <tr class="hover:bg-blue-50/30 transition group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center font-bold text-gray-500 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                        <?= substr($dist['company_name'], 0, 1) ?>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900"><?= $dist['company_name'] ?></p>
                                        <p class="text-xs text-gray-400"><?= $dist['email'] ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-sm text-gray-600 font-medium"><?= $dist['service_area'] ?></td>
                            <td class="px-8 py-6 text-sm font-bold text-gray-900">₹<?= number_format($dist['min_order']) ?></td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-tighter <?= $dist['status'] == 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                                    <?= $dist['status'] ?>
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <button onclick="fetchDistProfile(<?= $dist['distributor_id'] ?>)" class="bg-blue-50 text-blue-600 px-4 py-2 rounded-xl text-xs font-bold hover:bg-blue-600 hover:text-white transition">
                                    Manage
                                </button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="distProfile" class="section mt-4 bg-white p-2 rounded-[3rem] shadow-sm border border-gray-100 min-h-[400px]">
        <div id="profileContainer" class="p-8">
            </div>
    </div>

</main>

<script>
    // Navigation Logic
    function showSection(id) {
        document.querySelectorAll(".section").forEach(sec => sec.classList.remove("show"));
        document.getElementById(id).classList.add("show");
        window.scrollTo({ top: 0, behavior: "smooth" });
    }

    // AJAX Fetch
    function fetchDistProfile(id) {
        const container = document.getElementById('profileContainer');
        container.innerHTML = `
            <div class="flex flex-col items-center justify-center py-20">
                <div class="w-12 h-12 border-4 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
                <p class="mt-4 text-gray-400 font-bold uppercase text-[10px] tracking-widest">Loading Partner Data...</p>
            </div>
        `;
        
        showSection('distProfile');

        fetch(`distributor.php?get_dist_profile=${id}`)
            .then(response => response.text())
            .then(html => {
                container.innerHTML = html;
            })
            .catch(error => {
                container.innerHTML = `<p class="text-red-500 text-center">Failed to load profile. Please refresh.</p>`;
            });
    }

    // Quick Search (Frontend)
    document.getElementById('distSearch')?.addEventListener('keyup', function() {
        let filter = this.value.toUpperCase();
        let rows = document.querySelector("#distList table tbody").rows;
        for (let i = 0; i < rows.length; i++) {
            let company = rows[i].cells[0].innerText;
            let area = rows[i].cells[1].innerText;
            if (company.toUpperCase().indexOf(filter) > -1 || area.toUpperCase().indexOf(filter) > -1) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    });
</script>

</body>
</html>