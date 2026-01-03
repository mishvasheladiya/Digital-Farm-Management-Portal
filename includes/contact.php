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
  <title>Book Your GreenAgro Consultation</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f8fafc;
    }
    .form-card {
      border-left: 4px solid #059669;
      padding: 1.5rem;
    }
    .input-field {
      padding: 12px;
      border-radius: 6px;
      border: 1px solid #d1d5db;
      transition: all 0.2s;
    }
    .input-field:focus {
      outline: none;
      border-color: #059669;
      box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.4);
    }
    .hp-field {
      position: absolute;
      left: -9999px;
      opacity: 0;
      height: 1px;
      width: 1px;
    }
  </style>
</head>

<body >
  <!-- Header -->
  <?php include 'D:\Xampp\htdocs\farm\components\header.php'; ?><br><br>

  <!-- Centered Form -->
  <div class="flex justify-center items-center min-h-[80vh]">
    <div class="max-w-4xl w-full bg-white rounded-2xl shadow-2xl p-10">

      <div class="text-center mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900">Book Your GreenAgro Consultation</h1>
        <p class="mt-2 text-md text-gray-600">
          Complete these three quick sections to schedule your personalized product demo.
        </p>
      </div>

      <div id="message-box" class="hidden p-4 mb-6 rounded-lg font-semibold text-center text-sm border" role="alert"></div>

      <form id="multi-section-form" class="space-y-6">
        <input type="text" name="hp_website" class="hp-field" value="">

        <!-- Section 1 -->
        <div class="bg-gray-50 rounded-lg shadow-sm form-card">
          <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
            <span class="bg-green-100 text-green-700 rounded-full h-8 w-8 flex items-center justify-center mr-3 font-bold">1</span>
            Contact Details
          </h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label for="full-name" class="block text-sm font-medium text-gray-700 mb-1">Your Name *</label>
              <input id="full-name" name="full-name" type="text" required placeholder="Full Name" class="input-field w-full">
            </div>
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Work Email *</label>
              <input id="email" name="email" type="email" required placeholder="farm.manager@company.com" class="input-field w-full">
            </div>
          </div>
        </div>

        <!-- Section 2 -->
        <div class="bg-gray-50 rounded-lg shadow-sm form-card">
          <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
            <span class="bg-green-100 text-green-700 rounded-full h-8 w-8 flex items-center justify-center mr-3 font-bold">2</span>
            Farm Profile
          </h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label for="farm-size" class="block text-sm font-medium text-gray-700 mb-1">Total Land Area *</label>
              <select id="farm-size" name="farm-size" required class="input-field w-full">
                <option value="" disabled selected>Select approximate area</option>
                <option value="1-10">1 - 10 Acres (Small)</option>
                <option value="11-50">11 - 50 Acres (Medium)</option>
                <option value="51+">51+ Acres (Large)</option>
                <option value="agri-business">Agri-Business / Corporate</option>
              </select>
            </div>
            <div>
              <label for="region" class="block text-sm font-medium text-gray-700 mb-1">State / Region *</label>
              <input id="region" name="region" type="text" required placeholder="e.g., Gujarat, India" class="input-field w-full">
            </div>
          </div>
        </div>

        <!-- Section 3 -->
        <div class="bg-gray-50 rounded-lg shadow-sm form-card">
          <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
            <span class="bg-green-100 text-green-700 rounded-full h-8 w-8 flex items-center justify-center mr-3 font-bold">3</span>
            Areas of Interest
          </h3>
          <div class="grid grid-cols-2 gap-3">
            <label class="flex items-center p-3 border rounded-lg hover:border-green-500 cursor-pointer">
              <input type="checkbox" name="focus[]" value="crop_management" class="h-4 w-4 text-green-600">
              <span class="ml-3 text-sm text-gray-700">Crop Optimization</span>
            </label>
            <label class="flex items-center p-3 border rounded-lg hover:border-green-500 cursor-pointer">
              <input type="checkbox" name="focus[]" value="finance" class="h-4 w-4 text-green-600">
              <span class="ml-3 text-sm text-gray-700">Cost & Finance Tracking</span>
            </label>
            <label class="flex items-center p-3 border rounded-lg hover:border-green-500 cursor-pointer">
              <input type="checkbox" name="focus[]" value="livestock" class="h-4 w-4 text-green-600">
              <span class="ml-3 text-sm text-gray-700">Livestock/Dairy Mgmt.</span>
            </label>
            <label class="flex items-center p-3 border rounded-lg hover:border-green-500 cursor-pointer">
              <input type="checkbox" name="focus[]" value="weather" class="h-4 w-4 text-green-600">
              <span class="ml-3 text-sm text-gray-700">Weather & Soil Insights</span>
            </label>
          </div>
        </div>

        <!-- Message + Button -->
        <div class="space-y-4 pt-4">
          <textarea id="message" name="message" rows="3" placeholder="Describe your main challenge (Optional)" class="input-field w-full resize-none"></textarea>
          <button type="submit" id="submit-btn" class="w-full flex justify-center items-center py-3 px-4 rounded-lg text-white bg-green-700 hover:bg-green-800 transition">
            <span id="btn-text">Schedule My Personalized Demo</span>
            <svg id="spinner" class="hidden animate-spin h-5 w-5 text-white ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.37 0 0 5.37 0 12h4z"></path></svg>
          </button>
        </div>
      </form>
    </div>
  </div><br><br>

  <!-- Repeat header again below if you wanted header twice -->
  <?php include 'D:\Xampp\htdocs\farm\components\footer.php'; ?>

  <script>
    document.getElementById('multi-section-form').addEventListener('submit', function(e) {
      e.preventDefault();
      const messageBox = document.getElementById('message-box');
      const submitBtn = document.getElementById('submit-btn');
      const btnText = document.getElementById('btn-text');
      const spinner = document.getElementById('spinner');
      const email = document.getElementById('email').value.trim();
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      const focusCheckboxes = document.querySelectorAll('input[name="focus[]"]:checked');
      if (!emailRegex.test(email)) return showMessage('Please enter a valid email.', 'error');
      if (focusCheckboxes.length === 0) return showMessage('Select at least one interest.', 'error');
      submitBtn.disabled = true;
      btnText.textContent = 'Scheduling...';
      spinner.classList.remove('hidden');
      setTimeout(() => {
        showMessage('✅ Demo scheduled successfully! You will get an email soon.', 'success');
        e.target.reset();
        submitBtn.disabled = false;
        btnText.textContent = 'Schedule My Personalized Demo';
        spinner.classList.add('hidden');
      }, 1800);
    });
    function showMessage(message, type) {
      const box = document.getElementById('message-box');
      box.textContent = message;
      box.classList.remove('hidden');
      box.className = type === 'success'
        ? 'p-4 mb-6 rounded-lg text-green-800 bg-green-100 border border-green-300 text-center font-medium'
        : 'p-4 mb-6 rounded-lg text-red-800 bg-red-100 border border-red-300 text-center font-medium';
    }
  </script>
</body>
</html>
