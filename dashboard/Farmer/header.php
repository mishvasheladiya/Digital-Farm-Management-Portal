<?php
// 1. Database Connection (Ensure this path is correct for your project)
$conn = mysqli_connect("localhost", "root", "", "farm");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// --- NEW LIVE SEARCH HANDLER (AJAX) ---
if (isset($_GET['ajax_search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['query']);
    // Adjust the table name 'products' if your table is named differently
    $query = "SELECT id, product_name, category, price FROM products 
              WHERE product_name LIKE '%$search%' OR category LIKE '%$search%' 
              LIMIT 5";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<a href='/farm/dashboard/Farmer/product_details.php?id=" . $row['id'] . "' class='flex justify-between items-center p-3 hover:bg-gray-100 border-b border-gray-50 transition'>
                    <div>
                        <div class='text-sm font-bold text-gray-800'>" . htmlspecialchars($row['product_name']) . "</div>
                        <div class='text-[10px] text-green-600 uppercase font-bold'>" . htmlspecialchars($row['category']) . "</div>
                    </div>
                    <div class='text-xs font-bold text-gray-900'>₹" . $row['price'] . "</div>
                  </a>";
        }
        echo "<a href='/farm/dashboard/Farmer/Catalog.php?search=$search' class='block text-center p-2 text-xs font-bold text-blue-600 bg-gray-50'>View All Results</a>";
    } else {
        echo "<div class='p-3 text-xs text-gray-500 text-center'>No results found</div>";
    }
    exit; // Stop execution here for AJAX requests
}

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Farmer') {
    header("Location: /farm/components/login.php");
    exit;
}

$base_url = "/farm/";

/* ---------- USER DETAILS FROM SESSION ---------- */
$first_name = $_SESSION['first_name'] ?? '';
$last_name  = $_SESSION['last_name'] ?? '';
$farmer_name = trim($first_name . ' ' . $last_name);
$user_role  = $_SESSION['user_type'];
$user_id    = $_SESSION['user_id'];

/* ---------- NOTIFICATION LOGIC ---------- */
// Fetch unread count
$count_query = "SELECT COUNT(*) as unread FROM notifications WHERE farmer_id = ? AND is_read = 0";
$stmt_c = mysqli_prepare($conn, $count_query);
mysqli_stmt_bind_param($stmt_c, "i", $user_id);
mysqli_stmt_execute($stmt_c);
$res_c = mysqli_stmt_get_result($stmt_c);
$unread_count = mysqli_fetch_assoc($res_c)['unread'] ?? 0;

// Fetch last 5 notifications
$notif_query = "SELECT * FROM notifications WHERE farmer_id = ? ORDER BY created_at DESC LIMIT 5";
$stmt_n = mysqli_prepare($conn, $notif_query);
mysqli_stmt_bind_param($stmt_n, "i", $user_id);
mysqli_stmt_execute($stmt_n);
$notifications = mysqli_stmt_get_result($stmt_n);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Farmer Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    /* Hide Google Translate branding */
    .goog-logo-link, .goog-te-gadget span, .goog-te-banner-frame, #goog-gt-tt { display: none !important; }
    .goog-te-gadget { color: transparent !important; }

    /* Language dropdown */
    .lang-dropdown {
      display: none;
      position: absolute;
      top: 35px;
      right: 0;
      background: white;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      z-index: 50;
      width: 180px;
      overflow: hidden;
      animation: fadeIn 0.2s ease-in-out;
    }

    .lang-dropdown a {
      display: block;
      padding: 10px 14px;
      color: #374151;
      font-size: 14px;
      text-decoration: none;
      transition: background 0.2s ease;
    }

    .lang-dropdown a:hover {
      background: #f9fafb;
      color: #047857;
    }

    .lang-menu:hover .lang-dropdown {
      display: block;
    }

    /* Account dropdown */
    .account-dropdown {
      display: none;
      position: absolute;
      top: 40px;
      right: 0;
      background: white;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
      z-index: 50;
      width: 220px;
      overflow: hidden;
      animation: fadeIn 0.25s ease-in-out;
    }

    .account-dropdown a {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 16px;
      color: #374151;
      font-size: 14px;
      text-decoration: none;
      transition: background 0.2s ease;
    }

    .account-dropdown a:hover {
      background: #f3f4f6;
      color: #047857;
    }

    .account-dropdown .header {
      background: linear-gradient(to right, #10b981, #059669);
      color: white;
      padding: 16px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .account-dropdown .header img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border: 2px solid white;
    }

    .account-menu:hover .account-dropdown {
      display: block;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-6px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Perfected Language dropdown */
    .lang-dropdown {
        display: none;
        position: absolute;
        top: 40px;
        right: -10px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        z-index: 100;
        width: 220px;
        max-height: 350px;
        overflow-y: auto;
        border: 1px solid #e5e7eb;
        animation: fadeIn 0.2s ease-out;
    }

    .lang-dropdown::-webkit-scrollbar { width: 6px; }
    .lang-dropdown::-webkit-scrollbar-track { background: #f1f1f1; }
    .lang-dropdown::-webkit-scrollbar-thumb { background: #10b981; border-radius: 10px; }

    .lang-dropdown a {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        color: #374151;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s ease;
        border-bottom: 1px solid #f3f4f6;
        cursor: pointer;
    }

    .lang-dropdown a:hover {
        background: #f0fdf4;
        color: #059669;
        padding-left: 20px;
    }

    .lang-menu:hover .lang-dropdown { display: block; }
    #search-results-dropdown {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        margin-top: 5px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }
  </style>

<script>
function toggleMenu() {
  document.getElementById("mobileMenu").classList.toggle("hidden");
}

function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en',
    includedLanguages: 'en,hi,gu,ta,te,kn,ml,mr,bn,pa,ur,or,as,ne,si,sa,fr,de,es',
    layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
  }, 'google_translate_element');
}

function changeLanguage(lang) {
  const select = document.querySelector('.goog-te-combo');
  if (select) {
    select.value = lang;
    select.dispatchEvent(new Event('change'));
  }
}
</script>
<script>
function toggleMenu() {
  document.getElementById("mobileMenu").classList.toggle("hidden");
}

// LIVE SEARCH LOGIC
function doLiveSearch(query) {
    const dropdown = document.getElementById("search-results-dropdown");
    if (query.length < 1) {
        dropdown.style.display = "none";
        return;
    }

    fetch(`?ajax_search=1&query=${query}`)
        .then(response => response.text())
        .then(data => {
            dropdown.innerHTML = data;
            dropdown.style.display = "block";
        });
}

// Close search results when clicking outside
document.addEventListener("click", function(e) {
    if (!e.target.closest(".search-container")) {
        document.getElementById("search-results-dropdown").style.display = "none";
    }
});

function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en',
    includedLanguages: 'en,hi,gu,ta,te,kn,ml,mr,bn,pa,ur,or,as,ne,si,sa,fr,de,es',
    layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
  }, 'google_translate_element');
}

