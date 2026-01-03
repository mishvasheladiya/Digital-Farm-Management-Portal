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
  <title>Seed Marketplace | Farmer Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Outfit', sans-serif;
      min-height: 100vh;
    }

    .glass-card {
      background: rgba(255, 255, 255, 0.6);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      transition: all 0.3s ease;
    }

    .glass-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body class="text-gray-800">
  <?php include('header.php');?>
  <main class="max-w-7xl mx-auto px-6 py-12">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-10 gap-4">
      <h1 class="text-4xl font-bold text-green-700 flex items-center gap-2">
        🌿 Seed Store
      </h1>
      <div class="flex gap-3">
        <input type="text" placeholder="Search for seeds..." 
          class="border border-green-400 rounded-xl p-2 focus:ring-2 focus:ring-green-500 outline-none w-64 shadow-sm" />
        <select class="border border-green-400 rounded-xl p-2 focus:ring-2 focus:ring-green-500 outline-none shadow-sm">
          <option>All Categories</option>
          <option>Vegetable Seeds</option>
          <option>Fruit Seeds</option>
          <option>Grain Seeds</option>
          <option>Flower Seeds</option>
          <option>Herbal Seeds</option>
        </select>
        <button class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl shadow-md transition">
          + Add Seed
        </button>
      </div>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
      <!-- Card 1 -->
      <div class="glass-card rounded-2xl p-5 shadow-md">
        <img src="<?php echo $base_url; ?>assets/image/seeds/tomato.jpg" alt="Tomato Seeds" class="rounded-xl h-49 w-full object-cover mb-4">
        <div>
          <h3 class="text-lg font-semibold text-green-700">Tomato Hybrid Seeds</h3>
          <p class="text-sm text-gray-600 mb-2">Best for greenhouse & open field farming.</p>
          <p class="text-green-700 font-medium">Seller: <span class="text-gray-800">Ramesh Patel</span></p>
          <p class="text-gray-800">Quantity: 50kg</p>
          <p class="text-2xl font-bold text-green-700 mt-2">₹250/kg</p>
          <div class="flex justify-between items-center mt-4">
            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition shadow-sm">Buy Now</button>
            <button class="bg-white hover:bg-green-100 border border-green-400 text-green-700 px-3 py-2 rounded-lg transition">♡ Wishlist</button>
          </div>
        </div>
      </div>

      <!-- Card 5 -->
      <div class="glass-card rounded-2xl p-5 shadow-md">
        <img src="<?php echo $base_url; ?>assets/image/seeds/sunflower.jpg" alt="Sunflower Seeds" class="rounded-xl h-49 w-full object-cover mb-4">
        <div>
          <h3 class="text-lg font-semibold text-green-700">Sunflower Hybrid Seeds</h3>
          <p class="text-sm text-gray-600 mb-2">Bright blooms with high oil yield potential.</p>
          <p class="text-green-700 font-medium">Seller: <span class="text-gray-800">Priya Mehta</span></p>
          <p class="text-gray-800">Quantity: 60kg</p>
          <p class="text-2xl font-bold text-green-700 mt-2">₹220/kg</p>
          <div class="flex justify-between items-center mt-4">
            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition shadow-sm">Buy Now</button>
            <button class="bg-white hover:bg-green-100 border border-green-400 text-green-700 px-3 py-2 rounded-lg transition">♡ Wishlist</button>
          </div>
        </div>

  </main>
</body>
</html>


