<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FarmPortal Header</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Phosphor Icons for a modern look -->
    <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/css/icons.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7fafc; /* Light background */
            min-height: 100vh;
        }

        /* Custom style for professional navigation links */
        .nav-link {
            /* Applying Tailwind classes through CSS for DRYer code */
            padding-bottom: 4px; /* Space for the border bottom */
            font-weight: 500;
            color: #4b5563; /* Gray 700 */
            transition: all 0.2s ease-in-out;
            border-bottom: 2px solid transparent;
        }
        .nav-link:hover {
            color: #10b981; /* Emerald 500 */
            border-bottom-color: #10b981;
        }
    </style>
</head>
<body>

    <!-- Main Header / Navigation Bar (The "Best and Beatest" Version) -->
    <header class="sticky top-0 z-20 bg-white shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                
                <!-- Logo / App Name (Enhanced for impact) -->
                <div class="flex-shrink-0">
                    <a href="#" class="text-3xl font-black text-gray-800 flex items-center tracking-tight transition duration-300 transform hover:scale-[1.03]">
                        
                        <!-- NEW LOGO: Growth/Trend SVG -->
                        <svg class="w-10 h-10 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <!-- Represents growth and data visualization -->
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>

                        Farm<span class="text-green-600">Portal</span>
                    </a>
                </div>

                <!-- Desktop Navigation Links (Added Home, Features, About, Contact) -->
                <nav class="hidden md:flex space-x-10">
                    <a href="#" class="nav-link">Home</a>
                    <a href="#" class="nav-link active">Features</a>
                    <a href="#" class="nav-link">About</a>
                    <a href="#" class="nav-link">Contact</a>
                </nav>

                <!-- Sign In / Action Button -->
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-green-600 hidden sm:block transition">
                        Need Help?
                    </a>
                    <button class="flex items-center px-6 py-2.5 bg-green-600 text-white font-bold rounded-xl shadow-lg hover:bg-green-700 transition duration-300 ease-in-out transform hover:-translate-y-0.5 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-green-300">
                        <i class="ph ph-user-circle-bold text-xl mr-2"></i>
                        Sign In
                    </button>
                    
                    <!-- Mobile Menu Button (Placeholder for functionality) -->
                    <button class="md:hidden p-2 text-gray-700 hover:text-green-600 rounded-lg hover:bg-gray-100 transition">
                        <i class="ph ph-list text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- START: FEATURE PAGE CONTENT -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        
        <!-- Feature Hero Section -->
        <section class="text-center mb-20">
            <h1 class="text-xs font-semibold uppercase text-green-600 tracking-widest mb-3">
                Powering Modern Agriculture
            </h1>
            <h2 class="text-5xl md:text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
                Tools to Make Every Acre Count
            </h2>
            <p class="max-w-3xl mx-auto text-xl text-gray-600">
                FarmPortal digitizes your operation, providing **real-time data** and intelligent insights so you can make confident decisions, increase yields, and boost profitability.
            </p>
        </section>

        <!-- Core Features Grid -->
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <!-- Feature 1: Crop Monitoring -->
            <div class="bg-white p-8 rounded-2xl shadow-lg border-t-4 border-green-500 hover:shadow-xl transition duration-300">
                <i class="ph ph-chart-line text-5xl text-green-600 mb-4 inline-block"></i>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Smart Crop Monitoring</h3>
                <p class="text-gray-600">Track field health, growth stages, and potential issues using visualized data. Optimize water and nutrient usage instantly.</p>
            </div>

            <!-- Feature 2: Financial Management -->
            <div class="bg-white p-8 rounded-2xl shadow-lg border-t-4 border-green-500 hover:shadow-xl transition duration-300">
                <i class="ph ph-currency-dollar text-5xl text-green-600 mb-4 inline-block"></i>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Robust Financial Tracking</h3>
                <p class="text-gray-600">Easily log all revenues and expenses. Generate clear P&L reports to understand your true **net profit** per crop or field.</p>
            </div>
            
            <!-- Feature 3: Task & Labor Management -->
            <div class="bg-white p-8 rounded-2xl shadow-lg border-t-4 border-green-500 hover:shadow-xl transition duration-300">
                <i class="ph ph-list-checks text-5xl text-green-600 mb-4 inline-block"></i>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Team & Task Scheduling</h3>
                <p class="text-gray-600">Assign jobs, set deadlines, and track completion status for your farm labor, ensuring every operation is **timely and efficient**.</p>
            </div>

            <!-- Feature 4: AI Advisor -->
            <div class="bg-white p-8 rounded-2xl shadow-lg border-t-4 border-green-500 hover:shadow-xl transition duration-300">
                <i class="ph ph-robot text-5xl text-green-600 mb-4 inline-block"></i>
                <h3 class="text-xl font-bold text-gray-900 mb-3">AI Consultation</h3>
                <p class="text-gray-600">Get personalized, data-driven recommendations on planting density, fertilizer application, and **disease prevention** from our integrated AI.</p>
            </div>
        </section>

        <!-- Secondary Feature Block (Detailed Section) -->
        <section class="mt-24 p-12 bg-green-50 rounded-3xl shadow-inner border border-green-200">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="text-sm font-semibold uppercase text-green-700 tracking-wider">Beyond the Basics</span>
                    <h3 class="text-4xl font-bold text-gray-900 mt-2 mb-4">Real-Time Data Sync</h3>
                    <p class="text-lg text-gray-700 mb-6">Connect your IoT sensors and weather station data directly to FarmPortal. Our platform processes millions of data points every hour to give you a single, unified view of your entire operation, accessible from anywhere.</p>
                    <a href="#" class="inline-flex items-center text-green-600 font-bold hover:text-green-700 transition">
                        Explore Integrations 
                        <i class="ph ph-arrow-right ml-2 text-xl"></i>
                    </a>
                </div>
                <!-- Mockup/Placeholder Image -->
                <div class="rounded-xl shadow-2xl overflow-hidden ring-4 ring-green-100">
                    <img src="https://placehold.co/600x400/10b981/ffffff?text=Data+Dashboard+Mockup" alt="Dashboard visualization mockup" class="w-full h-auto object-cover">
                </div>
            </div>
        </section>

        <!-- Final CTA -->
        <section class="mt-20 text-center py-16 px-8 bg-gray-800 rounded-2xl shadow-2xl">
            <h3 class="text-4xl font-extrabold text-white mb-4">Ready to Grow Smarter?</h3>
            <p class="text-lg text-gray-300 mb-8 max-w-2xl mx-auto">Start your 14-day free trial today. No credit card required, just better farming.</p>
            <button class="px-10 py-3.5 bg-emerald-500 text-white font-bold text-lg rounded-xl shadow-2xl shadow-emerald-500/50 hover:bg-emerald-600 transition duration-300 ease-in-out transform hover:scale-[1.02] focus:outline-none">
                Start Free Trial
            </button>
        </section>

    </main>
    <!-- END: FEATURE PAGE CONTENT -->
    
    <!-- FOOTER SECTION (Updated to dark and vibrant emerald colors) -->
    <footer class="bg-gray-900 mt-20 shadow-2xl shadow-gray-900/50">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-8 mb-10 border-b border-gray-700 pb-10">
                
                <!-- Column 1: Logo & Mission -->
                <div class="col-span-2 md:col-span-1">
                    <a href="#" class="text-2xl font-black text-white flex items-center tracking-tight">
                        <!-- Logo (Updated color to emerald-400) -->
                        <svg class="w-8 h-8 mr-2 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        Farm<span class="text-emerald-300">Portal</span>
                    </a>
                    <p class="mt-4 text-sm text-gray-400">Digital tools for smarter agriculture and a greener future. Join the future of farming.</p>
                </div>

                <!-- Column 2: Company -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-200 tracking-wider uppercase mb-4">Company</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-base text-gray-400 hover:text-emerald-300 transition">About Us</a></li>
                        <li><a href="#" class="text-base text-gray-400 hover:text-emerald-300 transition">Careers</a></li>
                        <li><a href="#" class="text-base text-gray-400 hover:text-emerald-300 transition">Press</a></li>
                        <li><a href="#" class="text-base text-gray-400 hover:text-emerald-300 transition">Partners</a></li>
                    </ul>
                </div>

                <!-- Column 3: Product & Resources -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-200 tracking-wider uppercase mb-4">Product</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-base text-gray-400 hover:text-emerald-300 transition">Features</a></li>
                        <li><a href="#" class="text-base text-gray-400 hover:text-emerald-300 transition">Pricing</a></li>
                        <li><a href="#" class="text-base text-gray-400 hover:text-emerald-300 transition">Help Center</a></li>
                        <li><a href="#" class="text-base text-gray-400 hover:text-emerald-300 transition">Case Studies</a></li>
                    </ul>
                </div>

                <!-- Column 4: Legal -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-200 tracking-wider uppercase mb-4">Legal</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-base text-gray-400 hover:text-emerald-300 transition">Privacy Policy</a></li>
                        <li><a href="#" class="text-base text-gray-400 hover:text-emerald-300 transition">Terms of Service</a></li>
                        <li><a href="#" class="text-base text-gray-400 hover:text-emerald-300 transition">Cookie Settings</a></li>
                    </ul>
                </div>
            </div>

            <!-- Copyright Section -->
            <div class="mt-8 pt-4 border-t border-gray-800 flex justify-center">
                <p class="text-base text-gray-500">&copy; 2024 FarmPortal. All rights reserved. Built with Smarter Data.</p>
            </div>
            
        </div>
    </footer>

</body>
</html>
