<?php $base_url = '/farm/'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenAgro</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom Font Import */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f8f8;
        }

        /* Utility classes for the mega menu and language selector visibility */
        .dropdown-menu {
            display: none;
        }

        /* Desktop: Show dropdown on hover */
        .group:hover .dropdown-menu {
            display: block;
        }
        
        /* Mobile: Show dropdown when toggled by JS */
        .mobile-open {
            display: block !important;
        }

        /* Custom scrollbar styling for the mobile menu on small screens */
        @media (max-width: 767px) {
            #mobile-menu {
                max-height: calc(100vh - 64px); /* Full viewport height minus header height */
                overflow-y: auto;
            }
        }
    </style>
</head>
<body class="bg-gray-50">

    <header class="shadow-lg bg-green-700 text-white sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <!-- Logo Section -->
                <div class="flex-shrink-0">
                    <a href="<?php echo $base_url; ?>index.php" class="flex items-center space-x-2">
                        <img src="<?php echo $base_url; ?>assets/image/logo2.png"
                             alt="FarmTech Logo" 
                             class="rounded-full shadow-md w-15 h-14">
                    </a>
                </div>

                <!-- Desktop Navigation Links, Language, and Login -->
                <div class="hidden md:flex md:items-center md:space-x-4">
                    
                    <!-- Main Navigation Links -->
                    <div class="flex space-x-1">
                        <!-- Simple Nav Link -->
                        <a href="<?php echo $base_url; ?>index.php" class="px-3 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition">Dashboard</a>

                        <!-- Mega Menu Link (Desktop) -->
                        <div class="relative group">
                            <button class="flex items-center px-3 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition focus:outline-none">
                                Operations
                                <svg class="ml-1 h-5 w-5 transition-transform group-hover:rotate-180" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            
                            <!-- Mega Menu Content -->
                            <div class="dropdown-menu absolute left-1/2 -translate-x-1/2 mt-0 w-[600px] shadow-2xl bg-white border border-green-200 rounded-xl overflow-hidden z-10 transition-all duration-300">
                                <div class="p-6 grid grid-cols-3 gap-6">
                                    
                                    <!-- Column 1: Field Management -->
                                    <div>
                                        <p class="font-bold text-green-800 mb-2 border-b border-green-100 pb-1">Field Management</p>
                                        <div class="space-y-1 text-sm">
                                            <a href="<?php echo $base_url; ?>includes/crop-planning.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition">Crop Planning</a>
                                            <a href="<?php echo $base_url; ?>includes/soil-health.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition">Soil Health</a>
                                            <a href="<?php echo $base_url; ?>includes/irrigation-schedules.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition">Irrigation Schedules</a>
                                        </div>
                                    </div>

                                    <!-- Column 2: Resources & Assets -->
                                    <div>
                                        <p class="font-bold text-green-800 mb-2 border-b border-green-100 pb-1">Resources & Assets</p>
                                        <div class="space-y-1 text-sm">
                                            <a href="<?php echo $base_url; ?>includes/equipment-tracking.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition">Equipment Tracking</a>
                                            <a href="<?php echo $base_url; ?>includes/inventory.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition">Inventory (Seeds/Fertilizer)</a>
                                            <a href="<?php echo $base_url; ?>includes/maintenance-logs.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition">Maintenance Logs</a>
                                        </div>
                                    </div>

                                    <!-- Column 3: Analytics & Reporting -->
                                    <div>
                                        <p class="font-bold text-green-800 mb-2 border-b border-green-100 pb-1">Analytics & Reporting</p>
                                        <div class="space-y-1 text-sm">
                                            <a href="<?php echo $base_url; ?>" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition">Yield Forecasting</a>
                                            <a href="<?php echo $base_url; ?>" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition">Financial Dashboards</a>
                                            <a href="<?php echo $base_url; ?>" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition">Audit Trails</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Simple Nav Link -->
                        <a href="<?php echo $base_url; ?>includes/contact.php" class="px-3 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition">Support</a>
                    </div>
                    
                    <!-- Utility Links (Language & Login) -->
                    <div class="flex items-center space-x-4 border-l border-green-700 ml-4 pl-4">
                        
                        <!-- Language Option Dropdown -->
                        <div class="relative group">
                            <button id="lang-button-desktop" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition focus:outline-none">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 0110 15.375V15M9 15h2M4 7h16M4 11h16M4 15h16M4 19h16m-4 0a2 2 0 002-2v-3m-3 3h-2m-3 0h-2m-3 0H4"></path></svg>
                                EN
                                <svg class="ml-1 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            
                            <!-- Language Dropdown Content -->
                            <div class="dropdown-menu absolute right-0 mt-2 w-32 rounded-lg shadow-xl bg-white ring-1 ring-black ring-opacity-5 z-20">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-t-lg">English (EN)</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Spanish (ES)</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-b-lg">French (FR)</a>
                            </div>
                        </div>

                        <!-- Login Button -->
                        <a href="<?php echo $base_url; ?>components/login.php"><button class="px-4 py-1.5 rounded-full text-sm font-semibold bg-white text-green-800 shadow-md hover:bg-green-100 transition duration-150">
                            Log In
                        </button></a>
                    </div>

                </div>

                <!-- Mobile Menu Button (Hamburger) -->
                <div class="md:hidden flex items-center">
                    <!-- Language selector for mobile (optional, added here for completeness) -->
                    <button id="lang-toggle-mobile" class="p-2 rounded-lg hover:bg-green-700 focus:outline-none mr-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 0110 15.375V15M9 15h2M4 7h16M4 11h16M4 15h16M4 19h16m-4 0a2 2 0 002-2v-3m-3 3h-2m-3 0h-2m-3 0H4"></path></svg>
                    </button>
                    <!-- Hamburger Menu Button -->
                    <button id="menu-toggle" class="inline-flex items-center justify-center p-2 rounded-lg text-white hover:bg-green-700 focus:outline-none">
                        <!-- Icon when closed -->
                        <svg id="menu-icon-closed" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                        <!-- Icon when open -->
                        <svg id="menu-icon-open" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </div>
        </nav>

        <!-- Mobile Menu (Hidden by default) -->
        <div id="mobile-menu" class="hidden md:hidden bg-green-700 w-full pb-4">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#" class="block px-3 py-2 rounded-lg text-base font-medium text-white hover:bg-green-600 transition">Dashboard</a>
                
                <!-- Mobile Mega Menu Title/Toggle -->
                <button id="mobile-ops-toggle" class="flex items-center justify-between w-full px-3 py-2 rounded-lg text-base font-medium text-white hover:bg-green-600 transition">
                    Operations
                    <svg id="mobile-ops-arrow" class="h-5 w-5 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>
                
                <!-- Mobile Mega Menu Content (Hidden by default) -->
                <div id="mobile-ops-menu" class="hidden pl-4 border-l border-green-500 space-y-1">
                    <p class="text-sm font-bold pt-2 text-green-200">Field Management</p>
                    <a href="<?php echo $base_url; ?>includes/crop-planning.php" class="block px-2 py-1 text-sm text-green-100 hover:bg-green-600 rounded-md transition">Crop Planning</a>
                    <a href="<?php echo $base_url; ?>includes/soil-health.php" class="block px-2 py-1 text-sm text-green-100 hover:bg-green-600 rounded-md transition">Soil Health</a>
                    <p class="text-sm font-bold pt-2 text-green-200">Resources & Assets</p>
                    <a href="<?php echo $base_url; ?>" class="block px-2 py-1 text-sm text-green-100 hover:bg-green-600 rounded-md transition">Equipment Tracking</a>
                    <a href="<?php echo $base_url; ?>" class="block px-2 py-1 text-sm text-green-100 hover:bg-green-600 rounded-md transition">Inventory</a>
                    <p class="text-sm font-bold pt-2 text-green-200">Analytics & Reporting</p>
                    <a href="<?php echo $base_url; ?>" class="block px-2 py-1 text-sm text-green-100 hover:bg-green-600 rounded-md transition">Yield Forecasting</a>
                </div>

                <a href="#" class="block px-3 py-2 rounded-lg text-base font-medium text-white hover:bg-green-600 transition">Support</a>
            </div>

            <div class="pt-4 border-t border-green-600">
                <!-- Mobile Language Selector (Combined into main menu) -->
                <div class="px-5">
                    <p class="text-sm font-medium mb-1 text-green-200">Select Language</p>
                    <div class="bg-green-600 rounded-lg overflow-hidden">
                        <a href="#" class="block px-3 py-2 text-sm text-white font-medium hover:bg-green-500 transition">English (EN)</a>
                        <a href="#" class="block px-3 py-2 text-sm text-white font-medium hover:bg-green-500 transition">Spanish (ES)</a>
                        <a href="#" class="block px-3 py-2 text-sm text-white font-medium hover:bg-green-500 transition">French (FR)</a>
                    </div>
                </div>

                <!-- Mobile Login Button -->
                <div class="px-5 pt-4">
                    <button class="w-full px-4 py-2 rounded-full text-base font-semibold bg-white text-green-800 shadow-lg hover:bg-green-100 transition duration-150">
                        Log In / Register
                    </button>
                </div>
            </div>
        </div>
    </header>

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIconClosed = document.getElementById('menu-icon-closed');
        const menuIconOpen = document.getElementById('menu-icon-open');
        
        const mobileOpsToggle = document.getElementById('mobile-ops-toggle');
        const mobileOpsMenu = document.getElementById('mobile-ops-menu');
        const mobileOpsArrow = document.getElementById('mobile-ops-arrow');


        // Function to toggle the main mobile menu
        menuToggle.addEventListener('click', () => {
            const isMenuOpen = mobileMenu.classList.contains('hidden');

            if (isMenuOpen) {
                // Open menu
                mobileMenu.classList.remove('hidden');
                menuIconClosed.classList.add('hidden');
                menuIconOpen.classList.remove('hidden');
            } else {
                // Close menu
                mobileMenu.classList.add('hidden');
                menuIconClosed.classList.remove('hidden');
                menuIconOpen.classList.add('hidden');
                
                // Also close the mobile mega menu if it was open
                mobileOpsMenu.classList.add('hidden');
                mobileOpsArrow.classList.remove('rotate-180');
            }
        });

        // Function to toggle the nested mega menu within the mobile menu
        mobileOpsToggle.addEventListener('click', () => {
            const isOpsMenuOpen = mobileOpsMenu.classList.contains('hidden');
            if (isOpsMenuOpen) {
                mobileOpsMenu.classList.remove('hidden');
                mobileOpsArrow.classList.add('rotate-180');
            } else {
                mobileOpsMenu.classList.add('hidden');
                mobileOpsArrow.classList.remove('rotate-180');
            }
        });
        
    </script>
</body>
</html>
