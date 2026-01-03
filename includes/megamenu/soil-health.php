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
                        // Replaced accent-yellow with a harmonious sage green
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

    <!-- Header -->
  <?php include 'D:\Xampp\htdocs\farm\components\header.php'; ?>
  <?php include 'D:\Xampp\htdocs\farm\components\navbar.php'; ?>


    <main class="max-w-7xl mx-auto p-4 md:p-8 space-y-10">

        <!-- Introduction Section -->
        <!-- Updated border color from yellow to accent-sage -->
<!-- Introduction Section -->
<section class="flex flex-col md:flex-row items-center bg-cover bg-center p-10" style="background-image: url('assets/image/your-image.png');">
  <div class="md:w-1/2 text-white md:pr-8">
    <h2 class="text-3xl font-bold mb-4 text-soil-green">Understanding Your Soil</h2>
    <p class="text-black leading-relaxed ">
      Soil health is the continued capacity of soil to function as a vital living ecosystem 
      that sustains plants, animals, and humans. Use the tools and information below 
      to assess and improve your soil.
    </p>
  </div>

  <div class="md:w-1/2 mt-6 md:mt-0 flex justify-center">
    <img src="<?php echo $base_url; ?>assets/image/header/soil-health.jpg" alt="Soil Plant" class="rounded-2xl shadow-lg max-w-full h-auto object-cover">
  </div>
