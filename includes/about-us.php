<?php
require_once './../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - <?php echo SITE_NAME; ?> - <?php echo SITE_TAGLINE; ?></title>
    
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
        
        .hero-gradient {
            background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
        }
        
        .stats-gradient {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        }
        
        .mission-section {
            background: linear-gradient(rgba(16, 185, 129, 0.05), rgba(5, 150, 105, 0.05));
        }
        
        .team-card {
            transition: all 0.4s ease;
            border: 2px solid transparent;
        }
        
        .team-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary-green);
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.15);
        }
        
        .team-img {
            width: 150px;
            height: 150px;
            border: 5px solid white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
        }
        
        .team-card:hover .team-img {
            transform: scale(1.05);
            border-color: var(--primary-green);
        }
        
        .value-card {
            transition: all 0.3s ease;
            background: white;
            border-left: 4px solid transparent;
        }
        
        .value-card:hover {
            transform: translateX(10px);
            border-left-color: var(--primary-green);
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.1);
        }
        
        .timeline-item {
            position: relative;
            padding-left: 40px;
            margin-bottom: 40px;
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--primary-green);
            border: 4px solid white;
            box-shadow: 0 0 0 3px var(--light-green);
        }
        
        .timeline-item::after {
            content: '';
            position: absolute;
            left: 9px;
            top: 20px;
            width: 2px;
            height: calc(100% + 20px);
            background: var(--light-green);
        }
        
        .timeline-item:last-child::after {
            display: none;
        }
        
        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
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
        
        .impact-card {
            transition: all 0.4s ease;
            overflow: hidden;
            position: relative;
        }
        
        .impact-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-green), var(--dark-green));
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }
        
        .impact-card:hover::before {
            transform: translateX(0);
        }
        
        .impact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.1);
        }
        
        .farmers-image {
            background: linear-gradient(rgba(16, 185, 129, 0.8), rgba(5, 150, 105, 0.8)), 
                        url('https://images.unsplash.com/photo-1625246333195-78d9c38ad449?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .floating {
            animation: floating 6s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .feature-icon-bg {
            background: linear-gradient(135deg, var(--light-green), white);
            border: 2px solid var(--light-green);
        }
        
        .feature-icon-bg:hover {
            background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
        }
        
        .feature-icon-bg:hover i {
            color: white !important;
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
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div>
                            <div class="inline-flex items-center bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-8">
                                <i class="fas fa-seedling mr-2"></i>
                                <span class="font-semibold">Empowering Farmers Since 2020</span>
                            </div>
                            <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                                Growing Together With <span class="text-yellow-300">Indian Farmers</span>
                            </h1>
                            <p class="text-xl mb-8 opacity-90">
                                <?php echo SITE_NAME; ?> is a mission-driven platform dedicated to transforming agriculture 
                                through technology, making every farmer's life easier and more profitable.
                            </p>
                            <div class="flex flex-wrap gap-4">
                                <a href="#our-story" 
                                   class="bg-white text-green-700 hover:bg-gray-100 font-bold py-3 px-6 rounded-xl transition duration-300">
                                    <i class="fas fa-book-open mr-2"></i>Our Story
                                </a>
                                <a href="#our-mission" 
                                   class="bg-transparent border-2 border-white hover:bg-white/20 font-bold py-3 px-6 rounded-xl transition duration-300">
                                    <i class="fas fa-bullseye mr-2"></i>Our Mission
                                </a>
                            </div>
                        </div>
                        <div class="relative">
                            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                                <div class="text-center">
                                    <div class="inline-flex items-center justify-center w-32 h-32 rounded-full bg-white/10 mb-6 floating">
                                        <i class="fas fa-tractor text-5xl text-white"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold mb-4">Our Impact in Numbers</h3>
                                    <div class="grid grid-cols-2 gap-6">
                                        <div class="text-center">
                                            <div class="text-4xl font-bold mb-2">50K+</div>
                                            <p class="opacity-90">Farmers Empowered</p>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-4xl font-bold mb-2">25+</div>
                                            <p class="opacity-90">Features</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Floating Elements -->
                            <div class="absolute -top-6 -right-6 bg-yellow-400 text-gray-900 p-4 rounded-xl shadow-lg floating">
                                <i class="fas fa-award text-3xl"></i>
                            </div>
                            <div class="absolute -bottom-6 -left-6 bg-white text-green-600 p-4 rounded-xl shadow-lg floating" style="animation-delay: 2s">
                                <i class="fas fa-hands-helping text-3xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Story -->
        <section id="our-story" class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl font-bold text-gray-900 mb-6 section-title">
                            Our Journey
                        </h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            From a simple idea to a nationwide movement empowering farmers across India
                        </p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div>
                            <h3 class="text-3xl font-bold text-gray-900 mb-6">
                                The Beginning of a Revolution
                            </h3>
                            <p class="text-gray-600 mb-6 text-lg leading-relaxed">
                                <?php echo SITE_NAME; ?> was born in 2020 when our founder, Rohan Sharma, visited his ancestral village 
                                in rural Punjab. He witnessed firsthand the challenges farmers faced: language barriers, 
                                lack of access to real-time market prices, and unpredictable weather affecting their crops.
                            </p>
                            <p class="text-gray-600 mb-6 text-lg leading-relaxed">
                                What started as a simple app to translate agricultural information into regional languages 
                                has grown into a comprehensive platform serving thousands of farmers across India.
                            </p>
                            <div class="bg-green-50 p-6 rounded-2xl border-l-4 border-green-500">
                                <p class="text-gray-700 italic mb-4">
                                    "Our vision is simple: use technology to bridge the gap between traditional farming 
                                    and modern opportunities, ensuring every farmer gets a fair chance to succeed."
                                </p>
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                        <i class="fas fa-quote-left text-green-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold">Rohan Sharma</p>
                                        <p class="text-sm text-gray-600">Founder & CEO</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="relative">
                            <div class="bg-gradient-to-br from-green-100 to-white p-8 rounded-2xl shadow-lg">
                                <img src="https://images.unsplash.com/photo-1625246333195-78d9c38ad449?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                                     alt="Farmers using technology" 
                                     class="w-full h-auto rounded-xl shadow-md">
                                <div class="absolute -bottom-6 -right-6 bg-white p-6 rounded-2xl shadow-xl">
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-green-600 mb-2">2020</div>
                                        <p class="text-gray-700 font-semibold">Journey Began</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Timeline -->
        <section class="py-20 stats-gradient">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <h2 class="text-4xl font-bold text-gray-900 mb-16 text-center section-title">
                        Our Growth Timeline
                    </h2>
                    
                    <div class="relative">
                        <div class="timeline-item">
                            <div class="bg-white p-8 rounded-2xl shadow-md">
                                <div class="flex items-center mb-4">
                                    <div class="bg-green-100 text-green-700 px-4 py-2 rounded-full font-bold mr-4">
                                        2020
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900">The Beginning</h3>
                                </div>
                                <p class="text-gray-600">
                                    Founded with a mission to help farmers in Punjab with language translation 
                                    and basic market information. Started with 100 pilot farmers.
                                </p>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="bg-white p-8 rounded-2xl shadow-md">
                                <div class="flex items-center mb-4">
                                    <div class="bg-green-100 text-green-700 px-4 py-2 rounded-full font-bold mr-4">
                                        2021
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900">Expansion & Features</h3>
                                </div>
                                <p class="text-gray-600">
                                    Added weather forecasting and crop planning features. Expanded to 5 states 
                                    and reached 5,000 farmers. Received government recognition.
                                </p>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="bg-white p-8 rounded-2xl shadow-md">
                                <div class="flex items-center mb-4">
                                    <div class="bg-green-100 text-green-700 px-4 py-2 rounded-full font-bold mr-4">
                                        2022
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900">Technology Integration</h3>
                                </div>
                                <p class="text-gray-600">
                                    Launched AI-powered crop recommendations and mobile app. Partnered with 
                                    100+ agricultural organizations. Crossed 20,000 farmer mark.
                                </p>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="bg-white p-8 rounded-2xl shadow-md">
                                <div class="flex items-center mb-4">
                                    <div class="bg-green-100 text-green-700 px-4 py-2 rounded-full font-bold mr-4">
                                        2023
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900">Nationwide Impact</h3>
                                </div>
                                <p class="text-gray-600">
                                    Covered all 28 states of India. Introduced real-time order tracking and 
                                    financial management tools. 50,000+ farmers actively using the platform.
                                </p>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="bg-white p-8 rounded-2xl shadow-md">
                                <div class="flex items-center mb-4">
                                    <div class="bg-green-100 text-green-700 px-4 py-2 rounded-full font-bold mr-4">
                                        2024
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900">Future Vision</h3>
                                </div>
                                <p class="text-gray-600">
                                    Aiming to reach 1 million farmers. Developing IoT integration for smart 
                                    farming and expanding to international markets.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Mission & Vision -->
        <section id="our-mission" class="py-20 mission-section">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl font-bold text-gray-900 mb-6 section-title">
                            Our Mission & Vision
                        </h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            Driving change in agriculture through innovation and compassion
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <div class="bg-white p-10 rounded-3xl shadow-xl border-2 border-green-100">
                            <div class="w-20 h-20 bg-green-100 rounded-2xl flex items-center justify-center mb-8 mx-auto">
                                <i class="fas fa-bullseye text-3xl text-green-600"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Our Mission</h3>
                            <p class="text-gray-600 text-lg leading-relaxed mb-6">
                                To empower every farmer in India with accessible, free technology that bridges 
                                information gaps, enhances productivity, and increases profitability.
                            </p>
                            <ul class="space-y-4">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span>Make agricultural information accessible in regional languages</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span>Provide real-time market intelligence to farmers</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span>Enable sustainable farming practices through technology</span>
                                </li>
                            </ul>
                        </div>

                        <div class="bg-white p-10 rounded-3xl shadow-xl border-2 border-green-100">
                            <div class="w-20 h-20 bg-green-100 rounded-2xl flex items-center justify-center mb-8 mx-auto">
                                <i class="fas fa-eye text-3xl text-green-600"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Our Vision</h3>
                            <p class="text-gray-600 text-lg leading-relaxed mb-6">
                                To create a digitally empowered farming community where technology serves as 
                                an equalizer, making agriculture profitable, sustainable, and attractive for future generations.
                            </p>
                            <ul class="space-y-4">
                                <li class="flex items-start">
                                    <i class="fas fa-star text-yellow-500 mt-1 mr-3"></i>
                                    <span>Revolutionize Indian agriculture through digital transformation</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-star text-yellow-500 mt-1 mr-3"></i>
                                    <span>Create a nationwide network of digitally literate farmers</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-star text-yellow-500 mt-1 mr-3"></i>
                                    <span>Make India a global leader in agricultural technology</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Core Values -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6 section-title">
                        Our Core Values
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        The principles that guide everything we do
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-6xl mx-auto">
                    <div class="value-card p-8 rounded-2xl">
                        <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-heart text-2xl text-green-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Farmer First</h3>
                        <p class="text-gray-600">
                            Every decision we make starts with the farmer's best interest in mind.
                        </p>
                    </div>

                    <div class="value-card p-8 rounded-2xl">
                        <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-lock-open text-2xl text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Accessibility</h3>
                        <p class="text-gray-600">
                            Making technology accessible to all farmers, regardless of location or resources.
                        </p>
                    </div>

                    <div class="value-card p-8 rounded-2xl">
                        <div class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-handshake text-2xl text-yellow-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Integrity</h3>
                        <p class="text-gray-600">
                            Building trust through transparency, honesty, and reliability in all our actions.
                        </p>
                    </div>

                    <div class="value-card p-8 rounded-2xl">
                        <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-lightbulb text-2xl text-purple-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Innovation</h3>
                        <p class="text-gray-600">
                            Constantly evolving to provide cutting-edge solutions for modern farming challenges.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Team -->
        <section class="py-20 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6 section-title">
                        Meet Our Team
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Passionate individuals dedicated to transforming agriculture
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-6xl mx-auto">
                    <!-- Founder -->
                    <div class="team-card bg-white p-8 rounded-2xl text-center">
                        <div class="team-img rounded-full mx-auto mb-6 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                 alt="Rohan Sharma" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Rohan Sharma</h3>
                        <p class="text-green-600 font-semibold mb-4">Founder & CEO</p>
                        <p class="text-gray-600 text-sm mb-4">
                            Agricultural technologist with 10+ years experience in rural development.
                        </p>
                        <div class="flex justify-center space-x-3">
                            <a href="#" class="text-gray-400 hover:text-green-600">
                                <i class="fab fa-linkedin"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-green-600">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </div>

                    <!-- CTO -->
                    <div class="team-card bg-white p-8 rounded-2xl text-center">
                        <div class="team-img rounded-full mx-auto mb-6 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" 
                                 alt="Priya Patel" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Priya Patel</h3>
                        <p class="text-green-600 font-semibold mb-4">Chief Technology Officer</p>
                        <p class="text-gray-600 text-sm mb-4">
                            AI/ML specialist focused on agricultural technology solutions.
                        </p>
                        <div class="flex justify-center space-x-3">
                            <a href="#" class="text-gray-400 hover:text-green-600">
                                <i class="fab fa-linkedin"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-green-600">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Head of Agriculture -->
                    <div class="team-card bg-white p-8 rounded-2xl text-center">
                        <div class="team-img rounded-full mx-auto mb-6 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                 alt="Amit Singh" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Amit Singh</h3>
                        <p class="text-green-600 font-semibold mb-4">Head of Agriculture</p>
                        <p class="text-gray-600 text-sm mb-4">
                            Former agriculture officer with deep expertise in crop management.
                        </p>
                        <div class="flex justify-center space-x-3">
                            <a href="#" class="text-gray-400 hover:text-green-600">
                                <i class="fab fa-linkedin"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-green-600">
                                <i class="fas fa-globe"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Community Head -->
                    <div class="team-card bg-white p-8 rounded-2xl text-center">
                        <div class="team-img rounded-full mx-auto mb-6 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1534751516642-a1af1ef26a56?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                 alt="Sneha Reddy" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Sneha Reddy</h3>
                        <p class="text-green-600 font-semibold mb-4">Community Head</p>
                        <p class="text-gray-600 text-sm mb-4">
                            Connects with farmers across India to understand their needs.
                        </p>
                        <div class="flex justify-center space-x-3">
                            <a href="#" class="text-gray-400 hover:text-green-600">
                                <i class="fab fa-linkedin"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-green-600">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-12">
                    <a href="<?php echo $base_url; ?>Includes/careers.php" 
                       class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-xl transition duration-300">
                        <i class="fas fa-users mr-2"></i>Join Our Team
                    </a>
                </div>
            </div>
        </section>

        <!-- Impact Statistics -->
        <section class="py-20 stats-gradient">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6 section-title">
                        Our Impact
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Transforming agriculture one farmer at a time
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-6xl mx-auto">
                    <div class="text-center">
                        <div class="stat-number mb-4">50K+</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Farmers</h3>
                        <p class="text-gray-600">Empowered across India</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="stat-number mb-4">28</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">States</h3>
                        <p class="text-gray-600">Covered nationwide</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="stat-number mb-4">₹25Cr+</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Value Added</h3>
                        <p class="text-gray-600">To farmer incomes</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="stat-number mb-4">99.8%</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Satisfaction</h3>
                        <p class="text-gray-600">Farmer satisfaction rate</p>
                    </div>
                </div>

                <!-- Impact Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16 max-w-6xl mx-auto">
                    <div class="impact-card bg-white p-8 rounded-2xl">
                        <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-chart-line text-2xl text-green-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Increased Profits</h3>
                        <p class="text-gray-600">
                            Farmers using our platform report an average 35% increase in annual profits.
                        </p>
                    </div>

                    <div class="impact-card bg-white p-8 rounded-2xl">
                        <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-language text-2xl text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Language Access</h3>
                        <p class="text-gray-600">
                            Information now accessible in 12 regional languages, breaking communication barriers.
                        </p>
                    </div>

                    <div class="impact-card bg-white p-8 rounded-2xl">
                        <div class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-leaf text-2xl text-yellow-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Sustainable Practices</h3>
                        <p class="text-gray-600">
                            40% reduction in water usage through smart irrigation recommendations.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Partners & Recognition -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6 section-title">
                        Partners & Recognition
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Working with leading organizations to transform agriculture
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto mb-16">
                    <div class="bg-gray-50 p-8 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-university text-4xl text-gray-400"></i>
                    </div>
                    <div class="bg-gray-50 p-8 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-handshake text-4xl text-gray-400"></i>
                    </div>
                    <div class="bg-gray-50 p-8 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-globe-asia text-4xl text-gray-400"></i>
                    </div>
                    <div class="bg-gray-50 p-8 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-award text-4xl text-gray-400"></i>
                    </div>
                </div>

                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-900 mb-8">Awards & Recognition</h3>
                    <div class="flex flex-wrap justify-center gap-4">
                        <span class="px-6 py-3 bg-yellow-100 text-yellow-800 rounded-full font-semibold">
                            <i class="fas fa-trophy mr-2"></i>Best Agri-Tech Startup 2023
                        </span>
                        <span class="px-6 py-3 bg-green-100 text-green-800 rounded-full font-semibold">
                            <i class="fas fa-award mr-2"></i>Digital India Award 2022
                        </span>
                        <span class="px-6 py-3 bg-blue-100 text-blue-800 rounded-full font-semibold">
                            <i class="fas fa-medal mr-2"></i>Innovation in Agriculture 2023
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Join Us CTA -->
        <section class="farmers-image py-20 text-white">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">
                        Be Part of the Agricultural Revolution
                    </h2>
                    <p class="text-xl mb-10 opacity-90">
                        Whether you're a farmer, partner, or supporter, join us in transforming Indian agriculture.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-6 justify-center">
                        <a href="<?php echo $base_url; ?>Components/register.php" 
                           class="bg-white text-green-700 hover:bg-gray-100 font-bold py-4 px-10 rounded-xl text-lg transition duration-300 shadow-2xl">
                            <i class="fas fa-user-plus mr-2"></i>Join as Farmer
                        </a>
                        <a href="<?php echo $base_url; ?>Includes/contact.php" 
                           class="bg-transparent border-2 border-white hover:bg-white/20 font-bold py-4 px-10 rounded-xl text-lg transition duration-300">
                            <i class="fas fa-handshake mr-2"></i>Partner With Us
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include '../Components/footer.php'; ?>

    <script>
        // Team card animation
        document.querySelectorAll('.team-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                const img = this.querySelector('.team-img');
                img.style.transform = 'scale(1.05)';
            });
            
            card.addEventListener('mouseleave', function() {
                const img = this.querySelector('.team-img');
                img.style.transform = 'scale(1)';
            });
        });

        // Value card animation
        document.querySelectorAll('.value-card').forEach(card => {
            card.style.transition = 'all 0.3s ease';
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if(targetId === '#') return;
                
                const target = document.querySelector(targetId);
                if(target) {
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Animate counters
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number');
            const speed = 200; // Lower is faster
            
            counters.forEach(counter => {
                const animate = () => {
                    const value = +counter.getAttribute('data-target');
                    const data = +counter.innerText.replace('+', '').replace('Cr+', '');
                    
                    const time = value / speed;
                    if(data < value) {
                        counter.innerText = Math.ceil(data + time) + (counter.innerText.includes('+') ? '+' : '') + (counter.innerText.includes('Cr') ? 'Cr+' : '');
                        setTimeout(animate, 1);
                    } else {
                        counter.innerText = value + (counter.innerText.includes('+') ? '+' : '') + (counter.innerText.includes('Cr') ? 'Cr+' : '');
                    }
                }
                
                // Set initial data-target values
                const currentText = counter.innerText;
                let targetValue;
                
                if(currentText.includes('K+')) {
                    targetValue = parseInt(currentText.replace('K+', '')) * 1000;
                } else if(currentText.includes('Cr+')) {
                    targetValue = parseInt(currentText.replace('Cr+', '')) * 10000000;
                } else {
                    targetValue = parseInt(currentText.replace('%', ''));
                }
                
                counter.setAttribute('data-target', targetValue);
                counter.innerText = '0' + (currentText.includes('%') ? '%' : '');
                
                // Start animation when in view
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if(entry.isIntersecting) {
                            animate();
                            observer.unobserve(entry.target);
                        }
                    });
                });
                
                observer.observe(counter);
            });
        }

        // Initialize animations on load
        window.addEventListener('load', () => {
            animateCounters();
            
            // Add fade-in animation to timeline items
            const timelineItems = document.querySelectorAll('.timeline-item');
            timelineItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateX(-20px)';
                item.style.transition = 'all 0.6s ease ' + (index * 0.2) + 's';
                
                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'translateX(0)';
                }, 100);
            });
            
            // Add animation to impact cards
            const impactCards = document.querySelectorAll('.impact-card');
            impactCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease ' + (index * 0.1) + 's';
                
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 200);
            });
        });

        // Parallax effect for farmers image section
        window.addEventListener('scroll', () => {
            const farmersSection = document.querySelector('.farmers-image');
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            farmersSection.style.backgroundPosition = `center ${rate}px`;
        });
    </script>
</body>
</html>