<?php
session_start();

/* ---------- DATABASE CONNECTION ---------- */
// Using mysqli for consistency with your existing code
$conn = mysqli_connect("localhost", "root", "", "farm");
if (!$conn) die("DB Error: " . mysqli_connect_error());

/* ---------- AUTH CHECK & FETCH DISTRIBUTOR ID ---------- */
if (!isset($_SESSION['email'])) {
    header("Location: ../../components/login.php");
    exit;
}

$email = $_SESSION['email'];

$sql = "SELECT distributor_id FROM distributors WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$dist = mysqli_fetch_assoc($res);

if (!$dist) {
    die("Distributor record not found in database.");
}

$dist_id = $dist['distributor_id'];

/* ---------- FETCH ORDERS ---------- */
$query = "
SELECT 
    o.order_id,
    o.status,
    o.created_at,
    o.quantity AS order_qty,    
    o.price AS order_price,      
    o.total_price AS final_total,
    p.product_name,
    p.category,
    p.image_path,
    p.farm_location,
    f.first_name AS farmer_name
FROM orders o
JOIN products p ON o.product_id = p.id
JOIN farmers f ON o.farmer_id = f.farmer_id
WHERE o.distributor_id = ?
ORDER BY o.created_at DESC
";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $dist_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Orders | GreenAgro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50">

<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto px-6 py-10">

    <div class="mb-10">
        <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">
            My <span class="text-emerald-600">Orders</span>
        </h1>
        <p class="text-slate-500 mt-2">
            Track your confirmed commodity purchases and trade status.
        </p>
    </div>

    <div class="space-y-6">

    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <?php
                // Image Handling
                $img = !empty($row['image_path'])
                    ? "../Farmer/" . $row['image_path']
                    : "https://placehold.co/400x400?text=Crop";

                // Data Handling from Aliases
                $unit_price  = $row['order_price'] ?? 0;
                $quantity    = $row['order_qty'] ?? 0;
                $total_price = $row['final_total'] ?? ($unit_price * $quantity);
                $order_date  = $row['created_at'];
                $status      = $row['status'];
            ?>

            <div class="bg-white rounded-[1.8rem] p-6 shadow-sm border border-slate-200 hover:shadow-md transition-all duration-300">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    <div class="flex items-center gap-6">
                        <div class="relative">
                            <img src="<?= $img ?>" 
                                 alt="Product"
                                 class="w-28 h-28 rounded-2xl object-cover border border-slate-100 shadow-sm"
                                 onerror="this.src='https://placehold.co/400x400?text=Missing+Image'">
                            <span class="absolute -top-2 -left-2 bg-white px-2 py-1 rounded-md border text-[10px] font-bold shadow-sm">
                                ID: #<?= $row['order_id'] ?>
                            </span>
                        </div>

                        <div>
                            <h3 class="text-xl font-bold text-slate-900 leading-tight">
                                <?= htmlspecialchars($row['product_name']) ?>
                            </h3>

                            <p class="text-sm font-medium text-emerald-600 mt-1">
                                <?= htmlspecialchars($row['category']) ?> • <?= htmlspecialchars($row['farm_location']) ?>
                            </p>

                            <div class="flex items-center gap-2 mt-3">
                                <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-[10px]">👤</div>
                                <p class="text-xs text-slate-500">
                                    Farmer: <span class="font-bold text-slate-700"><?= htmlspecialchars($row['farmer_name']) ?></span>
                                </p>
                            </div>

                            <p class="text-xs mt-2 text-slate-500 flex items-center gap-1">
                                <span class="px-2 py-0.5 bg-slate-100 rounded text-slate-600 font-bold">Qty: <?= number_format($quantity) ?> kg</span>
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col items-start lg:items-end justify-center py-2 lg:border-l lg:pl-10 border-slate-100">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Total Payable</p>
                        <p class="text-3xl font-black text-slate-900 mb-1">
                            ₹<?= number_format($total_price, 2) ?>
                        </p>
                        <p class="text-[11px] text-slate-400 mb-4">
                            ₹<?= number_format($unit_price, 2) ?> per unit
                        </p>

                        <div class="flex flex-col items-start lg:items-end gap-2">
                            <span class="px-4 py-1.5 rounded-xl text-xs font-black tracking-wide shadow-sm
                                <?= $status == 'Confirmed' ? 'bg-amber-50 text-amber-600 border border-amber-100' : '' ?>
                                <?= $status == 'Completed' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : '' ?>
                                <?= $status == 'Cancelled' ? 'bg-rose-50 text-rose-600 border border-rose-100' : '' ?>">
                                ● <?= strtoupper($status) ?>
                            </span>

                            <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase">
                                Ordered: <?= date("d M Y | h:i A", strtotime($order_date)) ?>
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        <?php endwhile; ?>
    <?php else: ?>

        <div class="bg-white rounded-[3rem] p-20 text-center border-2 border-dashed border-slate-200">
            <div class="mx-auto mb-6 w-24 h-24 flex items-center justify-center rounded-full bg-slate-50 text-4xl">
                📦
            </div>
            <h3 class="text-2xl font-black text-slate-800">
                No Transactions Found
            </h3>
            <p class="text-slate-500 mt-2 max-w-sm mx-auto">
                Your order history is empty. Start sourcing high-quality commodities from our marketplace.
            </p>
            <a href="crop.php" class="mt-8 inline-block bg-emerald-600 text-white px-8 py-3 rounded-2xl font-bold hover:bg-emerald-700 transition-colors shadow-lg shadow-emerald-100">
                Browse Marketplace
            </a>
        </div>

    <?php endif; ?>

    </div>
</div>

</body>
</html>