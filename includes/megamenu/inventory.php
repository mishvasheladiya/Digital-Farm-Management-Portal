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
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f9fafb;
    }
    .hero {
      background: url('<?php echo $base_url; ?>assets/image/farm-inventory-hero.jpg') center/cover no-repeat;
      height: 400px;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }
    .hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(0, 60, 0, 0.6);
    }
    .hero h1 {
      position: relative;
      z-index: 10;
      font-size: 3rem;
      color: white;
      font-weight: 700;
      text-align: center;
    }
    .feature-card:hover {
      transform: translateY(-5px);
      transition: 0.3s ease-in-out;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <?php include('D:/Xampp/htdocs/farm/components/header.php'); ?>
  <?php include('D:/Xampp/htdocs/farm/components/navbar.php'); ?>

  <!-- Intro Section -->
  <section class="py-12 px-6 md:px-20 text-center">
    <h2 class="text-3xl font-bold text-green-700 mb-4">Organize, Track & Optimize</h2>
    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
      GreenAgro helps farmers monitor and manage all their farming resources in one place. 
      Keep track of seeds, fertilizers, tools, and more — all from an easy-to-use digital dashboard.
    </p>
  </section>

  <!-- Feature Sections -->
  <section class="py-10 px-6 md:px-16 space-y-16">

    <!-- Seeds -->
    <div class="flex flex-col md:flex-row items-center gap-10">
      <img src="<?php echo $base_url; ?>assets/image/header/Seed.jpg" class="w-full md:w-1/2 rounded-xl shadow-lg" alt="Seeds">
      <div class="md:w-1/2">
        <h3 class="text-2xl font-semibold text-green-700 mb-3">Seed Inventory</h3>
        <p class="text-gray-700 text-lg">
          Record and monitor all your crop seeds in one place. Easily track quantities, expiration dates, and usage history to ensure timely planting and efficient crop cycles.
        </p>
      </div>
    </div>

    <!-- Fertilizers -->
    <div class="flex flex-col-reverse md:flex-row items-center gap-10">
      <div class="md:w-1/2">
        <h3 class="text-2xl font-semibold text-green-700 mb-3">Fertilizers & Nutrients</h3>
        <p class="text-gray-700 text-lg">
          Maintain detailed logs of your fertilizers, soil enhancers, and nutrients. Stay informed on usage levels and stock availability for better soil health management.
        </p>
      </div>
      <img src="<?php echo $base_url; ?>assets/image/header/fertilizers.jpg" class="w-full md:w-1/2 rounded-xl shadow-lg" alt="Fertilizers">
    </div>

    <!-- Tools & Equipment -->
    <div class="flex flex-col md:flex-row items-center gap-10">
      <img src="<?php echo $base_url; ?>assets/image/header/equipment-tracking.jpg" class="w-full md:w-1/2 rounded-xl shadow-lg" alt="Equipment">
      <div class="md:w-1/2">
        <h3 class="text-2xl font-semibold text-green-700 mb-3">Tools & Equipment</h3>
        <p class="text-gray-700 text-lg">
          Manage your farm tools, tractors, and machinery efficiently. Keep track of maintenance schedules, availability, and usage records to reduce downtime.
        </p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include('D:/Xampp/htdocs/farm/components/footer.php'); ?>

</body>
</html>
