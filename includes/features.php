<?php
require_once './../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Features - <?php echo SITE_NAME; ?> - <?php echo SITE_TAGLINE; ?></title>
    
    <!-- CSS & Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        :root {
            --primary-green: #10b981;
            --dark-green: #059669;
            --light-green: #d1fae5;
        }
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
        }
        
        .section-gradient {
            background: linear-gradient(to right, #f0fdf4, #dcfce7);
        }
        
        .feature-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid #e5e7eb;
            position: relative;
            overflow: hidden;
            background: white;
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            border-color: var(--primary-green);
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.15);
        }
        
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-green), var(--dark-green));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.6s ease;
        }
        
        .feature-card:hover::before {
            transform: scaleX(1);
        }
        
        .free-badge {
            position: absolute;
            top: 16px;
            right: 16px;
            background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .icon-wrapper {
            background: linear-gradient(135deg, var(--light-green), white);
            border: 2px solid var(--light-green);
            transition: all 0.3s ease;
        }
        
        .feature-card:hover .icon-wrapper {
            background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
            transform: rotate(-5deg);
        }
        
        .feature-card:hover .icon-wrapper i {
            color: white !important;
        }
        
        .category-tag {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 12px;
        }
        
        .stats-counter {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .floating {
            animation: floating 6s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .section-title {
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-green), var(--dark-green));
            border-radius: 2px;
        }
        
        .testimonial-card {
            background: linear-gradient(135deg, white, #f8fafc);
            border-left: 4px solid var(--primary-green);
        }
        
        .cta-section {
            background: linear-gradient(rgba(16, 185, 129, 0.9), rgba(5, 150, 105, 0.9)), url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <?php include '../Components/header.php'; ?>

    <!-- Navbar -->
    <?php include '../Components/navbar.php'; ?>

    <!-- Main Content -->
    <main class="min-h-screen">
        <!-- Hero Section -->
        <section class="hero-gradient text-white py-20">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="text-center">
                        <!-- Free Badge -->
                        <div class="inline-flex items-center bg-white/20 backdrop-blur-sm px-6 py-3 rounded-full mb-8">
                            <i class="fas fa-crown mr-2 text-yellow-300"></i>
                            <span class="font-bold text-lg">100% FREE - No Hidden Costs</span>
                        </div>
                        
                        <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                            All Features <span class="text-yellow-300">Completely Free</span>
                        </h1>
                        
                        <p class="text-xl mb-10 opacity-90 max-w-3xl mx-auto">
                            Every powerful feature of <?php echo SITE_NAME; ?> is available to you at absolutely no cost. 
                            We believe in empowering every farmer with advanced tools for modern agriculture.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="<?php echo $base_url; ?>Components/register.php" 
                               class="bg-white text-green-700 hover:bg-gray-100 font-bold py-4 px-8 rounded-xl text-lg transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                <i class="fas fa-rocket mr-2"></i>Get Started Free
                            </a>
                            <a href="#all-features" 
                               class="bg-transparent border-2 border-white hover:bg-white/20 text-white font-bold py-4 px-8 rounded-xl text-lg transition duration-300">
                                <i class="fas fa-arrow-down mr-2"></i>Explore Features
                            </a>
                        </div>
                        
                        <!-- Stats -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-16">
                            <div class="text-center">
                                <div class="stats-counter mb-2">25+</div>
                                <p class="opacity-90">Advanced Features</p>
                            </div>
                            <div class="text-center">
                                <div class="stats-counter mb-2">100%</div>
                                <p class="opacity-90">Free Forever</p>
                            </div>
                            <div class="text-center">
                                <div class="stats-counter mb-2">24/7</div>
                                <p class="opacity-90">Free Support</p>
                            </div>
                            <div class="text-center">
                                <div class="stats-counter mb-2">∞</div>
                                <p class="opacity-90">Unlimited Usage</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Free Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-5xl mx-auto text-center">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8 section-title">
                        Why We're Completely Free
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="p-6 rounded-xl bg-green-50">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-hand-holding-heart text-2xl text-green-600"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-3">Empowering Farmers</h3>
                            <p class="text-gray-600">We believe in making advanced farming tools accessible to every farmer, regardless of their financial capacity.</p>
                        </div>
                        
                        <div class="p-6 rounded-xl bg-blue-50">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-seedling text-2xl text-blue-600"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-3">Government Backed</h3>
                            <p class="text-gray-600">Supported by agricultural initiatives to promote digital farming across the nation.</p>
                        </div>
                        
                        <div class="p-6 rounded-xl bg-purple-50">
                            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-users text-2xl text-purple-600"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-3">Community Driven</h3>
                            <p class="text-gray-600">We grow together with our farming community, constantly improving based on your feedback.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- All Features Grid -->
        <section id="all-features" class="py-20 section-gradient">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6 section-title">
                        Complete Feature Suite
                    </h2>
                    <p class="text-xl text-gray-600">
                        Every feature listed below is 100% free with unlimited access
                    </p>
                </div>

                <!-- Feature Categories Navigation -->
                <div class="max-w-4xl mx-auto mb-12">
                    <div class="flex flex-wrap justify-center gap-3">
                        <button class="px-6 py-3 bg-green-600 text-white font-semibold rounded-full shadow-lg">
                            <i class="fas fa-th-large mr-2"></i>All Features
                        </button>
                        <button class="px-6 py-3 bg-white hover:bg-green-50 text-gray-700 font-semibold rounded-full shadow hover:shadow-lg transition">
                            <i class="fas fa-language mr-2"></i>Communication
                        </button>
                        <button class="px-6 py-3 bg-white hover:bg-blue-50 text-gray-700 font-semibold rounded-full shadow hover:shadow-lg transition">
                            <i class="fas fa-cloud-sun mr-2"></i>Weather
                        </button>
                        <button class="px-6 py-3 bg-white hover:bg-yellow-50 text-gray-700 font-semibold rounded-full shadow hover:shadow-lg transition">
                            <i class="fas fa-chart-line mr-2"></i>Market
                        </button>
                        <button class="px-6 py-3 bg-white hover:bg-green-50 text-gray-700 font-semibold rounded-full shadow hover:shadow-lg transition">
                            <i class="fas fa-truck mr-2"></i>Logistics
                        </button>
                    </div>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Language Translator -->
                    <div class="feature-card rounded-2xl p-8">
                        <span class="free-badge">FREE</span>
                        <div class="category-tag bg-purple-100 text-purple-700">
                            <i class="fas fa-language mr-1"></i> Communication
                        </div>
                        <div class="icon-wrapper w-20 h-20 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-language text-3xl text-purple-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Multi-Language Translator</h3>
                        <p class="text-gray-600 mb-6">
                            Real-time translation in 10+ Indian languages with voice support. Bridge communication gaps effortlessly.
                        </p>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span>Voice-to-text translation</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span>10+ Indian languages</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span>Offline dictionary support</span>
                            </div>
                        </div>
                    </div>

                    <!-- Weather Forecasting -->
                    <div class="feature-card rounded-2xl p-8">
                        <span class="free-badge">FREE</span>
                        <div class="category-tag bg-blue-100 text-blue-700">
                            <i class="fas fa-cloud-sun mr-1"></i> Weather
                        </div>
                        <div class="icon-wrapper w-20 h-20 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-cloud-sun text-3xl text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Smart Weather Forecasting</h3>
                        <p class="text-gray-600 mb-6">
                            Hyper-local weather predictions with farming-specific alerts and actionable recommendations.
                        </p>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span>7-day detailed forecast</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span>Rainfall probability alerts</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span>Frost & heatwave warnings</span>
                            </div>
                        </div>
                    </div>

                    <!-- Live Market Prices -->
                    <div class="feature-card rounded-2xl p-8">
                        <span class="free-badge">FREE</span>
                        <div class="category-tag bg-yellow-100 text-yellow-700">
                            <i class="fas fa-chart-line mr-1"></i> Market
                        </div>
                        <div class="icon-wrapper w-20 h-20 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-chart-line text-3xl text-yellow-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Live Market Prices</h3>
                        <p class="text-gray-600 mb-6">
                            Real-time commodity prices from 1000+ mandis with trend analysis and price predictions.
                        </p>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span>Live price updates</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span>Market trend analysis</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span>Price prediction alerts</span>
                            </div>
                        </div>
                    </div>

                    <!-- Order Tracking -->
                    <div class="feature-card rounded-2xl p-8">
                        <span class="free-badge">FREE</span>
                        <div class="category-tag bg-green-100 text-green-700">
                            <i class="fas fa-truck mr-1"></i> Logistics
                        </div>
                        <div class="icon-wrapper w-20 h-20 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-truck text-3xl text-green-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Order & Delivery Tracking</h3>
                        <p class="text-gray-600 mb-6">
                            Complete supply chain visibility with real-time tracking and delivery notifications.
                        </p>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span>Real-time location tracking</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span>ETA predictions</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span>Delivery proof capture</span>
                            </div>
                        </div>
                    </div>

                    <!-- AI Crop Recommendation -->
                    <div class="feature-card rounded-2xl p-8">
                        <span class="free-badge">FREE</span>
                        <div class="category-tag bg-purple-100 text-purple-700">
                            <i class="fas fa-brain mr-1"></i> AI Assistant
                        </div>
                        <div class="icon-wrapper w-20 h-20 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-brain text-3xl text-purple-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">AI Crop Recommendation</h3>
                        <p class="text-gray-600 mb-6">
                            Personalized crop suggestions based on soil, weather, and market conditions using AI.
                        </p>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span>Soil compatibility analysis</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span>Market demand predictions</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span>Profit estimation</span>
                            </div>
                        </div>
                    </div>

                    <!-- Financial Management -->
                    <div class="feature-card rounded-2xl p-8">
                        <span class="free-badge">FREE</span>
                        <div class="category-tag bg-green-100 text-green-700">
                            <i class="fas fa-chart-pie mr-1"></i> Finance
                        </div>
                        <div class="icon-wrapper w-20 h-20 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-chart-pie text-3xl text-green-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Financial Management</h3>
                        <p class="text-gray-600 mb-6">
                            Complete farm financial tracking, expense management, and ROI analysis tools.
                        </p>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span>Expense tracking</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span>Profit/Loss statements</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span>Subsidy tracking</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- View More Features -->
                <div class="text-center mt-12">
                    <button id="loadMoreFeatures" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-xl text-lg transition duration-300 shadow-lg hover:shadow-xl">
                        <i class="fas fa-plus mr-2"></i>Load More Features
                    </button>
                </div>
            </div>
        </section>

        <!-- How It Works -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6 section-title">
                        Getting Started is Easy
                    </h2>
                    <p class="text-xl text-gray-600">
                        Access all features in just 3 simple steps
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                    <div class="text-center relative">
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 relative z-10">
                            <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                                1
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Sign Up Free</h3>
                        <p class="text-gray-600">Create your free account in under 2 minutes. No payment required.</p>
                    </div>
                    
                    <div class="text-center relative">
                        <div class="absolute top-10 left-0 right-0 h-1 bg-green-200 md:block hidden"></div>
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 relative z-10">
                            <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                                2
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Setup Your Farm</h3>
                        <p class="text-gray-600">Add your farm details, crops, and preferences in our guided setup.</p>
                    </div>
                    
                    <div class="text-center relative">
                        <div class="absolute top-10 left-0 right-0 h-1 bg-green-200 md:block hidden"></div>
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 relative z-10">
                            <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                                3
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Start Using Features</h3>
                        <p class="text-gray-600">Immediately access all features and start optimizing your farm.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="py-20 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6 section-title">
                        What Farmers Say
                    </h2>
                    <p class="text-xl text-gray-600">
                        Join thousands of farmers already benefiting from our free platform
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <div class="testimonial-card p-8 rounded-2xl">
                        <div class="flex items-center mb-6">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                 alt="Farmer" class="w-16 h-16 rounded-full mr-4">
                            <div>
                                <h4 class="font-bold text-lg">Rajesh Kumar</h4>
                                <p class="text-green-600">Wheat Farmer, Punjab</p>
                            </div>
                        </div>
                        <p class="text-gray-600 italic mb-6">
                            "The market price feature alone has increased my profits by 30%. And it's completely free!"
                        </p>
                        <div class="text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    
                    <div class="testimonial-card p-8 rounded-2xl">
                        <div class="flex items-center mb-6">
                            <img src="https://images.unsplash.com/photo-1534751516642-a1af1ef26a56?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                 alt="Farmer" class="w-16 h-16 rounded-full mr-4">
                            <div>
                                <h4 class="font-bold text-lg">Priya Sharma</h4>
                                <p class="text-green-600">Organic Farmer, Maharashtra</p>
                            </div>
                        </div>
                        <p class="text-gray-600 italic mb-6">
                            "Weather alerts saved my crops from unexpected rain. This platform is a lifesaver for farmers."
                        </p>
                        <div class="text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    
                    <div class="testimonial-card p-8 rounded-2xl">
                        <div class="flex items-center mb-6">
                            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" 
                                 alt="Farmer" class="w-16 h-16 rounded-full mr-4">
                            <div>
                                <h4 class="font-bold text-lg">Amit Patel</h4>
                                <p class="text-green-600">Tea Grower, Assam</p>
                            </div>
                        </div>
                        <p class="text-gray-600 italic mb-6">
                            "Free access to AI crop recommendations has transformed how I plan my seasons. Incredible value!"
                        </p>
                        <div class="text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Final CTA -->
        <section class="cta-section py-20 text-white">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">
                        Ready to Transform Your Farming?
                    </h2>
                    <p class="text-xl mb-10 opacity-90">
                        Join <?php echo SITE_NAME; ?> today and get instant access to all features, completely free forever.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-6 justify-center">
                        <a href="<?php echo $base_url; ?>Components/register.php" 
                           class="bg-white text-green-700 hover:bg-gray-100 font-bold py-4 px-10 rounded-xl text-lg transition duration-300 shadow-2xl hover:shadow-3xl transform hover:-translate-y-1">
                            <i class="fas fa-user-plus mr-2"></i>Create Free Account
                        </a>
                        <a href="<?php echo $base_url; ?>Components/login.php" 
                           class="bg-transparent border-2 border-white hover:bg-white/20 font-bold py-4 px-10 rounded-xl text-lg transition duration-300">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login to Existing Account
                        </a>
                    </div>
                    <p class="mt-8 opacity-75">
                        <i class="fas fa-shield-alt mr-2"></i>100% Secure • No Credit Card Required • Unlimited Free Access
                    </p>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include '../Components/footer.php'; ?>

    <script>
        // Load More Features
        document.getElementById('loadMoreFeatures').addEventListener('click', function() {
            const features = [
                {
                    title: "Soil Health Analysis",
                    description: "Detailed soil testing and nutrient recommendations for optimal crop growth.",
                    icon: "fas fa-vial",
                    category: "Science",
                    color: "orange"
                },
                {
                    title: "Pest Management",
                    description: "Early detection and treatment recommendations using AI image recognition.",
                    icon: "fas fa-bug",
                    category: "Protection",
                    color: "red"
                },
                {
                    title: "Irrigation Scheduling",
                    description: "Automated irrigation planning based on soil moisture and weather forecasts.",
                    icon: "fas fa-tint",
                    category: "Water",
                    color: "blue"
                },
                {
                    title: "Community Forum",
                    description: "Connect with other farmers, share experiences, and get expert advice.",
                    icon: "fas fa-users",
                    category: "Community",
                    color: "purple"
                },
                {
                    title: "Mobile App Access",
                    description: "Full-featured mobile app for farm management on the go with offline support.",
                    icon: "fas fa-mobile-alt",
                    category: "Mobile",
                    color: "indigo"
                },
                {
                    title: "Government Schemes",
                    description: "Information and application support for government agricultural schemes.",
                    icon: "fas fa-landmark",
                    category: "Government",
                    color: "gray"
                }
            ];
            
            const container = document.querySelector('.grid.grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-3');
            
            features.forEach(feature => {
                const colors = {
                    orange: {bg: 'bg-orange-100', text: 'text-orange-700'},
                    red: {bg: 'bg-red-100', text: 'text-red-700'},
                    blue: {bg: 'bg-blue-100', text: 'text-blue-700'},
                    purple: {bg: 'bg-purple-100', text: 'text-purple-700'},
                    indigo: {bg: 'bg-indigo-100', text: 'text-indigo-700'},
                    gray: {bg: 'bg-gray-100', text: 'text-gray-700'}
                };
                
                const color = colors[feature.color];
                const iconColor = `text-${feature.color}-600`;
                
                const featureCard = document.createElement('div');
                featureCard.className = 'feature-card rounded-2xl p-8';
                featureCard.innerHTML = `
                    <span class="free-badge">FREE</span>
                    <div class="category-tag ${color.bg} ${color.text}">
                        <i class="${feature.icon} mr-1"></i> ${feature.category}
                    </div>
                    <div class="icon-wrapper w-20 h-20 rounded-2xl flex items-center justify-center mb-6">
                        <i class="${feature.icon} text-3xl ${iconColor}"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">${feature.title}</h3>
                    <p class="text-gray-600 mb-6">${feature.description}</p>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <span>Available for free</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <span>Unlimited usage</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <span>Regular updates</span>
                        </div>
                    </div>
                `;
                
                // Add animation
                featureCard.style.opacity = '0';
                featureCard.style.transform = 'translateY(20px)';
                
                container.appendChild(featureCard);
                
                // Animate in
                setTimeout(() => {
                    featureCard.style.transition = 'all 0.6s ease';
                    featureCard.style.opacity = '1';
                    featureCard.style.transform = 'translateY(0)';
                }, 50);
            });
            
            // Hide the button after loading
            this.style.display = 'none';
            
            // Show message
            const message = document.createElement('div');
            message.className = 'text-center mt-8 text-green-600 font-semibold';
            message.innerHTML = '<i class="fas fa-check-circle mr-2"></i>All features loaded!';
            this.parentElement.appendChild(message);
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add scroll animation to feature cards
        function animateOnScroll() {
            const cards = document.querySelectorAll('.feature-card');
            cards.forEach(card => {
                const rect = card.getBoundingClientRect();
                if (rect.top < window.innerHeight - 100) {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }
            });
        }

        // Initialize animations
        window.addEventListener('load', () => {
            document.querySelectorAll('.feature-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'all 0.6s ease';
            });
            setTimeout(animateOnScroll, 100);
        });
        
        window.addEventListener('scroll', animateOnScroll);
    </script>
</body>
</html>