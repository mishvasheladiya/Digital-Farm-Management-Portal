<?php
if (!isset($base_url)) {
    $base_url = '/GreenAgro/';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenAgro - Irrigation Schedules</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'soil-green': '#16a34a',
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

<body>
    <!-- Operations -->
    <?php include '../components/header.php'; ?>

    <!-- Main Navbar -->
    <nav class="navbar" id="navbar" role="navigation" aria-label="Main navigation">
        <div class="nav-container">
            <!-- Main Navigation Row -->
            <div class="nav-main">
                <!-- Logo -->
                <a href="<?php echo $base_url; ?>index.php" class="logo-container" aria-label="GreenAgro Home">
                    <div class="logo"><img src="<?php echo $base_url; ?>assets/images/logo.png"></div>
                    <div class="logo-text">
                        <h1>GreenAgro</h1>
                        <span>PREMIUM ORGANIC MARKETPLACE</span>
                    </div>
                </a>

                <!-- Search Container -->
                <div class="search-container">
                    <div class="search-bar">
                        <input type="search" placeholder="Search seeds, fertilizers, equipment, crops..."
                            id="searchInput" aria-label="Search products" autocomplete="off">
                        <div class="search-actions">
                            <button class="voice-search" title="Voice Search" aria-label="Start voice search"
                                type="button">
                                <i class="fas fa-microphone"></i>
                            </button>
                            <button class="search-btn" aria-label="Search products" type="button">
                                <i class="fas fa-search"></i>
                                <span>Search</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <!-- Account Button -->
                    <a href="#account" class="action-btn" onclick="openLoginModal()" title="My Account" aria-label="My Account">
                        <i class="fas fa-user-circle"></i>
                        <span>Account</span>
                    </a>
                    <a href="#translate" class="action-btn" id="translateBtn" title="Language"
                        aria-label="Language">
                        <i class="fas fa-globe"></i>
                        <span>Language</span>
                    </a>

                    <a href="#cart" class="action-btn" id="cartBtn" title="Shopping Cart" aria-label="Shopping Cart">
                        <i class="fas fa-shopping-bag"></i>
                        <span>Cart</span>
                        <div class="cart-count" id="cartCount">0</div>
                    </a>

                    <a href="<?php echo $base_url; ?>components/login.php" class="login-btn" id="loginBtn">
                        Login / Get Started
                    </a>
                </div>

                <!-- Mobile Menu Toggle -->
                <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle mobile menu" aria-expanded="false"
                    type="button">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

            <!-- Navigation Menu -->
            <ul class="nav-menu" id="navMenu" role="menubar">
                <li class="nav-item" role="none">
                    <a href="<?php echo $base_url; ?>index.php" class="nav-link" role="menuitem">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="nav-item dropdown" role="none">
                    <a href="#products" class="nav-link" role="menuitem" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-seedling"></i>
                        <span>Products</span>
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li role="none"><a href="<?php echo $base_url; ?>Includes/all-products.php" class="dropdown-item" role="menuitem">🛒 All Products</a></li>
                        <li role="none"><a href="<?php echo $base_url; ?>Includes/seeds.php" class="dropdown-item" role="menuitem">🌱 Seeds</a></li>
                        <li role="none"><a href="<?php echo $base_url; ?>Includes/pesticides.php" class="dropdown-item" role="menuitem">🛡️ Pesticides</a></li>
                        <li role="none"><a href="<?php echo $base_url; ?>Includes/fertilizers.php" class="dropdown-item" role="menuitem">🧪 Fertilizers</a></li>
                        <li role="none"><a href="<?php echo $base_url; ?>Includes/hardware.php" class="dropdown-item" role="menuitem">🔧 Hardware</a></li>
                        <li role="none"><a href="<?php echo $base_url; ?>Includes/combo-kit.php" class="dropdown-item" role="menuitem">🎁 Combo Kit</a></li>
                    </ul>
                </li>
                <li class="nav-item" role="none">
                    <a href="<?php echo $base_url; ?>Includes/industries.php" class="nav-link" role="menuitem">
                        <i class="fas fa-industry"></i>
                        <span>Industries</span>
                    </a>
                </li>
                <li class="nav-item" role="none">
                    <a href="<?php echo $base_url; ?>Includes/our-solutions.php" class="nav-link" role="menuitem">
                        <i class="fas fa-cogs"></i>
                        <span>Our Solutions</span>
                    </a>
                </li>
                <li class="nav-item" role="none">
                    <a href="<?php echo $base_url; ?>Includes/features.php" class="nav-link" role="menuitem">
                        <i class="fas fa-star"></i>
                        <span>Features</span>
                    </a>
                </li>
                <li class="nav-item dropdown" role="none">
                    <a href="#operations" class="nav-link active" role="menuitem" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-tractor"></i>
                        <span>Operations</span>
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu absolute left-0 -translate-x-0 mt-0 w-[600px] shadow-2xl bg-white border border-green-200 rounded-xl overflow-hidden z-10 transition-all duration-300">
                        <div class="p-6 grid grid-cols-3 gap-6">

                            <!-- Column 1: Field Management -->
                            <div>
                                <p class="font-bold text-green-800 mb-2 border-b border-green-100 pb-1">Field Management</p>
                                <div class="space-y-1 text-sm">
                                    <a href="<?php echo $base_url; ?>Includes/crop-planning.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition">Crop Planning</a>
                                    <a href="<?php echo $base_url; ?>Includes/soil-health.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition">Soil Health</a>
                                    <a href="<?php echo $base_url; ?>Includes/irrigation-schedules.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition">Irrigation Schedules</a>
                                </div>
                            </div>

                            <!-- Column 2: Resources & Assets -->
                            <div>
                                <p class="font-bold text-green-800 mb-2 border-b border-green-100 pb-1">Resources & Assets</p>
                                <div class="space-y-1 text-sm">
                                    <a href="<?php echo $base_url; ?>Includes/equipment-tracking.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition">Equipment Tracking</a>
                                    <a href="<?php echo $base_url; ?>Includes/inventory.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition">Inventory (Seeds/Fertilizer)</a>
                                    <a href="<?php echo $base_url; ?>Includes/maintenance-logs.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition">Maintenance Logs</a>
                                </div>
                            </div>

                            <!-- Column 3: Analytics & Reporting -->
                            <div>
                                <p class="font-bold text-green-800 mb-2 border-b border-green-100 pb-1">Analytics & Reporting</p>
                                <div class="space-y-1 text-sm">
                                    <a href="<?php echo $base_url; ?>Includes/yield-forecasting.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition">Yield Forecasting</a>
                                    <a href="<?php echo $base_url; ?>Includes/financial-dashboards.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition">Financial Dashboards</a>
                                    <a href="<?php echo $base_url; ?>Includes/audit-trails.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition">Audit Trails</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item" role="none">
                    <a href="<?php echo $base_url; ?>Includes/about-us.php" class="nav-link" role="menuitem">
                        <i class="fas fa-info-circle"></i>
                        <span>About Us</span>
                    </a>
                </li>
                <li class="nav-item" role="none">
                    <a href="<?php echo $base_url; ?>Includes/support.php" class="nav-link" role="menuitem">
                        <i class="fas fa-hands-helping"></i>
                        <span>Supports</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Account Login Modal -->
    <div class="login-modal" id="loginModal">
        <div class="login-container">
            <div class="login-header">
                <h2>Welcome to GreenAgro</h2>
                <p>Choose your preferred login method</p>
                <button class="close-login" onclick="closeLoginModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="login-content">
                <!-- Login Options Selection -->
                <div class="login-options" id="loginOptions">
                    <div class="login-option" data-option="mobile" onclick="selectLoginOption('mobile')">
                        <div class="option-icon mobile-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div class="option-text">
                            <div class="option-title">Mobile OTP Login</div>
                            <div class="option-desc">Get a one-time password on your mobile</div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </div>

                    <div class="login-option" data-option="email" onclick="selectLoginOption('email')">
                        <div class="option-icon email-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="option-text">
                            <div class="option-title">Email & Password</div>
                            <div class="option-desc">Login with your email and password</div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </div>

                    <div class="login-option" data-option="google" onclick="selectLoginOption('google')">
                        <div class="option-icon google-icon">
                            <i class="fab fa-google"></i>
                        </div>
                        <div class="option-text">
                            <div class="option-title">Continue with Google</div>
                            <div class="option-desc">Quick login with your Google account</div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </div>

                    <div class="login-option" data-option="facebook" onclick="selectLoginOption('facebook')">
                        <div class="option-icon facebook-icon">
                            <i class="fab fa-facebook-f"></i>
                        </div>
                        <div class="option-text">
                            <div class="option-title">Continue with Facebook</div>
                            <div class="option-desc">Quick login with your Facebook account</div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </div>
                </div>

                <!-- Mobile OTP Login Form -->
                <div class="login-form" id="mobileLoginForm">
                    <div class="back-to-options" onclick="backToOptions()">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to login options</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="mobileNumber">Mobile Number</label>
                        <input type="tel" class="form-control" id="mobileNumber" placeholder="Enter your mobile number" maxlength="10">
                        <div class="error-message" id="mobileError">Please enter a valid 10-digit mobile number</div>
                    </div>

                    <button class="btn btn-primary" id="getOtpBtn" onclick="getOTP()">
                        <i class="fas fa-mobile-alt"></i> Get OTP
                    </button>

                    <div class="form-group" id="otpSection" style="display: none;">
                        <label class="form-label">Enter OTP</label>
                        <div class="otp-inputs">
                            <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 1)">
                            <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 2)">
                            <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 3)">
                            <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 4)">
                            <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 5)">
                            <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 6)">
                        </div>
                        <div class="error-message" id="otpError">Please enter the 6-digit OTP</div>
                        <div class="success-message" id="otpSuccess">OTP verified successfully!</div>

                        <div class="resend-otp">
                            Didn't receive OTP? <a href="javascript:void(0);" id="resendOtpLink" onclick="resendOTP()">Resend OTP</a>
                            <span id="countdown" class="countdown" style="display: none;">in <span id="countdownTimer">60</span>s</span>
                        </div>

                        <button class="btn btn-primary" id="verifyOtpBtn" onclick="verifyOTP()" style="margin-top: 16px;">
                            <i class="fas fa-check-circle"></i> Verify & Login
                        </button>
                    </div>
                </div>

                <!-- Email/Password Login Form -->
                <div class="login-form" id="emailLoginForm">
                    <div class="back-to-options" onclick="backToOptions()">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to login options</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        <div class="error-message" id="emailError">Please enter a valid email address</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="password-container">
                            <input type="password" class="form-control" id="password" placeholder="Enter your password">
                            <button type="button" class="password-toggle" id="passwordToggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="error-message" id="passwordError">Please enter your password</div>
                    </div>

                    <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <input type="checkbox" id="rememberMe"><label for="rememberMe">Remember me</label>
                        </div>
                        <a href="<?php echo $base_url; ?>components/forgot-password.php" style="color: #16a34a; text-decoration: none; font-size: 0.875rem;">Forgot Password?</a>
                    </div>

                    <button class="btn btn-primary" onclick="loginWithEmail()">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </div>

                <div class="login-footer">
                    Don't have an account? <a href="<?php echo $base_url; ?>components/register.php" onclick="showSignup()">Sign up</a>
                </div>
            </div>
        </div>
    </div>

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

    </main><br />
    <!-- Repeat Operations again below if you wanted Operations twice -->
    <?php include '../components/footer.php'; ?>
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