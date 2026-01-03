<?php
require_once './../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Solutions - <?php echo SITE_NAME; ?> - <?php echo SITE_TAGLINE; ?></title>
    
    <!-- CSS & Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 50%, #bbf7d0 100%);
        }
        .solution-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }
        .solution-card:hover {
            transform: translateY(-10px);
            border-color: #10b981;
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.1);
        }
        .solution-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(to bottom, #10b981, #059669);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .solution-card:hover::before {
            opacity: 1;
        }
        .feature-icon {
            background: linear-gradient(135deg, #10b981, #059669);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .tab-active {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }
        .benefit-badge {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            transition: all 0.3s ease;
        }
        .benefit-badge:hover {
            background: rgba(16, 185, 129, 0.2);
            transform: translateY(-3px);
        }
        .tech-integration {
            background: linear-gradient(145deg, #f8fafc, #f1f5f9);
            position: relative;
            overflow: hidden;
        }
        .tech-integration::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #10b981, #3b82f6, #8b5cf6);
        }
        .animated-progress {
            animation: progress 1.5s ease-in-out;
        }
        @keyframes progress {
            from { width: 0; }
        }
        .solution-banner {
            background: linear-gradient(rgba(16, 185, 129, 0.9), rgba(5, 150, 105, 0.9)), url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .stat-card {
            background: white;
            border-left: 4px solid #10b981;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }
        .stat-card:hover::before {
            transform: translateX(100%);
        }
        .solution-category {
            position: relative;
            overflow: hidden;
        }
        .solution-category::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #10b981, #059669);
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        .solution-category:hover::after {
            transform: translateX(0);
        }
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .counter {
            font-weight: bold;
            display: inline-block;
        }
        .portal-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 3px solid transparent;
            position: relative;
            overflow: hidden;
        }
        .portal-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #10b981, #3b82f6, #8b5cf6);
        }
        .portal-card:hover {
            transform: translateY(-10px) scale(1.02);
            border-color: #10b981;
            box-shadow: 0 25px 50px rgba(16, 185, 129, 0.2);
        }
        .portal-icon {
            transition: all 0.3s ease;
        }
        .portal-card:hover .portal-icon {
            transform: scale(1.2) rotate(5deg);
        }
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
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
        <section class="solution-banner py-20 text-white">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center">
                    <div class="inline-flex items-center bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-6">
                        <span class="w-2 h-2 bg-green-300 rounded-full mr-2 animate-pulse"></span>
                        <span class="text-sm font-semibold">Comprehensive Agricultural Solutions</span>
                    </div>
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                        Transform Your Farming with Smart Solutions
                    </h1>
                    <p class="text-xl mb-8 opacity-90 leading-relaxed">
                        Discover our complete suite of agricultural solutions designed to increase productivity, 
                        reduce costs, and ensure sustainable farming practices for every type of farmer.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="#solutions" 
                           class="bg-white text-green-600 hover:bg-green-50 font-bold py-4 px-8 rounded-xl text-lg transition duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-search mr-2"></i>Explore Solutions
                        </a>
                        <a href="<?php echo $base_url; ?>Components/register.php" 
                           class="bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-8 rounded-xl text-lg transition duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-rocket mr-2"></i>Get Started
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Solutions Overview -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">
                        Comprehensive Agricultural Solutions
                    </h2>
                    <p class="text-xl text-gray-600">
                        From precision farming to market access, we provide end-to-end solutions for modern agriculture
                    </p>
                </div>

                <!-- Solution Categories -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                    <a href="#farm-management" class="solution-category group">
                        <div class="bg-green-50 p-8 rounded-2xl text-center hover:bg-green-100 transition duration-300">
                            <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-sm group-hover:shadow-md transition duration-300">
                                <i class="fas fa-tractor text-3xl feature-icon"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Farm Management</h3>
                            <p class="text-gray-600">Complete farm operations and resource management</p>
                        </div>
                    </a>

                    <a href="#crop-solutions" class="solution-category group">
                        <div class="bg-blue-50 p-8 rounded-2xl text-center hover:bg-blue-100 transition duration-300">
                            <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-sm group-hover:shadow-md transition duration-300">
                                <i class="fas fa-seedling text-3xl feature-icon"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Crop Solutions</h3>
                            <p class="text-gray-600">Advanced crop care and optimization tools</p>
                        </div>
                    </a>

                    <a href="#technology" class="solution-category group">
                        <div class="bg-purple-50 p-8 rounded-2xl text-center hover:bg-purple-100 transition duration-300">
                            <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-sm group-hover:shadow-md transition duration-300">
                                <i class="fas fa-microchip text-3xl feature-icon"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Technology Solutions</h3>
                            <p class="text-gray-600">Cutting-edge agricultural technology</p>
                        </div>
                    </a>

                    <a href="#market-access" class="solution-category group">
                        <div class="bg-yellow-50 p-8 rounded-2xl text-center hover:bg-yellow-100 transition duration-300">
                            <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-sm group-hover:shadow-md transition duration-300">
                                <i class="fas fa-shopping-cart text-3xl feature-icon"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Market Access</h3>
                            <p class="text-gray-600">Direct market connections and pricing</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <!-- Farm Management Solutions -->
        <section id="farm-management" class="py-20 gradient-bg">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">
                        Farm Management Solutions
                    </h2>
                    <p class="text-xl text-gray-600">
                        Comprehensive tools to manage every aspect of your farm efficiently
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Digital Farm Records -->
                    <div class="solution-card bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-clipboard-list text-3xl feature-icon"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Digital Farm Records</h3>
                        <p class="text-gray-600 mb-4">
                            Complete digital documentation of farm activities, expenses, and yields with automated reporting.
                        </p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-center text-sm">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Automated expense tracking</span>
                            </li>
                            <li class="flex items-center text-sm">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Yield recording and analysis</span>
                            </li>
                            <li class="flex items-center text-sm">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Government compliance reports</span>
                            </li>
                        </ul>
                        <div class="flex items-center justify-between">
                            <span class="text-green-600 font-semibold">Starting at ₹999/month</span>
                            <a href="#" class="text-green-600 hover:text-green-700 font-medium">
                                Learn More <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Labor Management -->
                    <div class="solution-card bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-users text-3xl feature-icon"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Labor Management</h3>
                        <p class="text-gray-600 mb-4">
                            Efficient workforce management with attendance tracking, task allocation, and payroll integration.
                        </p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-center text-sm">
                                <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                                <span>Attendance tracking</span>
                            </li>
                            <li class="flex items-center text-sm">
                                <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                                <span>Task scheduling</span>
                            </li>
                            <li class="flex items-center text-sm">
                                <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                                <span>Automated payroll</span>
                            </li>
                        </ul>
                        <div class="flex items-center justify-between">
                            <span class="text-green-600 font-semibold">Starting at ₹1,499/month</span>
                            <a href="#" class="text-green-600 hover:text-green-700 font-medium">
                                Learn More <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Equipment Management -->
                    <div class="solution-card bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-tools text-3xl feature-icon"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Equipment Management</h3>
                        <p class="text-gray-600 mb-4">
                            Track maintenance schedules, fuel consumption, and optimize equipment utilization.
                        </p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-center text-sm">
                                <i class="fas fa-check-circle text-yellow-500 mr-2"></i>
                                <span>Maintenance scheduling</span>
                            </li>
                            <li class="flex items-center text-sm">
                                <i class="fas fa-check-circle text-yellow-500 mr-2"></i>
                                <span>Fuel tracking</span>
                            </li>
                            <li class="flex items-center text-sm">
                                <i class="fas fa-check-circle text-yellow-500 mr-2"></i>
                                <span>Equipment sharing platform</span>
                            </li>
                        </ul>
                        <div class="flex items-center justify-between">
                            <span class="text-green-600 font-semibold">Starting at ₹1,999/month</span>
                            <a href="#" class="text-green-600 hover:text-green-700 font-medium">
                                Learn More <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Crop Solutions -->
        <section id="crop-solutions" class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">
                        Crop Solutions
                    </h2>
                    <p class="text-xl text-gray-600">
                        Advanced solutions for crop health, yield optimization, and sustainable practices
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                    <!-- Precision Irrigation -->
                    <div class="solution-card bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-tint text-3xl feature-icon"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Precision Irrigation</h3>
                        <p class="text-gray-600 mb-4">
                            Smart irrigation systems that optimize water usage based on soil moisture and weather data.
                        </p>
                        <div class="flex items-center mb-4">
                            <div class="flex-1">
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm text-gray-600">Water Savings</span>
                                    <span class="text-sm font-bold text-blue-600">Up to 40%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full animated-progress" style="width: 85%"></div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="inline-flex items-center text-green-600 font-semibold hover:text-green-700">
                            View Case Studies <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>

                    <!-- Crop Health Monitoring -->
                    <div class="solution-card bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-heartbeat text-3xl feature-icon"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Crop Health Monitoring</h3>
                        <p class="text-gray-600 mb-4">
                            AI-powered disease detection and nutrient deficiency analysis through drone imaging.
                        </p>
                        <div class="flex items-center mb-4">
                            <div class="flex-1">
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm text-gray-600">Early Detection</span>
                                    <span class="text-sm font-bold text-green-600">Up to 7 days</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full animated-progress" style="width: 90%"></div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="inline-flex items-center text-green-600 font-semibold hover:text-green-700">
                            View Case Studies <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>

                    <!-- Organic Farming Package -->
                    <div class="solution-card bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-leaf text-3xl feature-icon"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Organic Farming Package</h3>
                        <p class="text-gray-600 mb-4">
                            Complete solution for certified organic farming with bio-inputs and certification support.
                        </p>
                        <div class="flex items-center mb-4">
                            <div class="flex-1">
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm text-gray-600">Premium Price</span>
                                    <span class="text-sm font-bold text-purple-600">Up to 30% Higher</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-purple-500 h-2 rounded-full animated-progress" style="width: 75%"></div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="inline-flex items-center text-green-600 font-semibold hover:text-green-700">
                            View Case Studies <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Additional Crop Solutions -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-green-50 p-8 rounded-2xl">
                        <div class="flex items-start mb-6">
                            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-cloud-sun text-2xl text-green-600"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Weather Advisory Service</h3>
                                <p class="text-gray-600">Hyper-local weather forecasts and farming advisories.</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span class="text-gray-700">7-day accurate forecasts</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span class="text-gray-700">Frost and heatwave alerts</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span class="text-gray-700">Rainfall probability</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-50 p-8 rounded-2xl">
                        <div class="flex items-start mb-6">
                            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-vial text-2xl text-blue-600"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Soil Testing Services</h3>
                                <p class="text-gray-600">Professional soil analysis and nutrient recommendations.</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-check text-blue-500 mr-2"></i>
                                <span class="text-gray-700">Macro & micronutrient analysis</span>
                            </li>
                            <div class="flex items-center">
                                <i class="fas fa-check text-blue-500 mr-2"></i>
                                <span class="text-gray-700">pH and salinity testing</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check text-blue-500 mr-2"></i>
                                <span class="text-gray-700">Fertilizer recommendation</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Technology Solutions -->
        <section id="technology" class="py-20 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">
                        Technology Solutions
                    </h2>
                    <p class="text-xl text-gray-600">
                        Cutting-edge technology to revolutionize your farming operations
                    </p>
                </div>

                <div class="tech-integration p-8 rounded-2xl mb-12">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div>
                            <h3 class="text-3xl font-bold text-gray-900 mb-6">IoT Sensor Networks</h3>
                            <p class="text-gray-600 mb-6 text-lg">
                                Real-time monitoring of soil conditions, weather parameters, and crop health with 
                                our advanced IoT sensor networks.
                            </p>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="benefit-badge p-4 rounded-xl text-center">
                                    <i class="fas fa-thermometer-half text-2xl text-green-600 mb-2"></i>
                                    <p class="font-semibold">Soil Sensors</p>
                                </div>
                                <div class="benefit-badge p-4 rounded-xl text-center">
                                    <i class="fas fa-wind text-2xl text-blue-600 mb-2"></i>
                                    <p class="font-semibold">Weather Stations</p>
                                </div>
                                <div class="benefit-badge p-4 rounded-xl text-center">
                                    <i class="fas fa-camera text-2xl text-purple-600 mb-2"></i>
                                    <p class="font-semibold">Crop Imaging</p>
                                </div>
                                <div class="benefit-badge p-4 rounded-xl text-center">
                                    <i class="fas fa-satellite-dish text-2xl text-yellow-600 mb-2"></i>
                                    <p class="font-semibold">Satellite Data</p>
                                </div>
                            </div>
                        </div>
                        <div class="relative">
                            <div class="bg-white p-8 rounded-xl shadow-lg">
                                <div class="flex justify-between items-center mb-6">
                                    <h4 class="font-bold text-gray-800">Live Sensor Data</h4>
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">Live</span>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span class="text-gray-700">Field 1 - Soil Moisture</span>
                                            <span class="font-bold text-blue-700">68%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-blue-500 h-2 rounded-full" style="width: 68%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span class="text-gray-700">Field 2 - Temperature</span>
                                            <span class="font-bold text-red-700">32°C</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-red-500 h-2 rounded-full" style="width: 80%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span class="text-gray-700">Field 3 - Humidity</span>
                                            <span class="font-bold text-green-700">75%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-green-500 h-2 rounded-full" style="width: 75%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- AI Solutions -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white p-8 rounded-2xl shadow-lg">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mr-4">
                                <i class="fas fa-robot text-3xl feature-icon"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">AI-Powered Analytics</h3>
                                <p class="text-green-600">Predictive insights for better decisions</p>
                            </div>
                        </div>
                        <ul class="space-y-3">
                            <li class="flex items-center">
                                <i class="fas fa-brain text-purple-500 mr-3"></i>
                                <span class="text-gray-700">Yield prediction models</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-chart-line text-purple-500 mr-3"></i>
                                <span class="text-gray-700">Market trend analysis</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-bug text-purple-500 mr-3"></i>
                                <span class="text-gray-700">Pest outbreak forecasting</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-lg">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mr-4">
                                <i class="fas fa-mobile-alt text-3xl feature-icon"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Mobile Farm Management</h3>
                                <p class="text-green-600">Manage your farm from anywhere</p>
                            </div>
                        </div>
                        <ul class="space-y-3">
                            <li class="flex items-center">
                                <i class="fas fa-map-marker-alt text-blue-500 mr-3"></i>
                                <span class="text-gray-700">Field mapping and navigation</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-bell text-blue-500 mr-3"></i>
                                <span class="text-gray-700">Real-time alerts and notifications</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-language text-blue-500 mr-3"></i>
                                <span class="text-gray-700">Multi-language support</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Market Access Solutions -->
        <section id="market-access" class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">
                        Market Access Solutions
                    </h2>
                    <p class="text-xl text-gray-600">
                        Connect directly with buyers and optimize your sales strategy
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                    <!-- Direct Market Connect -->
                    <div class="solution-card bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-handshake text-3xl feature-icon"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Direct Market Connect</h3>
                        <p class="text-gray-600 mb-4">
                            Connect directly with bulk buyers, processors, and exporters without middlemen.
                        </p>
                        <div class="space-y-2 mb-6">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-700">Average Price Increase</span>
                                <span class="font-bold text-green-600">15-25%</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-700">Verified Buyers</span>
                                <span class="font-bold text-blue-600">500+</span>
                            </div>
                        </div>
                        <a href="#" class="inline-flex items-center text-green-600 font-semibold hover:text-green-700">
                            Explore Buyers <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>

                    <!-- Price Discovery Platform -->
                    <div class="solution-card bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-chart-line text-3xl feature-icon"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Price Discovery Platform</h3>
                        <p class="text-gray-600 mb-4">
                            Real-time commodity prices across major mandis and market trends analysis.
                        </p>
                        <div class="space-y-2 mb-6">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-700">Markets Covered</span>
                                <span class="font-bold text-green-600">1000+</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-700">Price Updates</span>
                                <span class="font-bold text-blue-600">Every 15 mins</span>
                            </div>
                        </div>
                        <a href="#" class="inline-flex items-center text-green-600 font-semibold hover:text-green-700">
                            View Prices <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>

                    <!-- Logistics & Storage -->
                    <div class="solution-card bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-truck text-3xl feature-icon"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Logistics & Storage</h3>
                        <p class="text-gray-600 mb-4">
                            Integrated logistics solutions and cold storage availability for perishable goods.
                        </p>
                        <div class="space-y-2 mb-6">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-700">Transport Partners</span>
                                <span class="font-bold text-green-600">200+</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-700">Cold Storage Facilities</span>
                                <span class="font-bold text-blue-600">50+</span>
                            </div>
                        </div>
                        <a href="#" class="inline-flex items-center text-green-600 font-semibold hover:text-green-700">
                            Book Services <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Three Portals Section -->
        <section class="py-20 bg-gradient-to-br from-green-50 to-blue-50">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">
                        Our Integrated Ecosystem
                    </h2>
                    <p class="text-xl text-gray-600">
                        Three specialized portals working together for seamless agricultural operations
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Farmer Portal -->
                    <div class="portal-card bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-20 h-20 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-6 floating">
                            <i class="fas fa-user-tie text-4xl text-green-600 portal-icon"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Farmer Portal</h3>
                        <p class="text-gray-600 mb-6 text-center">
                            Complete farm management tools for individual farmers and farming communities
                        </p>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span class="text-gray-700">Crop planning & management</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span class="text-gray-700">Real-time farm monitoring</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span class="text-gray-700">Marketplace access</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span class="text-gray-700">Financial tracking</span>
                            </li>
                        </ul>
                        <div class="text-center">
                            <span class="inline-block px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                                15,000+ Active Farmers
                            </span>
                        </div>
                    </div>

                    <!-- Distributor Portal -->
                    <div class="portal-card bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-20 h-20 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6 floating" style="animation-delay: 0.5s">
                            <i class="fas fa-truck-loading text-4xl text-blue-600 portal-icon"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Distributor Portal</h3>
                        <p class="text-gray-600 mb-6 text-center">
                            Supply chain management and distribution network optimization
                        </p>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-blue-500 mr-3"></i>
                                <span class="text-gray-700">Inventory management</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-blue-500 mr-3"></i>
                                <span class="text-gray-700">Order processing system</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-blue-500 mr-3"></i>
                                <span class="text-gray-700">Logistics tracking</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-blue-500 mr-3"></i>
                                <span class="text-gray-700">Farmer connectivity</span>
                            </li>
                        </ul>
                        <div class="text-center">
                            <span class="inline-block px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">
                                500+ Distributors
                            </span>
                        </div>
                    </div>

                    <!-- Admin Portal -->
                    <div class="portal-card bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-20 h-20 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-6 floating" style="animation-delay: 1s">
                            <i class="fas fa-cogs text-4xl text-purple-600 portal-icon"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Admin Portal</h3>
                        <p class="text-gray-600 mb-6 text-center">
                            Complete platform management and analytics for system administrators
                        </p>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-purple-500 mr-3"></i>
                                <span class="text-gray-700">User management</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-purple-500 mr-3"></i>
                                <span class="text-gray-700">Platform analytics</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-purple-500 mr-3"></i>
                                <span class="text-gray-700">Transaction monitoring</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-purple-500 mr-3"></i>
                                <span class="text-gray-700">System configuration</span>
                            </li>
                        </ul>
                        <div class="text-center">
                            <span class="inline-block px-4 py-2 bg-purple-100 text-purple-700 rounded-full text-sm font-semibold">
                                24/7 Monitoring
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-16 bg-gradient-to-r from-green-600 to-emerald-600 text-white">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div class="stat-card p-8 rounded-2xl">
                        <div class="flex items-center justify-center mb-4">
                            <i class="fas fa-users text-3xl mr-3" style="color: #16a34a;"></i>
                        </div>
                        <div class="text-5xl font-bold mb-2 counter" data-target="25000" style="color: #16a34aa3;">0</div>
                        <div class="text-green-100 text-lg font-medium" style="color: #16a34a;">Farmers Using Solutions</div>
                        <div class="w-full bg-green-700 rounded-full h-2 mt-4">
                            <div class="bg-green-300 h-2 rounded-full" style="width: 95%"></div>
                        </div>
                    </div>
                    
                    <div class="stat-card p-8 rounded-2xl">
                        <div class="flex items-center justify-center mb-4">
                            <i class="fas fa-chart-line text-3xl mr-3" style="color: #16a34a;"></i>
                        </div>
                        <div class="text-5xl font-bold mb-2 counter" data-target="40" style="color: #16a34aa3;">0</div>
                        <div class="text-green-100 text-lg font-medium" style="color: #16a34a;">Average Yield Increase</div>
                        <div class="w-full bg-green-700 rounded-full h-2 mt-4">
                            <div class="bg-green-300 h-2 rounded-full" style="width: 80%"></div>
                        </div>
                    </div>
                    
                    <div class="stat-card p-8 rounded-2xl">
                        <div class="flex items-center justify-center mb-4">
                            <i class="fas fa-money-bill-wave text-3xl mr-3" style="color: #16a34a;"></i>
                        </div>
                        <div class="text-5xl font-bold mb-2 counter" data-target="30" style="color: #16a34aa3;">0</div>
                        <div class="text-green-100 text-lg font-medium" style="color: #16a34a;">Cost Reduction</div>
                        <div class="w-full bg-green-700 rounded-full h-2 mt-4">
                            <div class="bg-green-300 h-2 rounded-full" style="width: 60%"></div>
                        </div>
                    </div>
                    
                    <div class="stat-card p-8 rounded-2xl">
                        <div class="flex items-center justify-center mb-4">
                            <i class="fas fa-heart text-3xl mr-3" style="color: #16a34a;"></i>
                        </div>
                        <div class="text-5xl font-bold mb-2 counter" data-target="98" style="color: #16a34aa3;">0</div>
                        <div class="text-green-100 text-lg font-medium" style="color: #16a34a;">Customer Satisfaction</div>
                        <div class="w-full bg-green-700 rounded-full h-2 mt-4">
                            <div class="bg-green-300 h-2 rounded-full" style="width: 98%"></div>
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
                        Choose the right solution for your farm. Our experts will help you implement the perfect combination.
                    </p>
                    
                    <div class="bg-white rounded-2xl p-8 shadow-2xl mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Solution Selection Guide</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="text-left">
                                <h4 class="font-bold text-green-700 mb-3">For Small Farmers (Under 5 acres)</h4>
                                <ul class="space-y-2">
                                    <li class="flex items-center">
                                        <i class="fas fa-check text-green-500 mr-2"></i>
                                        <span>Basic Farm Records</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-check text-green-500 mr-2"></i>
                                        <span>Weather Advisory</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-check text-green-500 mr-2"></i>
                                        <span>Market Price Updates</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="text-left">
                                <h4 class="font-bold text-green-700 mb-3">For Large Farms (20+ acres)</h4>
                                <ul class="space-y-2">
                                    <li class="flex items-center">
                                        <i class="fas fa-check text-green-500 mr-2"></i>
                                        <span>Full IoT Integration</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-check text-green-500 mr-2"></i>
                                        <span>Precision Agriculture</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-check text-green-500 mr-2"></i>
                                        <span>Supply Chain Management</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="<?php echo $base_url; ?>Components/register.php" 
                           class="bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-12 rounded-xl text-lg transition duration-300 shadow-lg hover:shadow-xl pulse-animation">
                            <i class="fas fa-calendar-check mr-2"></i>Book Free Consultation
                        </a>
                        <a href="<?php echo $base_url; ?>Includes/support.php" 
                           class="bg-white hover:bg-gray-50 text-green-600 border-2 border-green-600 font-bold py-4 px-12 rounded-xl text-lg transition duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-question-circle mr-2"></i>Need Help Choosing?
                        </a>
                    </div>
                    
                    <p class="text-gray-500 mt-6">
                        Free 30-minute consultation with our agricultural experts
                    </p>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto">
                    <h2 class="text-4xl font-bold text-center text-gray-900 mb-12">Solution FAQs</h2>
                    
                    <div class="space-y-6">
                        <div class="border border-gray-200 rounded-2xl p-6">
                            <div class="flex justify-between items-center cursor-pointer" onclick="toggleFAQ(1)">
                                <h3 class="text-lg font-semibold text-gray-900">Can I start with basic solutions and upgrade later?</h3>
                                <i class="fas fa-chevron-down text-green-600"></i>
                            </div>
                            <div id="faq-1" class="hidden mt-4">
                                <p class="text-gray-600">Absolutely! Our modular approach allows you to start with basic solutions and add advanced features as your farm grows. All data seamlessly transfers between plans.</p>
                            </div>
                        </div>
                        
                        <div class="border border-gray-200 rounded-2xl p-6">
                            <div class="flex justify-between items-center cursor-pointer" onclick="toggleFAQ(2)">
                                <h3 class="text-lg font-semibold text-gray-900">Do you provide installation and training?</h3>
                                <i class="fas fa-chevron-down text-green-600"></i>
                            </div>
                            <div id="faq-2" class="hidden mt-4">
                                <p class="text-gray-600">Yes, we provide complete installation support for hardware solutions and comprehensive training for software platforms. We also offer ongoing support through our network of local agri-tech partners.</p>
                            </div>
                        </div>
                        
                        <div class="border border-gray-200 rounded-2xl p-6">
                            <div class="flex justify-between items-center cursor-pointer" onclick="toggleFAQ(3)">
                                <h3 class="text-lg font-semibold text-gray-900">Are there government subsidies available?</h3>
                                <i class="fas fa-chevron-down text-green-600"></i>
                            </div>
                            <div id="faq-3" class="hidden mt-4">
                                <p class="text-gray-600">We help farmers avail various government subsidies and schemes for agricultural technology adoption. Our team assists with documentation and application processes for eligible programs.</p>
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
        // FAQ toggle
        function toggleFAQ(id) {
            const faq = document.getElementById(`faq-${id}`);
            const icon = faq.previousElementSibling.querySelector('i');
            
            faq.classList.toggle('hidden');
            icon.classList.toggle('fa-chevron-down');
            icon.classList.toggle('fa-chevron-up');
        }

        // Smooth scroll for solution categories
        document.querySelectorAll('.solution-category').forEach(category => {
            category.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Animate progress bars when in view
        function animateProgressBars() {
            const progressBars = document.querySelectorAll('.animated-progress');
            progressBars.forEach(bar => {
                const rect = bar.getBoundingClientRect();
                if (rect.top < window.innerHeight - 100) {
                    const width = bar.style.width;
                    bar.style.width = '0';
                    setTimeout(() => {
                        bar.style.width = width;
                    }, 300);
                }
            });
        }

        // Animated Counter for Stats
        function animateCounter() {
            const counters = document.querySelectorAll('.counter');
            const speed = 200; // The lower the slower
            
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / speed;
                
                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(() => animateCounter(), 1);
                } else {
                    counter.innerText = target;
                }
            });
        }

        // Initialize counters when in view
        function initCounters() {
            const statsSection = document.querySelector('.bg-gradient-to-r.from-green-600.to-emerald-600');
            const rect = statsSection.getBoundingClientRect();
            
            if (rect.top < window.innerHeight - 100) {
                animateCounter();
                window.removeEventListener('scroll', initCounters);
            }
        }

        // Initialize animations
        window.addEventListener('load', () => {
            animateProgressBars();
            window.addEventListener('scroll', initCounters);
            initCounters(); // Check on load
        });
        
        window.addEventListener('scroll', animateProgressBars);
    </script>
</body>
</html>