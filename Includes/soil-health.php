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
    <title>GreenAgro - Soil Health</title>
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
        <!-- Updated border color from yellow to accent-sage -->
        <!-- Introduction Section -->
        <section class="flex flex-col md:flex-row items-center bg-cover bg-center p-10" style="background-image: url('Assets/images/your-image.png');">
            <div class="md:w-1/2 text-white md:pr-8">
                <h2 class="text-3xl font-bold mb-4 text-soil-green">Understanding Your Soil</h2>
                <p class="text-black leading-relaxed ">
                    Soil health is the continued capacity of soil to function as a vital living ecosystem
                    that sustains plants, animals, and humans. Use the tools and information below
                    to assess and improve your soil.
                </p>
            </div>

            <div class="md:w-1/2 mt-6 md:mt-0 flex justify-center">
                <img src="<?php echo $base_url; ?>assets/images/Operations/soil-health.jpg" alt="Soil Plant" class="rounded-2xl shadow-lg max-w-full h-auto object-cover" style="height: 300px; width: 600px;">
            </div>
        </section>

        <!-- Key Indicators Grid -->
        <section>
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-soil-green pb-2">Key Indicators</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Indicator Card 1: Organic Matter -->
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 border-l-4 border-soil-green">
                    <div class="text-3xl mb-3">🍂</div>
                    <h3 class="text-xl font-semibold text-soil-green mb-2">Organic Matter (OM)</h3>
                    <p class="text-gray-600 text-sm">Fuel for soil microbes, improves water retention, and supplies nutrients. Goal: 3% - 6%.</p>
                </div>
                <!-- Indicator Card 2: pH Level -->
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 border-l-4 border-soil-green">
                    <div class="text-3xl mb-3">🧪</div>
                    <h3 class="text-xl font-semibold text-soil-green mb-2">pH Level</h3>
                    <p class="text-gray-600 text-sm">Controls nutrient availability. Most crops prefer a neutral range. Optimal: 6.0 - 7.0.</p>
                </div>
                <!-- Indicator Card 3: Water Infiltration -->
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 border-l-4 border-soil-green">
                    <div class="text-3xl mb-3">💧</div>
                    <h3 class="text-xl font-semibold text-soil-green mb-2">Water Infiltration</h3>
                    <p class="text-gray-600 text-sm">How quickly water enters the soil. Good structure prevents runoff and erosion.</p>
                </div>
                <!-- Indicator Card 4: Biological Activity -->
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 border-l-4 border-soil-green">
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
                <span class="ml-3 text-sm font-medium bg-soil-green text-white px-3 py-1 rounded-full">BETA</span>
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
                        <strong class="text-soil-brown">Minimize Disturbance:</strong> Reduce tillage (no-till or reduced-till GreenAgroing) to maintain soil structure, organic matter, and beneficial organisms.
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

    <!-- Repeat Operations again below if you wanted Operations twice -->
    <?php include '../components/footer.php'; ?>
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