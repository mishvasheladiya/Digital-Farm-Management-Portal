<?php
$base_url = "/farm/";
require_once "../../components/db.php";

/* ---------- SESSION ---------- */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* ---------- AUTH CHECK ---------- */
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Farmer') {
    header("Location: " . $base_url . "components/login.php");
    exit;
}

$farmer_id = $_SESSION['user_id'];

/* ---------- UPDATE PROFILE LOGIC + NOTIFICATION TRIGGER ---------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $first_name        = $_POST['first_name'];
    $last_name         = $_POST['last_name'];
    $mobile            = $_POST['mobile'];
    $address           = $_POST['address'];
    $farm_name         = $_POST['farm_name'];
    $main_crops        = $_POST['main_crops'];
    $irrigation_method = $_POST['irrigation_method'];

    // 1. Update Profile
    $update = $conn->prepare("UPDATE farmers SET first_name=?, last_name=?, mobile=?, address=?, farm_name=?, main_crops=?, irrigation_method=? WHERE farmer_id=?");
    $update->bind_param("sssssssi", $first_name, $last_name, $mobile, $address, $farm_name, $main_crops, $irrigation_method, $farmer_id);

    if ($update->execute()) {
        // 2. Insert Notification for the user
        $notif_title = "Profile Updated";
        $notif_msg = "Your profile information was successfully updated on " . date('d M, Y h:i A');
        $notif_type = "success";

        $notif_stmt = $conn->prepare("INSERT INTO notifications (farmer_id, title, message, type, is_read) VALUES (?, ?, ?, ?, 0)");
        $notif_stmt->bind_param("isss", $farmer_id, $notif_title, $notif_msg, $notif_type);
        $notif_stmt->execute();
        $notif_stmt->close();

        echo "<script>alert('Profile updated successfully'); window.location.href='profile.php';</script>";
        exit;
    }
}

/* ---------- FETCH PROFILE ---------- */
$stmt = $conn->prepare("SELECT * FROM farmers WHERE farmer_id = ?");
$stmt->bind_param("i", $farmer_id);
$stmt->execute();
$result = $stmt->get_result();
$farmer = $result->fetch_assoc();

if (!$farmer) {
    $farmer = [
        'first_name' => 'Guest', 'last_name' => 'Farmer', 'email' => '', 'mobile' => '', 
        'address' => '', 'city' => '', 'state' => '', 'postal_code' => '', 
        'farm_name' => 'N/A', 'main_crops' => '', 'irrigation_method' => 'rainfed', 
        'latitude' => '0', 'longitude' => '0', 'email_notif_enabled' => 1
    ];
}

$farmer_name = htmlspecialchars($farmer['first_name'] . ' ' . $farmer['last_name']);

