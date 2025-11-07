<?php
if (!isset($base_url)) {
    $base_url = '/GreenAgro/';
}

$about_video_link = 'https://www.youtube.com/watch?v=YOUR_GREENAGRO_STORY'; // Use a dedicated video link
$about_image_path = $base_url . 'assets/images/GreenAgro_team.jpg'; // Compelling image for the video poster
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenAgro - Digital Farm Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./assets/css/header.css">
</head>

<body>
    <!-- Top Info Bar -->
    <div class="top-info">
        <div class="top-info-content">
            <div class="top-info-left">
                <a href="tel:+918511916407" id="call-link" aria-label="Call us" title="+91 8511916407">
                    <i class="fas fa-phone-alt"></i>
                    <span>+91 8511916407</span>
                </a>

                <a href="mailto:hello@greenagro.com" aria-label="Email us" title="hello@greenagro.com">
                    <i class="fas fa-envelope"></i>
                    <span>hello@greenagro.com</span>
                </a>

                <a href="#product-finder" aria-label="Find GreenAgroing products" onclick="openProductFinder(event)">
                    <i class="fas fa-search-plus"></i>
                    <span>Find Products</span>
                </a>
            </div>

            <div class="top-info-right">
                <a href="#track-order" aria-label="Track your order" onclick="openTrackOrderModal(event)">
                    <i class="fas fa-shipping-fast"></i>
                    <span>Track Order</span>
                </a>
                <a href="#support" aria-label="Customer support" onclick="openSupportModal(event)">
                    <i class="fas fa-headset"></i>
                    <span>24/7 Support</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Track Order Modal -->
    <div class="track-order-modal" id="trackOrderModal">
        <div class="modal-overlay" onclick="closeTrackOrderModal()"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-shipping-fast"></i> Track Your Order</h2>
                <button class="close-modal" onclick="closeTrackOrderModal()" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="track-order-form">
                    <div class="form-group">
                        <label for="orderId">Enter Your Order ID</label>
                        <input
                            type="text"
                            id="orderId"
                            class="form-control"
                            placeholder="e.g., GRN123456789"
                            autocomplete="off">
                    </div>
                    <button class="track-btn" onclick="trackOrder()">
                        <i class="fas fa-search"></i> Track Order
                    </button>
                </div>

                <div class="order-info" id="orderInfo">
                    <div class="order-header">
                        <h3><i class="fas fa-box"></i> Order Details</h3>
                    </div>
                    <div class="order-details">
                        <div class="order-status">
                            <div class="status-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div class="status-text" id="orderStatus">Order Shipped</div>
                        </div>

                        <div class="order-timeline" id="orderTimeline">
                            <!-- Timeline will be dynamically generated -->
                        </div>

                        <div class="order-items">
                            <h4>Order Items</h4>
                            <div id="orderItems">
                                <!-- Order items will be dynamically generated -->
                            </div>
                        </div>

                        <div class="order-summary">
                            <div class="summary-row">
                                <span>Subtotal:</span>
                                <span id="subtotal">₹0</span>
                            </div>
                            <div class="summary-row">
                                <span>Shipping:</span>
                                <span id="shipping">₹0</span>
                            </div>
                            <div class="summary-row">
                                <span>Tax:</span>
                                <span id="tax">₹0</span>
                            </div>
                            <div class="summary-row total">
                                <span>Total:</span>
                                <span id="total">₹0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="support-modal" id="supportModal">
        <div class="modal-overlay" onclick="closeSupportModal()"></div>
        <div class="support-content">
            <div class="support-header">
                <h3><i class="fas fa-headset"></i> 24/7 Customer Support</h3>
                <p>We're here to help you anytime</p>
            </div>
            <div class="support-options">
                <div class="support-option" onclick="contactSupport('phone')">
                    <div class="support-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="support-info">
                        <h4>Call Us</h4>
                        <p>+91 8511916407 (24/7 Available)</p>
                    </div>
                </div>
                <div class="support-option" onclick="contactSupport('whatsapp')">
                    <div class="support-icon">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div class="support-info">
                        <h4>WhatsApp</h4>
                        <p>Quick chat support</p>
                    </div>
                </div>
                <div class="support-option" onclick="contactSupport('email')">
                    <div class="support-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="support-info">
                        <h4>Email</h4>
                        <p>hello@greenagro.com</p>
                    </div>
                </div>
                <div class="support-option" onclick="contactSupport('chat')">
                    <div class="support-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="support-info">
                        <h4>Live Chat</h4>
                        <p>Instant messaging support</p>
                    </div>
                </div>
            </div>
            <button class="close-modal" onclick="closeSupportModal()" style="position: absolute; top: 15px; right: 15px; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #666;">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <div id="notification" class="notification">
        <i class="fas fa-check-circle"></i>
        <span id="notificationText"></span>
    </div>

    <!-- Announcement Bar -->
    <div class="announcement-bar" id="announcement">
        <div class="announcement-content">
            <div class="announcement-text">
                <div class="announcement-item">
                    <i class="fas fa-truck"></i>
                    <span>FREE Delivery on ₹2000+</span>
                </div>
                <div class="announcement-item">
                    <i class="fas fa-leaf"></i>
                    <span>100% Organic Certified</span>
                </div>
                <div class="announcement-item">
                    <i class="fas fa-clock"></i>
                    <span>Same Day Fresh Delivery</span>
                </div>
                <div class="announcement-item">
                    <i class="fas fa-award"></i>
                    <span>Premium Quality Guaranteed</span>
                </div>
                <div class="announcement-item">
                    <i class="fas fa-shield-alt"></i>
                    <span>GreenAgro to Table Freshness</span>
                </div>
            </div>
            <button class="close-announcement" onclick="closeAnnouncement()" aria-label="Close announcement">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

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
                    <a href="<?php echo $base_url; ?>index.php" class="nav-link active" role="menuitem">
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
                    <div class="dropdown-menu absolute left-1 -translate-x-1/2 mt-0 w-[610px] shadow-2xl bg-white border border-green-200 rounded-xl overflow-hidden z-10 transition-all duration-300">
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


    <section class="video-carousel">
        <div class="video-slide active">
            <video autoplay muted loop>
                <source src="<?php echo $base_url; ?>assets/images/GreenAgro Video.mp4" type="video/mp4" />
            </video>
        </div>
    </section>

    <section class="py-20 bg-white sm:py-32">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-16">
                <p class="text-bm font-bold uppercase tracking-widest mb-2" style="color: #16a34a">
                    Our Journey
                </p>
                <h2 class="text-4xl font-extrabold text-gray-900 sm:text-5xl leading-tight max-w-3xl mx-auto">
                    From a GreenAgroer's Idea to a Global <span style="color: #16a34a">Ag-Tech Leader</span>.
                </h2>
            </div>

            <div class="relative pt-8">

                <div class="timeline-separator"></div>

                <div class="relative pt-12">
                    <div class="timeline-dot top-0"></div>
                    <div class="max-w-xl mx-auto text-center p-6 bg-green-50 rounded-xl shadow-lg border-t-4 border-green-600 transform hover:scale-[1.01] transition duration-300">
                        <p class="text-xs font-semibold text-gray-500 uppercase">Phase 1: 2018 - The Seed</p>
                        <h3 class="mt-2 text-2xl font-bold text-gray-900">Identifying the Need for Change</h3>
                        <p class="mt-3 text-gray-600">
                            GreenAgro was founded by GreenAgroers, for GreenAgroers. We recognized the need for simple, data-driven tools to combat rising costs and unpredictable weather patterns, starting with our first MVP focused on soil monitoring.
                        </p>
                    </div>
                </div>

                <div class="mt-12 mb-16 relative group">
                    <div class="video-container-centered shadow-2xl overflow-hidden rounded-xl transition duration-500 group-hover:shadow-peach-500/70 group-hover:scale-[1.005]">
                        <video
                            autoplay
                            muted
                            loop
                            playsinline
                            poster="<?php echo $about_image_path; ?>"
                            class="w-full h-full">
                            <source src="<?php echo $base_url; ?>assets/images/video.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="absolute inset-0 bg-black opacity-10 rounded-xl pointer-events-none"></div>
                </div>

                <div class="relative pt-12">
                    <div class="timeline-dot top-0"></div>
                    <div class="max-w-xl mx-auto text-center p-6 bg-green-50 rounded-xl shadow-lg border-t-4 border-green-600 transform hover:scale-[1.01] transition duration-300">
                        <p class="text-xs font-semibold text-gray-500 uppercase">Phase 2: Today - Proven Impact</p>
                        <h3 class="mt-2 text-2xl font-bold text-gray-900">Scaling Up Sustainable Solutions</h3>
                        <p class="mt-3 text-gray-600">
                            Today, over **1,500 GreenAgroers** rely on GreenAgro for everything from drone mapping to financial compliance. We've established ourselves as a leader in sustainable GreenAgroing, delivering an average yield increase of 25% to our users.
                        </p>
                    </div>
                </div>

            </div>

            <div class="mt-20 pt-10 border-t border-gray-200 max-w-xl mx-auto">
                <h3 class="text-3xl font-bold text-gray-900 mb-4">Ready to Grow with Us?</h3>
                <p class="text-lg text-gray-600 mb-8">
                    Whether you want to optimize your harvest or join our mission, the next chapter starts now.
                </p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="<?php echo $base_url; ?>Includes/support.php" class="px-8 py-3 border border-transparent text-lg font-bold rounded-full shadow-xl text-white hover:bg-green-700 transition duration-300 transform hover:scale-105" style="background-color: #16a34a">
                        Request a Demo &rarr;
                    </a>
                    <a href="<?php echo $base_url; ?>components/login.php" class="px-8 py-3 border border-green-300 text-lg font-medium rounded-full shadow-md bg-white hover:bg-green-50 transition duration-300" style="color: #16a34a">
                        Explore Careers
                    </a>
                </div>
            </div>

        </div>
    </section>
    <?php include 'Components/footer.php'; ?>
    <!-- JavaScript for interactivity -->
    <script src="<?php echo $base_url; ?>assets/js/header.js"></script>
</body>

</html>