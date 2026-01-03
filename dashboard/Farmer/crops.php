<?php
if (!isset($base_url)) {
    $base_url = '/farm/';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Crops - GreenAgro</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    .category-card {
      transition: all 0.3s ease;
    }

    .category-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .circle {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto;
      background: white;
      border: 3px solid transparent;
      position: relative;
      background-clip: padding-box;
    }

    .circle::before {
      content: "";
      position: absolute;
      inset: 0;
      border-radius: 50%;
      padding: 3px;
      background: linear-gradient(135deg, #16a34a, #22c55e);
      -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
      -webkit-mask-composite: xor;
              mask-composite: exclude;
    }

    @media (max-width: 768px) {
      .circle {
        width: 90px;
        height: 90px;
      }
    }
  </style>

  <script>
    function goToPage(page) {
      window.location.href = page;
    }
  </script>
</head>

<body class="bg-gray-50 font-sans">
<?php include 'header.php'; ?>
  <div class="max-w-6xl mx-auto py-16 px-4">
    <!-- Header with Add Button -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-12">
      <div class="text-center sm:text-left mb-4 sm:mb-0">
        <h1 class="text-4xl font-extrabold text-green-700">My Crops</h1>
        <p class="text-gray-600 text-sm md:text-base mt-1">
          Choose your crop category to view, manage, or add details.
        </p>
      </div>


    </div>

    <!-- Crops Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">

      <!-- 1. Vegetables -->
      <div onclick="goToPage('<?php echo $base_url; ?>dashboard/Farmer/crop/vegetable.php')" class="category-card bg-white p-6 rounded-2xl shadow hover:shadow-lg cursor-pointer">
        <div class="relative circle">
          <img src="<?php echo $base_url; ?>assets/image/crop/vegetable.jpg" alt="Vegetables" class="w-20 h-20">
        </div>
        <h2 class="mt-4 text-xl font-semibold text-green-700">Vegetables</h2>
        <p class="text-gray-500 text-sm mt-1">Track your vegetable crops efficiently</p>
      </div>

      <!-- 2. Fruits -->
      <div onclick="goToPage('<?php echo $base_url; ?>dashboard/Farmer/crop/fruit.php')" class="category-card bg-white p-6 rounded-2xl shadow hover:shadow-lg cursor-pointer">
        <div class="relative circle">
          <img src="<?php echo $base_url; ?>assets/image/crop/fruit.jpg" alt="Fruits" class="w-20 h-20">
        </div>
        <h2 class="mt-4 text-xl font-semibold text-green-700">Fruits</h2>
        <p class="text-gray-500 text-sm mt-1">Manage your fruit production and yield</p>
      </div>

      <!-- 3. Grains -->
      <div onclick="goToPage('<?php echo $base_url; ?>dashboard/Farmer/crop/grains.php')" class="category-card bg-white p-6 rounded-2xl shadow hover:shadow-lg cursor-pointer">
        <div class="relative circle">
          <img src="<?php echo $base_url; ?>assets/image/crop/Grains.png" alt="Grains" class="w-20 h-20">
        </div>
        <h2 class="mt-4 text-xl font-semibold text-green-700">Grains</h2>
        <p class="text-gray-500 text-sm mt-1">Monitor your cereal and grain fields</p>
      </div>

      <!-- 4. Pulses -->
      <div onclick="goToPage('<?php echo $base_url; ?>dashboard/Farmer/crop/pulses.php')" class="category-card bg-white p-6 rounded-2xl shadow hover:shadow-lg cursor-pointer">
        <div class="relative circle">
          <img src="<?php echo $base_url; ?>assets/image/crop/Pulses.jpg" alt="Pulses" class="w-20 h-20">
        </div>
        <h2 class="mt-4 text-xl font-semibold text-green-700">Pulses</h2>
        <p class="text-gray-500 text-sm mt-1">Track your legume and pulse harvests</p>
      </div>

      <div onclick="goToPage('<?php echo $base_url; ?>dashboard/Farmer/crop/spice.php')" class="category-card bg-white p-6 rounded-2xl shadow hover:shadow-lg cursor-pointer">
        <div class="relative circle">
          <img src="<?php echo $base_url; ?>assets/image/crop/Spices.jpg" alt="Spices" class="w-20 h-20">
        </div>
        <h2 class="mt-4 text-xl font-semibold text-green-700">Spices</h2>
        <p class="text-gray-500 text-sm mt-1">Manage crops like chili, turmeric, ginger, or garlic</p>
      </div>

      <!-- 6. Flowers -->
      <div onclick="goToPage('<?php echo $base_url; ?>dashboard/Farmer/crop/flower.php')" class="category-card bg-white p-6 rounded-2xl shadow hover:shadow-lg cursor-pointer">
        <div class="relative circle">
          <img src="<?php echo $base_url; ?>assets/image/crop/flower.jpg" alt="Flowers" class="w-20 h-20">
        </div>
        <h2 class="mt-4 text-xl font-semibold text-green-700">Flowers</h2>
        <p class="text-gray-500 text-sm mt-1">Grow and manage flower crops easily</p>
      </div>

      <!-- 7. other -->
      <div onclick="goToPage('<?php echo $base_url; ?>dashboard/Farmer/crop/other.php')" class="category-card bg-white p-6 rounded-2xl shadow hover:shadow-lg cursor-pointer">
        <div class="relative circle">
          <img src="<?php echo $base_url; ?>assets/image/crop/cotton.jpg" alt="other" class="w-20 h-20">
        </div>
        <h2 class="mt-4 text-xl font-semibold text-green-700">Other</h2>
        <p class="text-gray-500 text-sm mt-1">Manage other crops easily</p>
      </div>

    </div>
  </div>
</body>
</html>