function changeLanguage(lang) {
  const select = document.querySelector('.goog-te-combo');
  if (select) {
    select.value = lang;
    select.dispatchEvent(new Event('change'));
  }
}
</script>
</head>

<body class="bg-gray-50 font-sans">

  <header class="shadow-md sticky top-0 z-50 bg-white">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">

      <div class="flex items-center space-x-3">
        <div class="relative bg-gradient-to-tr from-green-600 to-green-400 rounded-full p-[2px]">
          <img src="<?php echo $base_url; ?>assets/image/logo.png" alt="GreenAgro Logo" class="h-10 w-10 rounded-full bg-white p-1">
        </div>
        <div class="hidden sm:block">
          <h1 class="text-lg font-bold text-green-700 tracking-wide">GreenAgro</h1>
          <p class="text-xs text-gray-500 uppercase tracking-wider">Organic Marketplace</p>
        </div>
      </div>

<div class="hidden lg:flex flex-col w-1/3 relative search-container">
        <form action="<?php echo $base_url; ?>dashboard/Farmer/Catalog.php" method="GET" class="flex items-center w-full bg-gray-100 rounded-full px-3 py-1 focus-within:ring-2 focus-within:ring-green-400 transition">
          <input type="text" name="search" autocomplete="off"
                 onkeyup="doLiveSearch(this.value)"
                 placeholder="Search crops, markets, or tools..." 
                 class="w-full bg-transparent text-gray-700 focus:outline-none text-sm p-1" 
                 value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
          <button type="submit" class="bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white rounded-full px-4 py-1.5 ml-2 text-sm font-semibold whitespace-nowrap">
            Search
          </button>
        </form>
        <div id="search-results-dropdown"></div>
      </div>

      <div class="flex items-center space-x-4">
        
        <div class="lang-menu relative">
          <button><img src="https://cdn-icons-png.flaticon.com/512/44/44386.png" class="h-6 w-6"></button>
          <div class="lang-dropdown">
          <a onclick="changeLanguage('en')">🇬🇧 English</a>
          <a onclick="changeLanguage('hi')">🇮🇳 Hindi</a>
          <a onclick="changeLanguage('gu')">🇮🇳 Gujarati</a>
          <a onclick="changeLanguage('ta')">🇮🇳 Tamil</a>
          <a onclick="changeLanguage('te')">🇮🇳 Telugu</a>
          <a onclick="changeLanguage('kn')">🇮🇳 Kannada</a>
          <a onclick="changeLanguage('ml')">🇮🇳 Malayalam</a>
          <a onclick="changeLanguage('mr')">🇮🇳 Marathi</a>
          <a onclick="changeLanguage('bn')">🇮🇳 Bengali</a>
          <a onclick="changeLanguage('pa')">🇮🇳 Punjabi</a>
          <a onclick="changeLanguage('ur')">🇮🇳 Urdu</a>
          <a onclick="changeLanguage('or')">🇮🇳 Odia</a>
          <a onclick="changeLanguage('as')">🇮🇳 Assamese</a>
          <a onclick="changeLanguage('ne')">🇮🇳 Nepali</a>
          <a onclick="changeLanguage('si')">🇮🇳 Sindhi</a>
          <a onclick="changeLanguage('sa')">🇮🇳 Sanskrit</a>
