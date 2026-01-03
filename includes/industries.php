<?php
require_once './../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Farm Management Portal - <?php echo SITE_NAME; ?> - <?php echo SITE_TAGLINE; ?></title>
    
    <!-- CSS & Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 50%, #bbf7d0 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .card-hover:hover {
            transform: translateY(-10px);
            border-color: #10b981;
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.1);
        }
        .feature-icon {
            background: linear-gradient(135deg, #10b981, #059669);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .dashboard-preview {
            background: linear-gradient(145deg, #f8fafc, #f1f5f9);
            border-radius: 20px;
            position: relative;
            overflow: hidden;
        }
        .dashboard-preview::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #10b981, #3b82f6, #8b5cf6);
        }
        .tab-active {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }
        .stat-card {
            background: white;
            border-left: 4px solid #10b981;
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateX(5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .animated-progress {
            animation: progress 1.5s ease-in-out;
        }
        @keyframes progress {
            from { width: 0; }
        }
        .tech-badge {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            transition: all 0.3s ease;
        }
        .tech-badge:hover {
            background: rgba(16, 185, 129, 0.2);
            transform: scale(1.05);
        }
        .sensor-animation {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
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
        <section class="gradient-bg py-20">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div>
                            <div class="inline-flex items-center bg-white px-4 py-2 rounded-full shadow-sm mb-6">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                                <span class="text-sm font-semibold text-green-700">AI-Powered Platform</span>
                            </div>
                            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                                 Digital Farm Management Portal
                            </h1>
                            <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                                Transform your agricultural operations with our all-in-one digital platform. 
                                Monitor, manage, and optimize your farm operations in real-time with data-driven insights.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="<?php echo $base_url; ?>Components/register.php" 
                                   class="bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-8 rounded-xl text-lg transition duration-300 shadow-lg hover:shadow-xl">
                                    <i class="fas fa-play-circle mr-2"></i>Start Free Trial
                                </a>
                                <a href="#features" 
                                   class="bg-white hover:bg-gray-50 text-green-600 border-2 border-green-600 font-bold py-4 px-8 rounded-xl text-lg transition duration-300 shadow-lg hover:shadow-xl">
                                    <i class="fas fa-eye mr-2"></i>View Features
                                </a>
                            </div>
                            <div class="mt-8 flex items-center space-x-6">
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400 mr-2"></i>
                                    <span class="font-semibold">4.9/5 Rating</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-users text-green-600 mr-2"></i>
                                    <span class="font-semibold">10,000+ Farmers</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-chart-line text-blue-600 mr-2"></i>
                                    <span class="font-semibold">30% Avg. Yield Increase</span>
                                </div>
                            </div>
                        </div>
                        <div class="relative">
                            <div class="dashboard-preview p-4 shadow-2xl">
                                <div class="bg-white rounded-xl p-6 shadow-inner">
                                    <div class="flex items-center justify-between mb-6">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                        </div>
                                        <h3 class="font-bold text-gray-800">Farm Dashboard</h3>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4 mb-6">
                                        <div class="bg-green-50 p-4 rounded-lg">
                                            <p class="text-sm text-gray-600">Soil Moisture</p>
                                            <div class="flex items-center justify-between">
                                                <span class="text-2xl font-bold text-green-700">65%</span>
                                                <i class="fas fa-tint text-green-500 text-xl"></i>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                                                <div class="bg-green-500 h-2 rounded-full" style="width: 65%"></div>
                                            </div>
                                        </div>
                                        <div class="bg-blue-50 p-4 rounded-lg">
                                            <p class="text-sm text-gray-600">Crop Health</p>
                                            <div class="flex items-center justify-between">
                                                <span class="text-2xl font-bold text-blue-700">92%</span>
                                                <i class="fas fa-heartbeat text-blue-500 text-xl"></i>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                                                <div class="bg-blue-500 h-2 rounded-full" style="width: 92%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-700">Irrigation Status</span>
                                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">Active</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-700">Weather Alert</span>
                                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm font-semibold">Rain Expected</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-700">Market Prices</span>
                                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">₹5,200/ton</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Floating Elements -->
                            <div class="absolute -top-4 -right-4 bg-white p-4 rounded-xl shadow-lg">
                                <i class="fas fa-robot text-3xl text-green-600"></i>
                            </div>
                            <div class="absolute -bottom-4 -left-4 bg-white p-4 rounded-xl shadow-lg">
                                <i class="fas fa-chart-bar text-3xl text-blue-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">
                        Comprehensive Farm Management Features
                    </h2>
                    <p class="text-xl text-gray-600">
                        Everything you need to manage your farm efficiently, from crop planning to market sales
                    </p>
                </div>

                <!-- Feature Tabs -->
                <div class="max-w-6xl mx-auto">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mb-12">
                        <button class="tab-btn py-4 px-6 rounded-xl font-semibold transition-all duration-300 tab-active" data-tab="monitoring">
                            <i class="fas fa-desktop mr-2"></i>Live Monitoring
                        </button>
                        <button class="tab-btn py-4 px-6 rounded-xl font-semibold bg-gray-100 hover:bg-gray-200 transition-all duration-300" data-tab="planning">
                            <i class="fas fa-calendar-alt mr-2"></i>Crop Planning
                        </button>
                        <button class="tab-btn py-4 px-6 rounded-xl font-semibold bg-gray-100 hover:bg-gray-200 transition-all duration-300" data-tab="analytics">
                            <i class="fas fa-chart-pie mr-2"></i>Analytics
                        </button>
                        <button class="tab-btn py-4 px-6 rounded-xl font-semibold bg-gray-100 hover:bg-gray-200 transition-all duration-300" data-tab="market">
                            <i class="fas fa-shopping-cart mr-2"></i>Marketplace
                        </button>
                    </div>

                    <!-- Tab Content -->
                    <div id="tab-content" class="bg-gray-50 rounded-2xl p-8">
                        <!-- Monitoring Tab -->
                        <div class="tab-panel active" id="monitoring-panel">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                                <div>
                                    <h3 class="text-3xl font-bold text-gray-900 mb-6">Real-Time Farm Monitoring</h3>
                                    <p class="text-gray-600 mb-6 text-lg">
                                        Monitor every aspect of your farm in real-time with IoT sensors and satellite data. 
                                        Get instant alerts and make data-driven decisions.
                                    </p>
                                    <ul class="space-y-4">
                                        <li class="flex items-center">
                                            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                                            <span class="text-gray-700 font-medium">Soil moisture, temperature, and pH sensors</span>
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                                            <span class="text-gray-700 font-medium">Weather station integration</span>
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                                            <span class="text-gray-700 font-medium">Drone-based crop health imaging</span>
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                                            <span class="text-gray-700 font-medium">Livestock tracking and health monitoring</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="relative">
                                    <div class="bg-white p-8 rounded-xl shadow-lg">
                                        <div class="flex justify-between items-center mb-6">
                                            <h4 class="font-bold text-gray-800">Sensor Network</h4>
                                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">24 Active</span>
                                        </div>
                                        <div class="grid grid-cols-2 gap-4">
                                            <div class="text-center p-4 bg-green-50 rounded-lg">
                                                <i class="fas fa-thermometer-half text-3xl text-green-600 mb-2 sensor-animation"></i>
                                                <p class="font-semibold">Temperature</p>
                                                <p class="text-2xl font-bold">28°C</p>
                                            </div>
                                            <div class="text-center p-4 bg-blue-50 rounded-lg">
                                                <i class="fas fa-tint text-3xl text-blue-600 mb-2 sensor-animation"></i>
                                                <p class="font-semibold">Humidity</p>
                                                <p class="text-2xl font-bold">65%</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Planning Tab -->
                        <div class="tab-panel hidden" id="planning-panel">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                                <div class="order-2 lg:order-1">
                                    <div class="bg-white p-8 rounded-xl shadow-lg">
                                        <div class="flex justify-between items-center mb-6">
                                            <h4 class="font-bold text-gray-800">Crop Planning Calendar</h4>
                                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">AI Optimized</span>
                                        </div>
                                        <div class="space-y-4">
                                            <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                                <div class="flex items-center">
                                                    <i class="fas fa-seedling text-green-600 mr-3"></i>
                                                    <span>Wheat Planting</span>
                                                </div>
                                                <span class="font-semibold">Nov 15</span>
                                            </div>
                                            <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                                                <div class="flex items-center">
                                                    <i class="fas fa-seedling text-yellow-600 mr-3"></i>
                                                    <span>Fertilizer Application</span>
                                                </div>
                                                <span class="font-semibold">Dec 5</span>
                                            </div>
                                            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                                <div class="flex items-center">
                                                    <i class="fas fa-tint text-blue-600 mr-3"></i>
                                                    <span>Irrigation Schedule</span>
                                                </div>
                                                <span class="font-semibold">Daily</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-1 lg:order-2">
                                    <h3 class="text-3xl font-bold text-gray-900 mb-6">Smart Crop Planning</h3>
                                    <p class="text-gray-600 mb-6 text-lg">
                                        AI-powered crop rotation suggestions, planting schedules, and resource optimization based on weather patterns, soil conditions, and market trends.
                                    </p>
                                    <ul class="space-y-4">
                                        <li class="flex items-center">
                                            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                                            <span class="text-gray-700 font-medium">Seasonal planning calendar with alerts</span>
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                                            <span class="text-gray-700 font-medium">Crop compatibility analysis</span>
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                                            <span class="text-gray-700 font-medium">Yield prediction models</span>
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                                            <span class="text-gray-700 font-medium">Resource requirement forecasting</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Analytics Tab -->
                        <div class="tab-panel hidden" id="analytics-panel">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                                <div>
                                    <h3 class="text-3xl font-bold text-gray-900 mb-6">Advanced Analytics & Insights</h3>
                                    <p class="text-gray-600 mb-6 text-lg">
                                        Turn raw data into actionable insights with our powerful analytics dashboard. 
                                        Track performance, identify trends, and optimize operations.
                                    </p>
                                    <ul class="space-y-4">
                                        <li class="flex items-center">
                                            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                                            <span class="text-gray-700 font-medium">Yield analysis and forecasting</span>
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                                            <span class="text-gray-700 font-medium">Cost-benefit analysis</span>
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                                            <span class="text-gray-700 font-medium">Resource utilization reports</span>
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                                            <span class="text-gray-700 font-medium">Performance benchmarking</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="relative">
                                    <div class="bg-white p-8 rounded-xl shadow-lg">
                                        <div class="flex justify-between items-center mb-6">
                                            <h4 class="font-bold text-gray-800">Performance Metrics</h4>
                                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm font-semibold">Live Data</span>
                                        </div>
                                        <div class="space-y-4">
                                            <div>
                                                <div class="flex justify-between mb-1">
                                                    <span class="text-gray-700">Crop Yield</span>
                                                    <span class="font-bold text-green-700">+25%</span>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-2">
                                                    <div class="bg-green-500 h-2 rounded-full" style="width: 75%"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="flex justify-between mb-1">
                                                    <span class="text-gray-700">Water Efficiency</span>
                                                    <span class="font-bold text-blue-700">+40%</span>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-2">
                                                    <div class="bg-blue-500 h-2 rounded-full" style="width: 90%"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="flex justify-between mb-1">
                                                    <span class="text-gray-700">Cost Reduction</span>
                                                    <span class="font-bold text-red-700">-15%</span>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-2">
                                                    <div class="bg-red-500 h-2 rounded-full" style="width: 85%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Marketplace Tab -->
                        <div class="tab-panel hidden" id="market-panel">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                                <div class="order-2 lg:order-1">
                                    <div class="bg-white p-8 rounded-xl shadow-lg">
                                        <div class="flex justify-between items-center mb-6">
                                            <h4 class="font-bold text-gray-800">Market Prices</h4>
                                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm font-semibold">Live Updates</span>
                                        </div>
                                        <div class="space-y-4">
                                            <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                                <div class="flex items-center">
                                                    <i class="fas fa-wheat-alt text-green-600 mr-3"></i>
                                                    <span>Wheat (per quintal)</span>
                                                </div>
                                                <span class="font-bold text-green-700">₹2,450</span>
                                            </div>
                                            <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                                                <div class="flex items-center">
                                                    <i class="fas fa-rice text-yellow-600 mr-3"></i>
                                                    <span>Rice (per quintal)</span>
                                                </div>
                                                <span class="font-bold text-yellow-700">₹3,200</span>
                                            </div>
                                            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                                <div class="flex items-center">
                                                    <i class="fas fa-carrot text-blue-600 mr-3"></i>
                                                    <span>Vegetables (avg)</span>
                                                </div>
                                                <span class="font-bold text-blue-700">₹1,800</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-1 lg:order-2">
                                    <h3 class="text-3xl font-bold text-gray-900 mb-6">Integrated Marketplace</h3>
                                    <p class="text-gray-600 mb-6 text-lg">
                                        Connect directly with buyers, access live market prices, and manage your entire 
                                        supply chain from a single platform.
                                    </p>
                                    <ul class="space-y-4">
                                        <li class="flex items-center">
                                            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                                            <span class="text-gray-700 font-medium">Direct buyer connections</span>
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                                            <span class="text-gray-700 font-medium">Live commodity prices</span>
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                                            <span class="text-gray-700 font-medium">Logistics management</span>
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                                            <span class="text-gray-700 font-medium">Payment gateway integration</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- All Features Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-16">
                    <div class="card-hover bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-seedling text-3xl feature-icon"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Smart Crop Planning</h3>
                        <p class="text-gray-600 mb-4">
                            AI-powered crop rotation suggestions, planting schedules, and resource optimization.
                        </p>
                        <ul class="space-y-2">
                            <li class="flex items-center text-sm">
                                <i class="fas fa-circle text-green-500 mr-2 text-xs"></i>
                                <span>Seasonal planning calendar</span>
                            </li>
                            <li class="flex items-center text-sm">
                                <i class="fas fa-circle text-green-500 mr-2 text-xs"></i>
                                <span>Crop compatibility analysis</span>
                            </li>
                            <li class="flex items-center text-sm">
                                <i class="fas fa-circle text-green-500 mr-2 text-xs"></i>
                                <span>Yield prediction models</span>
                            </li>
                        </ul>
                    </div>

                    <div class="card-hover bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-tint text-3xl feature-icon"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Precision Irrigation</h3>
                        <p class="text-gray-600 mb-4">
                            Automated irrigation control based on soil moisture, weather forecasts, and crop needs.
                        </p>
                        <ul class="space-y-2">
                            <li class="flex items-center text-sm">
                                <i class="fas fa-circle text-blue-500 mr-2 text-xs"></i>
                                <span>Smart valve control</span>
                            </li>
                            <li class="flex items-center text-sm">
                                <i class="fas fa-circle text-blue-500 mr-2 text-xs"></i>
                                <span>Water usage analytics</span>
                            </li>
                            <li class="flex items-center text-sm">
                                <i class="fas fa-circle text-blue-500 mr-2 text-xs"></i>
                                <span>Rainwater harvesting integration</span>
                            </li>
                        </ul>
                    </div>

                    <div class="card-hover bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-pills text-3xl feature-icon"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Nutrient Management</h3>
                        <p class="text-gray-600 mb-4">
                            Optimize fertilizer usage with soil analysis and crop-specific nutrient recommendations.
                        </p>
                        <ul class="space-y-2">
                            <li class="flex items-center text-sm">
                                <i class="fas fa-circle text-yellow-500 mr-2 text-xs"></i>
                                <span>Soil testing integration</span>
                            </li>
                            <li class="flex items-center text-sm">
                                <i class="fas fa-circle text-yellow-500 mr-2 text-xs"></i>
                                <span>Fertilizer scheduling</span>
                            </li>
                            <li class="flex items-center text-sm">
                                <i class="fas fa-circle text-yellow-500 mr-2 text-xs"></i>
                                <span>Cost optimization</span>
                            </li>
                        </ul>
                    </div>

                    <div class="card-hover bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-bug text-3xl feature-icon"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Pest & Disease Control</h3>
                        <p class="text-gray-600 mb-4">
                            Early detection and treatment recommendations using AI image recognition.
                        </p>
                        <ul class="space-y-2">
                            <li class="flex items-center text-sm">
                                <i class="fas fa-circle text-purple-500 mr-2 text-xs"></i>
                                <span>AI pest detection</span>
                            </li>
                            <li class="flex items-center text-sm">
                                <i class="fas fa-circle text-purple-500 mr-2 text-xs"></i>
                                <span>Organic treatment options</span>
                            </li>
                            <li class="flex items-center text-sm">
                                <i class="fas fa-circle text-purple-500 mr-2 text-xs"></i>
                                <span>Preventive alerts</span>
                            </li>
                        </ul>
                    </div>

                    <div class="card-hover bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-chart-line text-3xl feature-icon"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Financial Management</h3>
                        <p class="text-gray-600 mb-4">
                            Track expenses, calculate ROI, and manage farm finances with comprehensive tools.
                        </p>
                        <ul class="space-y-2">
                            <li class="flex items-center text-sm">
                                <i class="fas fa-circle text-red-500 mr-2 text-xs"></i>
                                <span>Expense tracking</span>
                            </li>
                            <li class="flex items-center text-sm">
                                <i class="fas fa-circle text-red-500 mr-2 text-xs"></i>
                                <span>ROI calculator</span>
                            </li>
                            <li class="flex items-center text-sm">
                                <i class="fas fa-circle text-red-500 mr-2 text-xs"></i>
                                <span>Government scheme tracking</span>
                            </li>
                        </ul>
                    </div>

                    <div class="card-hover bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-warehouse text-3xl feature-icon"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Supply Chain Integration</h3>
                        <p class="text-gray-600 mb-4">
                            Connect with buyers, logistics, and storage facilities directly through the platform.
                        </p>
                        <ul class="space-y-2">
                            <li class="flex items-center text-sm">
                                <i class="fas fa-circle text-indigo-500 mr-2 text-xs"></i>
                                <span>Direct buyer connections</span>
                            </li>
                            <li class="flex items-center text-sm">
                                <i class="fas fa-circle text-indigo-500 mr-2 text-xs"></i>
                                <span>Logistics management</span>
                            </li>
                            <li class="flex items-center text-sm">
                                <i class="fas fa-circle text-indigo-500 mr-2 text-xs"></i>
                                <span>Storage availability</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Technology Stack -->
        <section class="py-20 bg-gray-900 text-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-4xl font-bold mb-6">Powered by Cutting-Edge Technology</h2>
                    <p class="text-xl text-gray-300">
                        Our platform integrates the latest agricultural and digital technologies
                    </p>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6 mb-12">
                    <div class="tech-badge p-6 rounded-xl text-center">
                        <i class="fas fa-satellite text-3xl text-green-400 mb-3"></i>
                        <p class="font-semibold">Satellite Imaging</p>
                    </div>
                    <div class="tech-badge p-6 rounded-xl text-center">
                        <i class="fas fa-microchip text-3xl text-blue-400 mb-3"></i>
                        <p class="font-semibold">IoT Sensors</p>
                    </div>
                    <div class="tech-badge p-6 rounded-xl text-center">
                        <i class="fas fa-robot text-3xl text-purple-400 mb-3"></i>
                        <p class="font-semibold">AI & Machine Learning</p>
                    </div>
                    <div class="tech-badge p-6 rounded-xl text-center">
                        <i class="fas fa-database text-3xl text-yellow-400 mb-3"></i>
                        <p class="font-semibold">Big Data Analytics</p>
                    </div>
                    <div class="tech-badge p-6 rounded-xl text-center">
                        <i class="fas fa-cloud text-3xl text-red-400 mb-3"></i>
                        <p class="font-semibold">Cloud Computing</p>
                    </div>
                    <div class="tech-badge p-6 rounded-xl text-center">
                        <i class="fas fa-mobile-alt text-3xl text-indigo-400 mb-3"></i>
                        <p class="font-semibold">Mobile Integration</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Success Stories -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Success Stories</h2>
                    <p class="text-xl text-gray-600">See how farmers transformed their operations</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-gray-50 p-8 rounded-2xl">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-user text-2xl text-green-600"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Rajesh Kumar</h4>
                                <p class="text-green-600">Wheat Farmer, Punjab</p>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-6">
                            "Using GreenAgro's digital platform, I increased my wheat yield by 35% while reducing water usage by 40%. The real-time alerts saved my crop from pest attacks twice!"
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-green-700">+35% Yield</span>
                            <span class="font-bold text-blue-700">-40% Water</span>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 p-8 rounded-2xl">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-user text-2xl text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Priya Sharma</h4>
                                <p class="text-green-600">Organic Vegetable Farm, Maharashtra</p>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-6">
                            "The crop planning feature helped me optimize my planting schedule. I now supply to premium organic stores directly through the platform's marketplace."
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-green-700">2x Revenue</span>
                            <span class="font-bold text-purple-700">Direct Market Access</span>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 p-8 rounded-2xl">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-user text-2xl text-purple-600"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Farmers Collective</h4>
                                <p class="text-green-600">Cooperative, Karnataka</p>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-6">
                            "As a 500-member cooperative, GreenAgro helped us coordinate planting, share resources, and negotiate better prices collectively. A game-changer!"
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-green-700">500+ Members</span>
                            <span class="font-bold text-yellow-700">25% Better Prices</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 gradient-bg">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">
                        Ready to Transform Your Farming?
                    </h2>
                    <p class="text-xl text-gray-600 mb-8">
                        Join 10,000+ farmers who have already digitized their operations with GreenAgro.
                    </p>
                    
                    <div class="bg-white rounded-2xl p-8 shadow-2xl mb-8">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="text-center">
                                <div class="text-5xl font-bold text-green-600 mb-2">30</div>
                                <p class="text-gray-700 font-semibold">Days Free Trial</p>
                            </div>
                            <div class="text-center">
                                <div class="text-5xl font-bold text-green-600 mb-2">₹0</div>
                                <p class="text-gray-700 font-semibold">Setup Cost</p>
                            </div>
                            <div class="text-center">
                                <div class="text-5xl font-bold text-green-600 mb-2">24/7</div>
                                <p class="text-gray-700 font-semibold">Expert Support</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="<?php echo $base_url; ?>Components/register.php" 
                           class="bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-12 rounded-xl text-lg transition duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-rocket mr-2"></i>Start Your Free Trial
                        </a>
                        <a href="<?php echo $base_url; ?>Includes/support.php" 
                           class="bg-white hover:bg-gray-50 text-green-600 border-2 border-green-600 font-bold py-4 px-12 rounded-xl text-lg transition duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-calendar mr-2"></i>Book a Demo
                        </a>
                    </div>
                    
                    <p class="text-gray-500 mt-6">
                        No credit card required. Get started in 5 minutes.
                    </p>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto">
                    <h2 class="text-4xl font-bold text-center text-gray-900 mb-12">Frequently Asked Questions</h2>
                    
                    <div class="space-y-6">
                        <div class="border border-gray-200 rounded-2xl p-6">
                            <div class="flex justify-between items-center cursor-pointer" onclick="toggleFAQ(1)">
                                <h3 class="text-lg font-semibold text-gray-900">Is this platform suitable for small farmers?</h3>
                                <i class="fas fa-chevron-down text-green-600"></i>
                            </div>
                            <div id="faq-1" class="hidden mt-4">
                                <p class="text-gray-600">Absolutely! Our platform scales from small family farms to large agricultural enterprises. We offer tiered pricing starting from free basic plans.</p>
                            </div>
                        </div>
                        
                        <div class="border border-gray-200 rounded-2xl p-6">
                            <div class="flex justify-between items-center cursor-pointer" onclick="toggleFAQ(2)">
                                <h3 class="text-lg font-semibold text-gray-900">What internet speed do I need?</h3>
                                <i class="fas fa-chevron-down text-green-600"></i>
                            </div>
                            <div id="faq-2" class="hidden mt-4">
                                <p class="text-gray-600">The platform works with basic 2G connections. We also offer offline mode for data collection with automatic sync when internet is available.</p>
                            </div>
                        </div>
                        
                        <div class="border border-gray-200 rounded-2xl p-6">
                            <div class="flex justify-between items-center cursor-pointer" onclick="toggleFAQ(3)">
                                <h3 class="text-lg font-semibold text-gray-900">Is technical knowledge required?</h3>
                                <i class="fas fa-chevron-down text-green-600"></i>
                            </div>
                            <div id="faq-3" class="hidden mt-4">
                                <p class="text-gray-600">No technical knowledge required. Our interface is designed for farmers with step-by-step guides and video tutorials. We also provide local language support.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include '../Components/footer.php'; ?>

    <script>
        // Tab functionality
        document.querySelectorAll('.tab-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('.tab-btn').forEach(btn => {
                    btn.classList.remove('tab-active');
                    btn.classList.add('bg-gray-100', 'hover:bg-gray-200');
                });
                
                // Add active class to clicked button
                this.classList.add('tab-active');
                this.classList.remove('bg-gray-100', 'hover:bg-gray-200');
                
                // Hide all panels
                document.querySelectorAll('.tab-panel').forEach(panel => {
                    panel.classList.add('hidden');
                    panel.classList.remove('active');
                });
                
                // Show corresponding panel
                const tabId = this.getAttribute('data-tab');
                document.getElementById(`${tabId}-panel`).classList.remove('hidden');
                document.getElementById(`${tabId}-panel`).classList.add('active');
            });
        });

        // FAQ toggle
        function toggleFAQ(id) {
            const faq = document.getElementById(`faq-${id}`);
            const icon = faq.previousElementSibling.querySelector('i');
            
            faq.classList.toggle('hidden');
            icon.classList.toggle('fa-chevron-down');
            icon.classList.toggle('fa-chevron-up');
        }

        // Animate progress bars on scroll
        function animateProgressBars() {
            const progressBars = document.querySelectorAll('.animated-progress');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0';
                setTimeout(() => {
                    bar.style.width = width;
                }, 300);
            });
        }

        // Initialize progress bars animation
        window.addEventListener('load', animateProgressBars);
    </script>
</body>
</html>