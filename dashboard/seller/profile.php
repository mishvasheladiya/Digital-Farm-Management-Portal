<?php $base_url = "/farm/"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Farmer Profile</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- REQUIRED FOR CHART -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100">
<?php include 'header.php'; ?>

  <!-- HEADER BANNER -->
  <div class="w-full h-32 bg-gradient-to-r from-green-600 to-green-400 shadow-xl relative">

    <!-- Profile Image -->
    <div class="absolute left-1/2 -bottom-20 transform -translate-x-1/2">
      <div class="w-40 h-40 rounded-full bg-white shadow-xl p-1">
        <img src="<?php echo $base_url; ?>assets/image/user.jpg"
          class="w-full h-full object-cover rounded-full" alt="Profile">
      </div>
    </div>

  </div>

  <!-- USER NAME & ROLE -->
  <div class="mt-28 text-center">
    <h1 class="text-3xl font-bold text-gray-800">Mishva Sheladiya</h1>
    <p class="text-gray-500 text-lg">Professional Farmer • Agriculture Innovator</p>
  </div>

  <!-- QUICK STATS -->
  <div class="max-w-5xl mx-auto mt-8 grid grid-cols-1 sm:grid-cols-3 gap-5">

    <div class="bg-white rounded-xl shadow-md py-6 text-center">
      <h2 class="text-4xl font-bold text-green-600">12</h2>
      <p class="text-gray-500 mt-1">Active Crops</p>
    </div>

    <div class="bg-white rounded-xl shadow-md py-6 text-center">
      <h2 class="text-4xl font-bold text-green-600">4.8⭐</h2>
      <p class="text-gray-500 mt-1">Farmer Rating</p>
    </div>

    <div class="bg-white rounded-xl shadow-md py-6 text-center">
      <h2 class="text-4xl font-bold text-green-600">3+ yrs</h2>
      <p class="text-gray-500 mt-1">Experience</p>
    </div>

  </div>

  <!-- MAIN CONTENT -->
  <div class="max-w-6xl mx-auto mt-10 grid grid-cols-1 md:grid-cols-3 gap-6 items-stretch">

    <!-- LEFT SIDE (Equal height enabled) -->
    <div class="h-full flex flex-col">

      <!-- Contact Info -->
      <div class="bg-white rounded-xl p-6 shadow-lg mb-6 flex-grow">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Contact Information</h2>

        <div class="space-y-4">
          <div>
            <p class="text-sm text-gray-500">Email</p>
            <p class="font-medium text-gray-800">mishva@example.com</p>
          </div>

          <div>
            <p class="text-sm text-gray-500">Phone</p>
            <p class="font-medium text-gray-800">+91 98765 43210</p>
          </div>

          <div>
            <p class="text-sm text-gray-500">Location</p>
            <p class="font-medium text-gray-800">Rajkot, Gujarat</p>
          </div>
        </div>
      </div>

      <!-- Add Product Card -->
      <div class="bg-white rounded-xl p-6 shadow-lg flex-grow">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Add Your Product</h2>

        <form action="add_product.php" method="POST" enctype="multipart/form-data" class="space-y-4">

          <!-- Upload Image -->
          <div>
            <label class="text-gray-600 font-medium">Product Image</label>
            <input type="file" name="product_image"
              class="w-full mt-1 border rounded-lg px-3 py-2 cursor-pointer">
          </div>

          <!-- Product Name -->
          <div>
            <label class="text-gray-600 font-medium">Product Name</label>
            <input type="text" name="product_name"
              class="w-full mt-1 border rounded-lg px-3 py-2"
              placeholder="Enter product name">
          </div>

          <!-- Submit Button -->
          <button type="submit"
            class="w-full bg-green-600 text-white py-2 rounded-lg font-medium shadow-md hover:bg-green-700 transition">
            + Add Product
          </button>

        </form>
      </div>

    </div>

    <!-- RIGHT SIDE (Equal height enabled) -->
    <div class="md:col-span-2 h-full flex flex-col">

      <div class="bg-white rounded-xl p-6 shadow-lg flex-grow">

        <h2 class="text-xl font-semibold text-gray-700 mb-4">Farm Details</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

          <div>
            <p class="text-gray-500 text-sm">Farm Name</p>
            <p class="font-medium text-gray-800">Green Valley Farm</p>
          </div>

          <div>
            <p class="text-gray-500 text-sm">Farm Area</p>
            <p class="font-medium text-gray-800">12 Acres</p>
          </div>

          <div>
            <p class="text-gray-500 text-sm">Primary Crops</p>
            <p class="font-medium text-gray-800">Wheat, Corn, Sunflower</p>
          </div>

          <div>
            <p class="text-gray-500 text-sm">Irrigation Type</p>
            <p class="font-medium text-gray-800">Smart Drip Irrigation</p>
          </div>

        </div>

        <h2 class="text-xl font-semibold text-gray-700 mb-4 mt-6">Activity Chart</h2>

        <div class="bg-white rounded-xl shadow-lg p-6">

          <!-- Chart Title -->
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Weekly Farming Activity</h3>
            <select id="chartRange" class="border rounded-lg px-3 py-1 text-gray-600">
              <option value="week">Week</option>
              <option value="month">Month</option>
            </select>
          </div>

          <!-- Chart Container -->
          <canvas id="activityChart" height="120"></canvas>

        </div>

      </div>

    </div>
  </div>

  <br><br>

</body>

<script>
  const ctx = document.getElementById("activityChart");

  let weekData = [4, 6, 5, 8, 7, 10, 9];
  let monthData = [20, 22, 25, 28, 26, 30, 35, 40, 38, 42, 44, 50];

  let activityChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
      datasets: [{
        label: "Hours Worked",
        data: weekData,
        borderWidth: 3,
        tension: 0.4,
        borderColor: "#16a34a",
        pointBackgroundColor: "#16a34a",
        fill: false
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: { color: "#4b5563" }
        },
        x: {
          ticks: { color: "#4b5563" }
        }
      }
    }
  });

  // Dropdown filter (Week/Month)
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

</html>