</section>



        <!-- Key Indicators Grid -->
        <section>
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-soil-green pb-2">Key Indicators</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Indicator Card 1: Organic Matter -->
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 border-l-4 border-soil-brown">
                    <div class="text-3xl mb-3">🍂</div>
                    <h3 class="text-xl font-semibold text-soil-green mb-2">Organic Matter (OM)</h3>
                    <p class="text-gray-600 text-sm">Fuel for soil microbes, improves water retention, and supplies nutrients. Goal: 3% - 6%.</p>
                </div>
                <!-- Indicator Card 2: pH Level -->
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 border-l-4 border-soil-brown">
                    <div class="text-3xl mb-3">🧪</div>
                    <h3 class="text-xl font-semibold text-soil-green mb-2">pH Level</h3>
                    <p class="text-gray-600 text-sm">Controls nutrient availability. Most crops prefer a neutral range. Optimal: 6.0 - 7.0.</p>
                </div>
                <!-- Indicator Card 3: Water Infiltration -->
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 border-l-4 border-soil-brown">
                    <div class="text-3xl mb-3">💧</div>
                    <h3 class="text-xl font-semibold text-soil-green mb-2">Water Infiltration</h3>
                    <p class="text-gray-600 text-sm">How quickly water enters the soil. Good structure prevents runoff and erosion.</p>
                </div>
                <!-- Indicator Card 4: Biological Activity -->
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 border-l-4 border-soil-brown">
                    <div class="text-3xl mb-3">🪱</div>
                    <h3 class="text-xl font-semibold text-soil-green mb-2">Biological Activity</h3>
                    <p class="text-gray-600 text-sm">Earthworms, fungi, and bacteria that cycle nutrients and build soil structure.</p>
                </div>
            </div>
        </section>

        <!-- Soil Health Index Calculator -->
        <section class="bg-white rounded-xl shadow-xl p-6 md:p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                Soil Health Index Calculator
                <!-- Updated BETA badge color from yellow to accent-sage -->
                <span class="ml-3 text-sm font-medium bg-accent-sage text-soil-brown px-3 py-1 rounded-full">BETA</span>
            </h2>
            <p class="mb-6 text-gray-600">Enter your recent soil test results below to calculate a simple, simulated Soil Health Index (SHI).</p>

            <form id="soil-health-form" class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Input 1: Organic Matter -->
                <div class="space-y-2">
                    <label for="om" class="block text-sm font-medium text-gray-700">Organic Matter (%)</label>
                    <input type="number" id="om" min="0.1" max="10" step="0.1" placeholder="e.g., 4.5" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-soil-green focus:border-soil-green transition duration-150 shadow-sm">
                </div>

                <!-- Input 2: pH -->
                <div class="space-y-2">
                    <label for="ph" class="block text-sm font-medium text-gray-700">pH Level (6.0-7.0 ideal)</label>
                    <input type="number" id="ph" min="4.0" max="9.0" step="0.1" placeholder="e.g., 6.4" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-soil-green focus:border-soil-green transition duration-150 shadow-sm">
                </div>

                <!-- Input 3: Available Nitrogen (Simulated) -->
                <div class="space-y-2">
                    <label for="n_ppm" class="block text-sm font-medium text-gray-700">Available Nitrogen (ppm)</label>
                    <input type="number" id="n_ppm" min="10" max="100" step="1" placeholder="e.g., 55" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-soil-green focus:border-soil-green transition duration-150 shadow-sm">
                </div>

                <!-- Submit Button -->
                <div class="md:col-span-3 pt-4">
                    <button type="submit"
                        class="w-full md:w-auto px-6 py-3 bg-soil-green text-white font-semibold rounded-lg hover:bg-soil-brown transition duration-200 ease-in-out shadow-md hover:shadow-lg transform hover:scale-[1.01]">
                        Calculate Soil Health Index
                    </button>
                </div>
            </form>

            <!-- Results Display -->
            <div id="results" class="mt-8 pt-6 border-t border-gray-200 hidden">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Your Assessment:</h3>
                <div class="flex items-center space-x-4 bg-gray-100 p-4 rounded-lg shadow-inner">
                    <p class="text-xl font-semibold">Soil Health Index (SHI):</p>
                    <p id="shi-score" class="text-4xl font-extrabold text-soil-green"></p>
                </div>
                <div class="mt-4 p-4 rounded-lg border" id="advice-box">
                    <h4 class="font-semibold text-lg mb-2 text-soil-brown">Recommendation:</h4>
                    <p id="shi-advice" class="text-gray-700"></p>
                </div>
            </div>
             <!-- Error Message Box -->
            <div id="error-message" class="mt-8 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg hidden">
                Please enter valid values for all fields.
            </div>
        </section>

        <!-- Best Practices Section -->
        <section>
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-soil-green pb-2">Best Soil Health Practices</h2>
            <ul class="space-y-4 text-gray-700">
                <li class="p-4 bg-white rounded-lg shadow flex items-start space-x-3">
                    <span class="text-soil-green text-2xl font-bold">1.</span>
                    <div>
                        <strong class="text-soil-brown">Maximize Soil Cover:</strong> Keep the soil covered with crops or residue (e.g., mulch) year-round to protect against erosion and regulate temperature.
                    </div>
                </li>
                <li class="p-4 bg-white rounded-lg shadow flex items-start space-x-3">
                    <span class="text-soil-green text-2xl font-bold">2.</span>
                    <div>
                        <strong class="text-soil-brown">Minimize Disturbance:</strong> Reduce tillage (no-till or reduced-till farming) to maintain soil structure, organic matter, and beneficial organisms.
                    </div>
                </li>
                <li class="p-4 bg-white rounded-lg shadow flex items-start space-x-3">
                    <span class="text-soil-green text-2xl font-bold">3.</span>
                    <div>
                        <strong class="text-soil-brown">Increase Diversity:</strong> Use crop rotations, intercropping, and cover crops to enhance biodiversity above and below ground.
                    </div>
                </li>
            </ul>
        </section>

    </main>

    <!-- Footer -->
  <?php include 'D:\Xampp\htdocs\farm\components\footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('soil-health-form');
            const resultsDiv = document.getElementById('results');
            const scoreElement = document.getElementById('shi-score');
            const adviceElement = document.getElementById('shi-advice');
            const errorElement = document.getElementById('error-message');
            const adviceBox = document.getElementById('advice-box');

            form.addEventListener('submit', (e) => {
                e.preventDefault();
                errorElement.classList.add('hidden'); // Hide any previous errors
                
                const om = parseFloat(document.getElementById('om').value);
                const ph = parseFloat(document.getElementById('ph').value);
                const nPPM = parseFloat(document.getElementById('n_ppm').value);

                // Simple validation check
                if (isNaN(om) || isNaN(ph) || isNaN(nPPM) || om <= 0 || ph < 4.0 || ph > 9.0 || nPPM <= 0) {
                    errorElement.classList.remove('hidden');
                    resultsDiv.classList.add('hidden');
                    return;
                }

                // --- Simulated Soil Health Index (SHI) Calculation ---
                // This is a simplified, weighted calculation for demonstration purposes.
                let omScore = 0;
                if (om >= 4.0) omScore = 50;
                else if (om >= 3.0) omScore = 40;
                else if (om >= 2.0) omScore = 25;
                else omScore = 10;

                let phScore = 0;
                if (ph >= 6.0 && ph <= 7.0) phScore = 40; // Optimal range
                else if ((ph >= 5.5 && ph < 6.0) || (ph > 7.0 && ph <= 7.5)) phScore = 30; // Tolerable range
                else phScore = 15;

                let nScore = 0;
                if (nPPM >= 50) nScore = 30;
                else if (nPPM >= 30) nScore = 20;
                else nScore = 10;

                // Total SHI (Max possible: 50 + 40 + 30 = 120)
                // We normalize this to 100 for display (divide by 1.2)
                const totalScore = (omScore + phScore + nScore) / 1.2;
                const shi = Math.round(totalScore);

                // --- Display Results ---
                scoreElement.textContent = `${shi}/100`;
                resultsDiv.classList.remove('hidden');

                // --- Generate Advice and Styling ---
                let advice = '';
                let colorClass = '';

                if (shi >= 80) {
                    // Excellent: Green
                    advice = 'Excellent Soil Health! Your management practices are working well. Focus on maintaining current levels of Organic Matter and diversity.';
                    colorClass = 'border-green-500 text-green-700 bg-green-50';
                    scoreElement.classList.remove('text-soil-brown', 'text-accent-sage', 'text-red-700'); // Clean up old classes
                    scoreElement.classList.add('text-soil-green');
                } else if (shi >= 60) {
                    // Good: Teal (as a neutral/notice color, replacing yellow)
                    advice = `Good Soil Health, but there's room for improvement. Specifically, target the lower-scoring factors (OM:${Math.round(omScore/50*100)}%, pH:${Math.round(phScore/40*100)}%, N:${Math.round(nScore/30*100)}%) by increasing cover cropping or adjusting pH management.`;
                    colorClass = 'border-teal-500 text-teal-700 bg-teal-50'; 
                    scoreElement.classList.remove('text-soil-green', 'text-soil-brown', 'text-red-700'); // Clean up old classes
                    scoreElement.classList.add('text-accent-sage'); // Use the new sage color for the score text
                } else {
                    // Needs Improvement: Red
                    advice = 'Needs Significant Improvement. Focus on immediate steps like introducing diverse cover crops and minimizing soil disturbance to rapidly build Organic Matter and optimize pH/nutrient levels.';
                    colorClass = 'border-red-500 text-red-700 bg-red-50';
                    scoreElement.classList.remove('text-soil-green', 'text-accent-sage', 'text-soil-brown'); // Clean up old classes
                    scoreElement.classList.add('text-red-700'); // Use standard red for low score text
                }
                
                // Apply advice styling
                adviceBox.className = 'mt-4 p-4 rounded-lg border-2 ' + colorClass;
                adviceElement.textContent = advice;
            });
        });
    </script>
</body>
</html>
