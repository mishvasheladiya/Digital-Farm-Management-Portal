<?php
session_start();
require 'config.php';

// 1. Mark all as read if requested
if (isset($_POST['mark_all_read'])) {
    $conn->query("UPDATE notifications SET is_read = 1 WHERE farmer_id = 0");
    header("Location: notifications.php");
    exit();
}

// 2. Fetch notifications for Admin (ID 0)
$query = "SELECT * FROM notifications WHERE farmer_id = 0 ORDER BY created_at DESC";
$result = $conn->query($query);
$unread_count = $conn->query("SELECT COUNT(*) as unread FROM notifications WHERE farmer_id = 0 AND is_read = 0")->fetch_assoc()['unread'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Center | Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F8FAFC] min-h-screen text-slate-900">

<?php include 'header.php'; ?>

<main class="max-w-4xl mx-auto p-6 lg:p-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight">Notification Center</h1>
            <p class="text-slate-500 font-medium">Manage and track recent farmer activities.</p>
        </div>
        
        <?php if ($unread_count > 0): ?>
        <form method="POST">
            <button name="mark_all_read" class="text-sm font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-2 bg-emerald-50 px-4 py-2 rounded-xl transition-all">
                <i data-lucide="check-check" class="w-4 h-4"></i> Mark all as read
            </button>
        </form>
        <?php endif; ?>
    </div>

    <div class="space-y-4">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="relative group bg-white border <?= $row['is_read'] ? 'border-slate-100' : 'border-emerald-100 shadow-sm shadow-emerald-50' ?> rounded-3xl p-5 flex items-start gap-4 transition-all hover:border-emerald-200">
                    
                    <div class="<?= $row['is_read'] ? 'bg-slate-100 text-slate-400' : 'bg-emerald-100 text-emerald-600' ?> p-3 rounded-2xl">
                        <i data-lucide="<?= strpos($row['title'], 'Alert') !== false ? 'bell-ring' : 'shopping-bag' ?>" class="w-6 h-6"></i>
                    </div>

                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-slate-800"><?= htmlspecialchars($row['title']) ?></h3>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-tight">
                                <?= date('d M, h:i A', strtotime($row['created_at'])) ?>
                            </span>
                        </div>
                        <p class="text-slate-500 text-sm mt-1 leading-relaxed">
                            <?= htmlspecialchars($row['message']) ?>
                        </p>
                    </div>

                    <?php if (!$row['is_read']): ?>
                        <div class="absolute top-5 right-5 w-2 h-2 bg-emerald-500 rounded-full"></div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="bg-white rounded-3xl border border-dashed border-slate-200 p-20 text-center">
                <div class="bg-slate-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                    <i data-lucide="bell-off" class="w-8 h-8"></i>
                </div>
                <h3 class="text-slate-800 font-bold text-lg">All clear!</h3>
                <p class="text-slate-400">No new notifications at the moment.</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<script>
    lucide.createIcons();
</script>
</body>
</html>