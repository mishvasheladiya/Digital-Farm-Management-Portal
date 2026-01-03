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
  <title>GreenAgro</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f9fafb;
    }
  </style>
</head>
<body>

<!-- Header Include -->
  <?php include 'D:\Xampp\htdocs\farm\components\header.php'; ?>
  <?php include 'D:\Xampp\htdocs\farm\components\navbar.php'; ?>

<!-- 🌱 Main Info Section -->
<section class="flex flex-col md:flex-row items-center justify-between p-10 md:p-20 bg-white rounded-2xl shadow-lg mx-auto mt-10 max-w-7xl">
  
  <!-- Left Content -->
  <div class="md:w-1/2 pr-0 md:pr-10">
    <h2 class="text-3xl font-bold text-green-700 mb-4">Empowering Farmers with Smart Tools</h2>
    <p class="text-gray-700 leading-relaxed mb-4">
      The GreenAgro Equipment Tracking system is designed to bring automation and efficiency 
      to your farm operations. With real-time location tracking, maintenance reminders, and 
      usage analytics, you can take full control over your equipment assets.
    </p>
    <p class="text-gray-700 leading-relaxed mb-4">
      Whether you manage tractors, irrigation systems, or harvesters, our smart dashboard 
      helps you reduce downtime, improve scheduling, and increase overall productivity.
    </p>
    <p class="text-gray-700 leading-relaxed">
      Stay ahead of equipment failures, track usage patterns, and make data-driven 
      decisions that boost your farm’s profitability.
    </p>
  </div>

  <!-- Right Image -->
  <div class="md:w-1/2 mt-8 md:mt-0">
    <img src="<?php echo $base_url; ?>assets/image/header/equipment-tracking.jpg" 
         alt="Farm Equipment Tracking" 
         class="rounded-2xl shadow-xl w-full h-[400px] object-cover">
  </div>
</section>

<!-- ⚙️ Features Section -->
<section class="max-w-7xl mx-auto py-16 px-6">
  <h2 class="text-3xl font-bold text-center text-green-700 mb-10">Key Features of Our Tracking System</h2>
  
  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    
    <div class="bg-white shadow-md rounded-2xl p-8 hover:shadow-xl transition">
      <img src="<?php echo $base_url; ?>assets/image/header/gps.jpg" alt="GPS Tracking" class="w-20 h-20 mx-auto mb-4">
      <h3 class="text-xl font-semibold text-green-700 mb-2 text-center">Real-Time GPS Tracking</h3>
      <p class="text-gray-600 text-center">
        Always know where your equipment is. Monitor live movement and prevent unauthorized usage.
      </p>
    </div>
    
    <div class="bg-white shadow-md rounded-2xl p-8 hover:shadow-xl transition">
      <img src="<?php echo $base_url; ?>assets/image/header/maintenance.jpg" alt="Maintenance Alerts" class="w-20 h-20 mx-auto mb-4">
      <h3 class="text-xl font-semibold text-green-700 mb-2 text-center">Maintenance Reminders</h3>
      <p class="text-gray-600 text-center">
        Get automatic alerts for scheduled maintenance and servicing to extend equipment lifespan.
      </p>
    </div>
    
    <div class="bg-white shadow-md rounded-2xl p-8 hover:shadow-xl transition">
      <img src="<?php echo $base_url; ?>assets/image/header/analytics.png" alt="Usage Analytics" class="w-20 h-20 mx-auto mb-4">
      <h3 class="text-xl font-semibold text-green-700 mb-2 text-center">Usage Analytics</h3>
      <p class="text-gray-600 text-center">
        Analyze performance data, fuel consumption, and efficiency to make smart farming decisions.
      </p>
    </div>
  </div>
</section>

<!-- Footer Include -->
  <?php include 'D:\Xampp\htdocs\farm\components\footer.php'; ?>

</body>
</html>