/* ---------- FETCH RECENT NOTIFICATIONS ---------- */
$notifications = [];
$notif_stmt = $conn->prepare("SELECT * FROM notifications WHERE farmer_id = ? ORDER BY created_at DESC LIMIT 5");
$notif_stmt->bind_param("i", $farmer_id);
$notif_stmt->execute();
$notifications_res = $notif_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Profile | GreenAgro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

    <div class="relative pb-24">
        <div class="w-full h-48 bg-gradient-to-r from-green-700 via-green-600 to-emerald-500"></div>
        <div class="max-w-6xl mx-auto px-6">
            <div class="relative -mt-20 flex flex-col md:flex-row items-center md:items-end gap-6">
                <div class="w-40 h-40 rounded-3xl bg-white shadow-2xl p-1 overflow-hidden border-4 border-white">
                    <img src="<?php echo $base_url; ?>assets/image/user.jpg" class="w-full h-full object-cover rounded-2xl" alt="Profile">
                </div>
                <div class="mb-4 text-center md:text-left flex-grow">
                    <div class="flex items-center justify-center md:justify-start gap-3">
                        <h1 class="text-3xl font-bold text-gray-900"><?php echo $farmer_name; ?></h1>
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full uppercase tracking-wider">Verified Farmer</span>
                    </div>
                    <p class="text-gray-500 font-medium"><i class="fa-solid fa-location-dot mr-2 text-green-600"></i><?php echo htmlspecialchars(($farmer['city'] ?? 'N/A') . ', ' . ($farmer['state'] ?? 'N/A')); ?></p>
                </div>
                <div class="mb-4">
                    <a href="profile_settings.php" class="bg-green-600 text-white px-6 py-2 rounded-xl font-semibold shadow-sm hover:bg-green-700 transition flex items-center gap-2">
                        <i class="fa-solid fa-pen-to-square"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <main class="max-w-6xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-8 pb-10">
        <aside class="lg:col-span-4 space-y-6">
            
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center justify-between">Contact Details <i class="fa-solid fa-address-book text-gray-300"></i></h3>
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600"><i class="fa-solid fa-envelope"></i></div>
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase">Email Address</p>
                            <p class="text-sm font-semibold text-gray-700"><?php echo htmlspecialchars($farmer['email'] ?? 'Not set'); ?></p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center text-green-600"><i class="fa-solid fa-phone"></i></div>
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase">Phone Number</p>
                            <p class="text-sm font-semibold text-gray-700">+91 <?php echo htmlspecialchars($farmer['mobile'] ?? 'N/A'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Recent Alerts</h3>
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                </div>
                <div class="space-y-4">
                    <?php if ($notifications_res->num_rows > 0): ?>
                        <?php while($n = $notifications_res->fetch_assoc()): ?>
                            <div class="p-3 rounded-2xl <?php echo $n['is_read'] == 0 ? 'bg-green-50 border border-green-100' : 'bg-gray-50'; ?>">
                                <div class="flex justify-between items-start mb-1">
                                    <h6 class="text-xs font-bold text-gray-800"><?php echo htmlspecialchars($n['title']); ?></h6>
                                    <span class="text-[9px] text-gray-400"><?php echo date('H:i', strtotime($n['created_at'])); ?></span>
                                </div>
                                <p class="text-[11px] text-gray-600 leading-tight"><?php echo htmlspecialchars($n['message']); ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="text-center text-gray-400 text-xs py-4">No recent activity.</p>
                    <?php endif; ?>
                </div>
                <a href="notifications.php" class="block text-center mt-4 text-xs font-bold text-green-600 hover:text-green-700 uppercase tracking-widest">View All</a>
            </div>

        </aside>

        <div class="lg:col-span-8 space-y-6">
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                <h3 class="text-xl font-bold text-gray-800 mb-8 flex items-center gap-2">
                    <span class="w-2 h-8 bg-green-600 rounded-full"></span> Farm Operational Profile
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-4 rounded-2xl bg-gray-50 border border-gray-100">
                        <p class="text-xs font-bold text-gray-400 uppercase mb-2">Farm Entity</p>
                        <p class="text-lg font-bold text-green-800"><?php echo htmlspecialchars($farmer['farm_name'] ?? 'General Farm'); ?></p>
                    </div>
                    <div class="p-4 rounded-2xl bg-gray-50 border border-gray-100">
                        <p class="text-xs font-bold text-gray-400 uppercase mb-2">Water Management</p>
                        <p class="text-lg font-bold text-gray-700 capitalize"><?php echo htmlspecialchars($farmer['irrigation_method'] ?? 'N/A'); ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Activity Overview</h3>
                    <select id="chartRange" class="bg-gray-50 border border-gray-200 text-gray-600 text-sm rounded-xl px-4 py-2 outline-none">
                        <option value="week">This Week</option>
                        <option value="month">This Year</option>
                    </select>
                </div>
                <div class="h-64"><canvas id="activityChart"></canvas></div>
            </div>
        </div>
    </main>

    <script>
        // Activity Chart Data
        const ctx = document.getElementById("activityChart");
        let weekData = [4, 6, 5, 8, 7, 10, 9];
        let monthData = [20, 22, 25, 28, 26, 30, 35, 40, 38, 42, 44, 50];

        let activityChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                datasets: [{
                    label: "Activity",
                    data: weekData,
                    borderColor: "#16a34a",
                    backgroundColor: "rgba(22, 163, 74, 0.05)",
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 0
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { display: false },
                    x: { grid: { display: false } }
                }
            }
        });

        document.getElementById("chartRange").addEventListener("change", function () {
            if (this.value === "month") {
                activityChart.data.labels = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
                activityChart.data.datasets[0].data = monthData;
            } else {
                activityChart.data.labels = ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"];
                activityChart.data.datasets[0].data = weekData;
            }
            activityChart.update();
        });
    </script>
</body>
</html>