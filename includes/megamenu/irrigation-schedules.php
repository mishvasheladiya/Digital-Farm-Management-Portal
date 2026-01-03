<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenAgro</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Configure Tailwind to use Inter font and custom colors -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'soil-green': '#387c44',
                        'soil-brown': '#7f5539',
                        'accent-sage': '#81b29a', 
                    }
                }
            }
        }
    </script>
    <style>
        /* Set Inter as default font */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f7f7;
        }
        /* Custom scrollbar for a cleaner look */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>
<body class="min-h-screen antialiased">

  <?php include 'D:\Xampp\htdocs\farm\components\header.php'; ?>
  <?php include 'D:\Xampp\htdocs\farm\components\navbar.php'; ?>

    <main class="max-w-7xl mx-auto p-4 md:p-8 space-y-10">

        <!-- Introduction Section -->
        <section class="bg-white rounded-xl shadow-xl p-6 md:p-8 border-t-4 border-accent-sage">
            <h2 class="text-3xl font-extrabold text-soil-green mb-4">Precision Water Management</h2>
            <p class="text-lg text-gray-700">
                Effective irrigation saves water and prevents plant stress. Use the calculator below to estimate your crop's weekly water needs based on soil type and growth stage.
            </p>
        </section>

        <!-- Irrigation Needs Calculator -->
        <section class="bg-white rounded-xl shadow-xl p-6 md:p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                Weekly Water Needs Calculator
            </h2>
            
            <form id="irrigation-form" class="grid grid-cols-1 md:grid-cols-4 gap-6">

                <!-- Input 1: Soil Type -->
                <div class="space-y-2">
                    <label for="soil_type" class="block text-sm font-medium text-gray-700">Soil Texture</label>
                    <select id="soil_type" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-soil-green focus:border-soil-green transition duration-150 shadow-sm appearance-none bg-white">
                        <option value="">-- Select Soil Type --</option>
                        <option value="sand">Sandy (Drains Fast)</option>
                        <option value="loam">Loamy (Ideal)</option>
                        <option value="clay">Clay (Holds Water)</option>
                    </select>
                </div>

                <!-- Input 2: Crop Stage -->
                <div class="space-y-2">
                    <label for="crop_stage" class="block text-sm font-medium text-gray-700">Crop Growth Stage</label>
                    <select id="crop_stage" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-soil-green focus:border-soil-green transition duration-150 shadow-sm appearance-none bg-white">
                        <option value="">-- Select Stage --</option>
                        <option value="vegetative">Vegetative (Growth)</option>
                        <option value="flowering">Flowering (Key Stage)</option>
                        <option value="fruiting">Fruiting (High Demand)</option>
                    </select>
                </div>

                <!-- Input 3: Weekly Temperature (Simulated ET factor) -->
                <div class="space-y-2 md:col-span-2">
                    <label for="temp_c" class="block text-sm font-medium text-gray-700">Avg. Weekly Temperature (°C)</label>
                    <input type="number" id="temp_c" min="5" max="45" step="1" placeholder="e.g., 28" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-soil-green focus:border-soil-green transition duration-150 shadow-sm">
                    <p class="text-xs text-gray-500">Higher temperature increases water loss (Evapotranspiration).</p>
                </div>

                <!-- Submit Button -->
                <div class="md:col-span-4 pt-4">
                    <button type="submit"
                        class="w-full md:w-auto px-6 py-3 bg-soil-green text-white font-semibold rounded-lg hover:bg-soil-brown transition duration-200 ease-in-out shadow-md hover:shadow-lg transform hover:scale-[1.01]">
                        Estimate Water Needs
                    </button>
                </div>
            </form>

            <!-- Results Display -->
            <div id="irrigation-results" class="mt-8 pt-6 border-t border-gray-200 hidden">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Water Requirement Summary:</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Estimated Need Card -->
                    <div class="bg-green-50 p-6 rounded-xl border-l-4 border-soil-green shadow">
                        <p class="text-lg font-semibold text-gray-600">Estimated Weekly Water:</p>
                        <p id="water-amount" class="text-5xl font-extrabold text-soil-green mt-1">--</p>
                    </div>

                    <!-- Scheduling Advice Card -->
                    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow">
                        <p class="text-lg font-semibold text-soil-brown mb-2">Suggested Schedule:</p>
                        <p id="schedule-advice" class="text-gray-700"></p>
                    </div>
                </div>
            </div>
             <!-- Error Message Box -->
            <div id="error-message-irrigation" class="mt-8 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg hidden">
                Please select soil texture, crop stage, and enter a valid temperature.
            </div>
        </section>

        <!-- Principles Section -->
        <section>
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-soil-green pb-2">Irrigation Principles</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Principle 1: Evapotranspiration -->
                <div class="p-5 bg-white rounded-lg shadow border-l-4 border-accent-sage">
                    <h3 class="text-xl font-semibold text-soil-green mb-2">Evapotranspiration (ET)</h3>
                    <p class="text-gray-600 text-sm">ET is the total water lost from the soil surface (evaporation) and through the plant (transpiration). This is the baseline measure for water demand. Higher temperatures and wind increase ET.</p>
                </div>
                <!-- Principle 2: Water Holding Capacity -->
                <div class="p-5 bg-white rounded-lg shadow border-l-4 border-accent-sage">
                    <h3 class="text-xl font-semibold text-soil-green mb-2">Soil Water Holding Capacity</h3>
                    <p class="text-gray-600 text-sm">Different soils store water differently: Sand has low capacity (needs frequent, small amounts). Clay has high capacity (needs infrequent, large amounts). Loam is balanced.</p>
                </div>
            </div>
        </section>

    </main>
  <?php include 'D:\Xampp\htdocs\farm\components\footer.php'; ?>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('irrigation-form');
            const resultsDiv = document.getElementById('irrigation-results');
            const waterAmountElement = document.getElementById('water-amount');
            const scheduleAdviceElement = document.getElementById('schedule-advice');
            const errorElement = document.getElementById('error-message-irrigation');

            form.addEventListener('submit', (e) => {
                e.preventDefault();
                errorElement.classList.add('hidden'); // Hide any previous errors
                
                const soilType = document.getElementById('soil_type').value;
                const cropStage = document.getElementById('crop_stage').value;
                const tempC = parseFloat(document.getElementById('temp_c').value);

                // Validation check
                if (!soilType || !cropStage || isNaN(tempC) || tempC < 5 || tempC > 45) {
                    errorElement.classList.remove('hidden');
                    resultsDiv.classList.add('hidden');
                    return;
                }

                // 1. Determine Base Water Need (simulated crop coefficient)
                let baseWaterMM = 0; // mm per week
                if (cropStage === 'vegetative') {
                    baseWaterMM = 25; 
                } else if (cropStage === 'flowering') {
                    baseWaterMM = 35;
                } else if (cropStage === 'fruiting') {
                    baseWaterMM = 45; 
                }

                // 2. Determine Temperature (Evapotranspiration) Adjustment Factor
                let tempFactor = 1.0;
                if (tempC < 20) {
                    tempFactor = 0.9; // 10% less water needed
                } else if (tempC > 30) {
                    tempFactor = 1.2; // 20% more water needed
                }
                // (20-30°C uses factor 1.0)

                // 3. Calculate Final Weekly Water Need
                const weeklyWaterNeedMM = Math.round(baseWaterMM * tempFactor);
                
                // 4. Generate Scheduling Advice based on Soil Type
                let advice = '';
                if (soilType === 'sand') {
                    advice = `**Sandy Soil:** Water is lost quickly. Apply ${Math.round(weeklyWaterNeedMM / 3)} mm per application, 3 times per week. Focus on frequent, shallow irrigation.`;
                } else if (soilType === 'loam') {
                    advice = `**Loamy Soil:** Good balance. Apply ${Math.round(weeklyWaterNeedMM / 2)} mm per application, 2 times per week.`;
                } else if (soilType === 'clay') {
                    advice = `**Clay Soil:** Water is held tightly. Apply ${weeklyWaterNeedMM} mm once per week, allowing the water to fully penetrate deeply. Avoid watering more than once a week if possible.`;
                } else {
                    advice = 'No specific scheduling advice for this soil type yet. Aim for a balanced approach.';
                }


                // --- Display Results ---
                waterAmountElement.textContent = `${weeklyWaterNeedMM} mm`;
                scheduleAdviceElement.innerHTML = advice;
                resultsDiv.classList.remove('hidden');

            });
        });
    </script>
</body>
</html>
