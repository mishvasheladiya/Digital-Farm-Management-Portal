<?php
if (!isset($base_url)) {
    $base_url = '/farm/';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Farmer Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


  <style>
    /* Remove Google translate branding */
    .goog-logo-link, .goog-te-gadget span, .goog-te-banner-frame, #goog-gt-tt { display: none !important; }
    .goog-te-gadget { color: transparent !important; }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-6px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .goog-logo-link,
.goog-te-gadget span,
.goog-te-banner-frame,
#goog-gt-tt {
    display: none !important;
}
.goog-te-gadget {
    color: transparent !important;
}
.goog-te-combo {
    padding: 6px !important;
    border-radius: 6px;
}
  </style>

  <script>
    function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'en',
        includedLanguages: 'en,hi,gu,mr,pa,bn,ta,te,kn,ml,ur,or,as',
        layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
    }, 'google_translate_element');
}

function changeLanguage(lang) {
    const select = document.querySelector('.goog-te-combo');
    if (select) {
        select.value = lang;
        select.dispatchEvent(new Event("change"));
    }
}
  </script>

</head>

<body class="bg-gray-50 font-sans">

  <!-- HEADER -->
  <header class="shadow-md sticky top-0 z-50 bg-white">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">

      <!-- LEFT: Logo -->
      <div class="flex items-center space-x-3">
        <div class="relative bg-gradient-to-tr from-green-600 to-green-400 rounded-full p-[2px]">
          <img src="<?php echo $base_url; ?>assets/image/logo.png" alt="GreenAgro Logo" class="h-10 w-10 rounded-full bg-white p-1">
        </div>
        <div class="hidden sm:block">
          <h1 class="text-lg font-bold text-green-700 tracking-wide">GreenAgro</h1>
          <p class="text-xs text-gray-500 uppercase tracking-wider">Organic Marketplace</p>
        </div>
      </div>

      <!-- RIGHT OPTIONS -->
      <div class="flex items-center space-x-4">

        <!-- Notifications -->
        <button class="relative hover:scale-110 transition">
          <img src="https://cdn-icons-png.flaticon.com/512/1827/1827349.png" class="h-6 w-6">
          <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full px-1">2</span>
        </button>

        <button onclick="toggleAccountMenu()" class="hover:scale-110 transition">
            <img src="https://cdn-icons-png.flaticon.com/512/1077/1077063.png" class="h-6 w-6">
          </button>


        <!-- Cart -->
        <a href="<?php echo $base_url; ?>dashboard/seller/cart.php"><button class="hover:scale-110 transition">
          <img src="https://cdn-icons-png.flaticon.com/512/1170/1170678.png" class="h-6 w-6">
        </button></a>

        <a href="<?php echo $base_url; ?>logout.php" 
           onclick="return confirm('Are you sure you want to logout?')" 
           class="hover:scale-110 transition duration-200 border-l pl-4 border-gray-200" 
           title="Logout">
          <img src="https://cdn-icons-png.flaticon.com/512/1828/1828479.png" class="h-6 w-6" alt="Logout">
        </a>



      </div>
    </div>

    <!-- NAVBAR (Desktop) -->
    <div class="hidden lg:flex justify-center space-x-8 py-2 bg-gradient-to-r from-gray-500 to-green-500 text-white text-sm font-medium tracking-wide shadow-inner">
      <a href="dashboard.php" class="hover:text-yellow-200">Dashboard</a>
      <a href="crop.php" class="hover:text-yellow-200">Crop</a>
      <a href="orders.php" class="hover:text-yellow-200">Orders</a>
      <a href="Tracking.php" class="hover:text-yellow-200">Tracking</a>
      <a href="setting.php" class="hover:text-yellow-200">Setting</a>

    </div>

    <!-- NAVBAR (Mobile) -->
    <div id="mobileMenu" class="hidden lg:hidden bg-gradient-to-r from-green-600 to-green-500 text-white flex flex-col space-y-3 px-6 py-4">
      <input type="text" placeholder="Search..." class="bg-white text-gray-800 px-3 py-2 rounded-md">
      <a href="dashboard.php" class="hover:text-yellow-200">Dashboard</a>
      <a href="crop.php" class="hover:text-yellow-200">Crop</a>
      <a href="orders.php" class="hover:text-yellow-200">Orders</a>
      <a href="Tracking.php" class="hover:text-yellow-200">Tracking</a>
      <a href="setting.php" class="hover:text-yellow-200">Setting</a>
    </div>
  </header>

</body>
</html>