</div>
        </div>

        <div class="account-menu relative">
            <button class="relative hover:scale-110 transition">
              <img src="https://cdn-icons-png.flaticon.com/512/1827/1827349.png" class="h-6 w-6" alt="Notifications">
              <?php if($unread_count > 0): ?>
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] rounded-full px-1.5 font-bold border-2 border-white"><?php echo $unread_count; ?></span>
              <?php endif; ?>
            </button>
            <div class="account-dropdown w-64">
                <div class="p-3 border-b border-gray-100 font-bold text-xs text-gray-400 uppercase tracking-widest">Recent Activity</div>
                <div class="max-h-60 overflow-y-auto">
                    <?php if(mysqli_num_rows($notifications) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($notifications)): ?>
                            <a href="#" class="block p-3 hover:bg-gray-50 border-b border-gray-50 <?php echo $row['is_read'] ? '' : 'bg-green-50'; ?>">
                                <p class="text-xs font-semibold text-gray-800"><?php echo htmlspecialchars($row['title'] ?? 'Update'); ?></p>
                                <p class="text-[11px] text-gray-500 line-clamp-2"><?php echo htmlspecialchars($row['message']); ?></p>
                                <p class="text-[9px] text-green-600 mt-1"><?php echo date('d M, h:i A', strtotime($row['created_at'])); ?></p>
                            </a>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="p-4 text-center text-xs text-gray-400">No new notifications</div>
                    <?php endif; ?>
                </div>
                <a href="notifications.php" class="block text-center p-2 text-xs font-bold text-green-600 bg-gray-50">View All</a>
            </div>
        </div>

        <div class="account-menu relative">
          <button class="hover:scale-110 transition">
            <img src="https://cdn-icons-png.flaticon.com/512/1077/1077063.png" class="h-6 w-6" alt="Account">
          </button>
          <div class="account-dropdown">
            <div class="header">
              <img src="<?php echo $base_url; ?>assets/image/user.jpg" alt="User">
              <div>
                <p class="font-semibold text-sm"><?php echo htmlspecialchars($farmer_name); ?></p>
                <p class="text-xs opacity-80"><?php echo htmlspecialchars($user_role); ?></p>
              </div>
            </div>
            <a href="profile.php"><span>👤</span> My Profile</a>
            <a href="setting.php"><span>⚙️</span> Settings</a>
            <a href="help.php"><span>❓</span> Help</a>
            <div class="border-t border-gray-100"></div>
            <a href="<?php echo $base_url; ?>components/logout.php" class="text-red-600"><span>🚪</span> Logout</a>
          </div>
        </div>

        <button class="lg:hidden" onclick="toggleMenu()">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>

    <div class="hidden lg:flex justify-center space-x-8 py-2 bg-gradient-to-r from-gray-500 to-green-500 text-white text-sm font-medium tracking-wide shadow-inner">
      <a href="<?php echo $base_url; ?>dashboard/Farmer/dashboard.php" class="hover:text-yellow-200 transition">Dashboard</a>
      <a href="<?php echo $base_url; ?>dashboard/Farmer/crops.php" class="hover:text-yellow-200 transition">My Crops</a>
      <a href="<?php echo $base_url; ?>dashboard/Farmer/Catalog.php" class="hover:text-yellow-200 transition">Catalog</a>
      <a href="<?php echo $base_url; ?>dashboard/Farmer/Tracking.php" class="hover:text-yellow-200 transition">Tracking</a>
      <a href="<?php echo $base_url; ?>dashboard/Farmer/Completed.php" class="hover:text-yellow-200 transition">Completed</a>
    </div>

    <div id="mobileMenu" class="hidden lg:hidden bg-gradient-to-r from-green-600 to-green-500 text-white flex flex-col space-y-3 px-6 py-4">
      <input type="text" placeholder="Search..." class="bg-white text-gray-800 px-3 py-2 rounded-md focus:outline-none">
      <a href="<?php echo $base_url; ?>dashboard/Farmer/dashboard.php" class="hover:text-yellow-200">Dashboard</a>
      <a href="<?php echo $base_url; ?>dashboard/Farmer/crops.php" class="hover:text-yellow-200">My Crops</a>
      <a href="<?php echo $base_url; ?>dashboard/Farmer/Catalog.php" class="hover:text-yellow-200">Catalog</a>
      <a href="<?php echo $base_url; ?>dashboard/Farmer/Tracking.php" class="hover:text-yellow-200">Tracking</a>
      <a href="<?php echo $base_url; ?>dashboard/Farmer/Completed.php" class="hover:text-yellow-200">Completed</a>

    </div>
  </header>

  <div id="google_translate_element" style="display:none;"></div>
  <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>
</html>