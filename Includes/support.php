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
    <title>GreenAgro - Support</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        .form-card {
            border-left: 4px solid #16a34a;
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
            border-color: #15803d;
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

<body>
    <!-- Header -->
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
                    <a href="#account" class="action-btn" title="My Account" aria-label="My Account" onclick="openLoginModal()">
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

                    <a href="<?php echo $base_url; ?>components/login.php" class="login-btn">
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
                    <a href="#operations" class="nav-link" role="menuitem" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-tractor"></i>
                        <span>Operations</span>
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu absolutec left-1 -translate-x-1/2 mt-0 w-[610px] shadow-2xl bg-white border border-green-200 rounded-xl overflow-hidden z-10 transition-all duration-300">
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
                    <a href="<?php echo $base_url; ?>Includes/support.php" class="nav-link active" role="menuitem">
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
                            <input id="email" name="email" type="email" required placeholder="hello@greenagro.com" class="input-field w-full">
                        </div>
                    </div>
                </div>

                <!-- Section 2 -->
                <div class="bg-gray-50 rounded-lg shadow-sm form-card">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="bg-green-100 text-green-700 rounded-full h-8 w-8 flex items-center justify-center mr-3 font-bold">2</span>
                        GreenAgro Profile
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="GreenAgro-size" class="block text-sm font-medium text-gray-700 mb-1">Total Land Area *</label>
                            <select id="GreenAgro-size" name="GreenAgro-size" required class="input-field w-full">
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
                        <svg id="spinner" class="hidden animate-spin h-5 w-5 text-white ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.37 0 0 5.37 0 12h4z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div><br><br>

    <!-- Repeat header again below if you wanted header twice -->
    <?php include '../components/footer.php'; ?>

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
            box.className = type === 'success' ?
                'p-4 mb-6 rounded-lg text-green-800 bg-green-100 border border-green-300 text-center font-medium' :
                'p-4 mb-6 rounded-lg text-red-800 bg-red-100 border border-red-300 text-center font-medium';
        }
    </script>
</body>

</html>