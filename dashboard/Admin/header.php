<?php
if (!isset($base_url)) {
    $base_url = '/farm/';
}

// DATABASE LOGIC: Fetch unread count for 'New Inventory Alert' ONLY
$unread_count = 0;
if (isset($conn)) {
    $notif_query = "SELECT COUNT(*) as total FROM notifications WHERE is_read = 0 AND title = 'New Inventory Alert'";
    $notif_result = mysqli_query($conn, $notif_query);
    if ($notif_result) {
        $notif_data = mysqli_fetch_assoc($notif_result);
        $unread_count = $notif_data['total'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GreenAgro</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  <style>
    /* Remove Google translate branding */
    .goog-logo-link, .goog-te-gadget span, .goog-te-banner-frame, #goog-gt-tt { display: none !important; }
    .goog-te-gadget { color: transparent !important; }
    .goog-te-combo { padding: 6px !important; border-radius: 6px; }
  </style>

  <script>
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'en,hi,gu,mr,pa,bn,ta,te,kn,ml,ur,or,as',
            layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
        }, 'google_translate_element');
    }

    function toggleMenu() {
      document.getElementById("mobileMenu").classList.toggle("hidden");
    }

    function markAsVisited(e) {
        e.preventDefault();
        fetch('<?php echo $base_url; ?>dashboard/Admin/mark_read.php')
        .then(() => {
            const badge = document.getElementById('notif-badge');
            if(badge) badge.style.display = 'none';
            window.location.href = "notifications.php";
        })
        .catch(() => window.location.href = "notifications.php");
    }
  </script>
</head>

<body class="bg-gray-50 font-sans">

  <header class="shadow-md sticky top-0 z-50 bg-white">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">

      <div class="flex items-center space-x-3 cursor-pointer">
        <div class="relative bg-gradient-to-tr from-green-600 to-green-400 rounded-full p-[2px]">
          <img src="<?php echo $base_url; ?>assets/image/logo.png" alt="GreenAgro Logo" class="h-10 w-10 rounded-full bg-white p-1">
        </div>
        <div class="hidden sm:block">
          <h1 class="text-lg font-bold text-green-700 tracking-wide leading-none">GreenAgro</h1>
          <p class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold">Organic Marketplace</p>
        </div>
      </div>

      <div class="flex items-center space-x-0 md:space-x-0">

        <a href="notifications.php" onclick="markAsVisited(event)" class="relative p-1.5 text-gray-700 hover:text-green-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
            <?php if ($unread_count > 0): ?>
                <span id="notif-badge" class="absolute top-0.5 right-0.5 bg-red-500 text-white text-[9px] font-bold h-4 w-4 flex items-center justify-center rounded-full border border-white">
                    <?php echo ($unread_count > 9) ? '9+' : $unread_count; ?>
                </span>
            <?php endif; ?>
        </a>

        <a href="<?php echo $base_url; ?>dashboard/Admin/profile.php" class="p-1.5 text-gray-700 hover:text-green-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
        </a>

        <a href="<?php echo $base_url; ?>dashboard/Admin/setting.php" class="p-1.5 text-gray-700 hover:text-green-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.332.183-.582.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </a>

        <div id="google_translate_element" style="display:none;"></div>

        <button class="lg:hidden p-2 text-green-700" onclick="toggleMenu()">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>

      </div>
    </div>

    <div class="hidden lg:flex justify-center space-x-8 py-2 bg-gradient-to-r from-gray-500 to-green-500 text-white text-sm font-medium tracking-wide shadow-inner">
      <a href="<?php echo $base_url; ?>dashboard/Admin/dashboard.php" class="hover:text-yellow-200 transition-colors">Dashboard</a>
      <a href="<?php echo $base_url; ?>dashboard/Admin/farmer.php" class="hover:text-yellow-200 transition-colors">Farmer</a>
      <a href="<?php echo $base_url; ?>dashboard/Admin/distributor.php" class="hover:text-yellow-200 transition-colors">Distributor</a>
      <a href="<?php echo $base_url; ?>dashboard/Admin/product.php" class="hover:text-yellow-200 transition-colors">Products</a>
      <a href="<?php echo $base_url; ?>dashboard/Admin/order.php" class="hover:text-yellow-200 transition-colors">Orders</a>
    </div>

    <div id="mobileMenu" class="hidden lg:hidden bg-gradient-to-r from-green-600 to-green-500 text-white flex flex-col space-y-3 px-6 py-4">
      <a href="<?php echo $base_url; ?>dashboard/Admin/dashboard.php" class="py-1">Dashboard</a>
      <a href="<?php echo $base_url; ?>dashboard/Admin/farmer.php" class="py-1">Farmer</a>
      <a href="<?php echo $base_url; ?>dashboard/Admin/distributor.php" class="py-1">Distributor</a>
      <a href="<?php echo $base_url; ?>dashboard/Admin/product.php" class="py-1">Products</a>
      <a href="<?php echo $base_url; ?>dashboard/Admin/order.php" class="py-1">Orders</a>
    </div>
  </header>