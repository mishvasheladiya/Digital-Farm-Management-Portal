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
    <title>GreenAgro - Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
        }

        .hero {
            background: url('<?php echo $base_url; ?>assets/images/GreenAgro-inventory-hero.jpg') center/cover no-repeat;
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

    <!-- Intro Section -->
    <section class="py-12 px-6 md:px-20 text-center">
        <h2 class="text-3xl font-bold text-green-700 mb-4">Organize, Track & Optimize</h2>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto">
            GreenAgro helps GreenAgroers monitor and manage all their GreenAgroing resources in one place.
            Keep track of seeds, fertilizers, tools, and more — all from an easy-to-use digital dashboard.
        </p>
    </section>

    <!-- Feature Sections -->
    <section class="py-10 px-6 md:px-16 space-y-16">

        <!-- Seeds -->
        <div class="flex flex-col md:flex-row items-center gap-10">
            <img src="<?php echo $base_url; ?>assets/images/Operations/Seed.jpg" class="rounded-xl shadow-lg" alt="Seeds" style="height: 400px; width: 600px;">
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
            <img src="<?php echo $base_url; ?>assets/images/Operations/fertilizers.jpg" class="rounded-xl shadow-lg" alt="Fertilizers" style="height: 400px; width: 600px;">
        </div>

        <!-- Tools & Equipment -->
        <div class="flex flex-col md:flex-row items-center gap-10">
            <img src="<?php echo $base_url; ?>assets/images/Operations/equipment-tracking.jpg" class="rounded-xl shadow-lg" alt="Equipment" style="height: 400px; width: 600px;">
            <div class="md:w-1/2">
                <h3 class="text-2xl font-semibold text-green-700 mb-3">Tools & Equipment</h3>
                <p class="text-gray-700 text-lg">
                    Manage your GreenAgro tools, tractors, and machinery efficiently. Keep track of maintenance schedules, availability, and usage records to reduce downtime.
                </p>
            </div>
        </div>
    </section>


    <br />
    <!-- Repeat Operations again below if you wanted Operations twice -->
    <?php include '../components/footer.php'; ?>

</body>

</html>