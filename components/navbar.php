<?php
require_once dirname(__DIR__) . '/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - <?php echo SITE_TAGLINE; ?></title>
    <!-- CSS & Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/main.css">
    <style>
        .language-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 10000;    
        }
        
        .language-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }
        
        .language-content {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 500px;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: modalSlideIn 0.3s ease-out;
            /* Hide scrollbar */
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
        }
        
        /* Hide scrollbar for Chrome, Safari and Opera */
        .language-content::-webkit-scrollbar {
            display: none;
        }
        
        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translate(-50%, -60%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }
        
        .language-header {
            padding: 20px;
            border-bottom: 1px solid #e5e7eb;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border-radius: 16px 16px 0 0;
        }
        
        .language-header h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .language-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            padding: 20px;
            /* Hide scrollbar */
            overflow-y: auto;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
        }
        
        /* Hide scrollbar for Chrome, Safari and Opera */
        .language-grid::-webkit-scrollbar {
            display: none;
        }
        
        .language-option {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            background: white;
        }
        
        .language-option:hover {
            border-color: #10b981;
            background: #f0fdf4;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1);
        }
        
        .language-option.active {
            border-color: #10b981;
            background: #f0fdf4;
            font-weight: 600;
        }
        
        .language-flag {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 12px;
            border: 2px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }
        
        .language-info {
            flex: 1;
        }
        
        .language-name {
            font-weight: 500;
            color: #1f2937;
        }
        
        .language-code {
            font-size: 0.875rem;
            color: #6b7280;
        }
        
        .current-language {
            font-size: 0.75rem;
            color: #059669;
            font-weight: 600;
            margin-top: 2px;
        }
        
        .language-search {
            padding: 16px 20px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .language-search input {
            width: 100%;
            padding: 10px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }
        
        .language-search input:focus {
            outline: none;
            border-color: #10b981;
        }
        
        .close-language-modal {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: white;
            font-size: 1.25rem;
            transition: background 0.2s;
        }
        
        .close-language-modal:hover {
            background: rgba(255, 255, 255, 0.3);
        }
        
        .action-btn.language-active {
            background: #f0fdf4;
            color: #059669;
            border: 2px solid #10b981;
        }
        
        /* Translation loading indicator */
        .translation-loading {
            position: fixed;
            top: 80px;
            right: 20px;
            background: #10b981;
            color: white;
            padding: 12px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 10001;
            display: none;
            align-items: center;
            gap: 10px;
        }
        
        .translation-loading.show {
            display: flex;
            animation: slideInRight 0.3s ease-out;
        }
        
        .spinner {
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @media (max-width: 640px) {
            .language-grid {
                grid-template-columns: 1fr;
            }
            
            .language-content {
                width: 95%;
                max-height: 85vh;
            }
        }        
    </style>
</head>
<body>
    <!-- Translation Loading Indicator -->
    <div class="translation-loading" id="translationLoading">
        <div class="spinner"></div>
        <span>Translating page...</span>
    </div>

    <!-- Main Navbar -->
    <nav class="navbar" id="navbar" role="navigation" aria-label="Main navigation">
        <div class="nav-container">
            <!-- Main Navigation Row -->
            <div class="nav-main">
                <!-- Logo -->
                <a href="<?php echo $base_url; ?>index.php" class="logo-container" aria-label="GreenAgro Home">
                    <div class="logo"><img src="<?php echo $base_url; ?>assets/image/logo.png"></div>
                    <div class="logo-text">
                        <h1 data-translate="site-name">GreenAgro</h1>
                        <span data-translate="site-tagline">PREMIUM ORGANIC MARKETPLACE</span>
                    </div>
                </a>

                <!-- Search Container -->
                <div class="search-container">
                    <div class="search-bar">
                        <input 
                            type="search" 
                            placeholder="Search fresh vegetables, organic fruits, herbs & more..." 
                            id="searchInput"
                            data-translate-placeholder="search-placeholder"
                            aria-label="Search products"
                            autocomplete="off"
                        >
                        <div class="search-actions">
                            <button 
                                class="voice-search" 
                                title="Voice Search" 
                                aria-label="Start voice search"
                                type="button"
                            >
                                <i class="fas fa-microphone"></i>
                            </button>
                            <button 
                                class="search-btn" 
                                aria-label="Search products"
                                type="button"
                            >
                                <i class="fas fa-search"></i>
                                <span data-translate="search-btn">Search</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="#support" class="action-btn" id="supportBtn" title="Support" aria-label="Support" onclick="openSupportModal(event)">
                        <i class="fas fa-headset"></i>
                        <span data-translate="support">Support</span>
                    </a>
                    
                    <div class="lang-menu relative group">
    <button class="action-btn flex flex-col items-center" aria-label="Select Language">
        <i class="fas fa-globe"></i>
        <span class="text-[10px] font-bold uppercase" id="currentLangLabel">En</span>
    </button>
    
    <div class="lang-dropdown absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 max-h-80 overflow-y-auto">
        <div class="py-2">
            <a onclick="changeLanguage('en', 'En')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 cursor-pointer">🇬🇧 English</a>
            <a onclick="changeLanguage('hi', 'Hi')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 cursor-pointer">🇮🇳 Hindi</a>
            <a onclick="changeLanguage('gu', 'Gu')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 cursor-pointer">🇮🇳 Gujarati</a>
            <a onclick="changeLanguage('ta', 'Ta')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 cursor-pointer">🇮🇳 Tamil</a>
            <a onclick="changeLanguage('te', 'Te')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 cursor-pointer">🇮🇳 Telugu</a>
            <a onclick="changeLanguage('kn', 'Kn')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 cursor-pointer">🇮🇳 Kannada</a>
            <a onclick="changeLanguage('ml', 'Ml')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 cursor-pointer">🇮🇳 Malayalam</a>
            <a onclick="changeLanguage('mr', 'Mr')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 cursor-pointer">🇮🇳 Marathi</a>
            <a onclick="changeLanguage('bn', 'Bn')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 cursor-pointer">🇮🇳 Bengali</a>
            <a onclick="changeLanguage('pa', 'Pa')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 cursor-pointer">🇮🇳 Punjabi</a>
            <a onclick="changeLanguage('ur', 'Ur')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 cursor-pointer">🇮🇳 Urdu</a>
            <a onclick="changeLanguage('or', 'Or')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 cursor-pointer">🇮🇳 Odia</a>
            <a onclick="changeLanguage('as', 'As')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 cursor-pointer">🇮🇳 Assamese</a>
            <a onclick="changeLanguage('ne', 'Ne')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 cursor-pointer">🇳🇵 Nepali</a>
            <a onclick="changeLanguage('sd', 'Sd')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 cursor-pointer">🇮🇳 Sindhi</a>
            <a onclick="changeLanguage('sa', 'Sa')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 cursor-pointer">🇮🇳 Sanskrit</a>
        </div>
    </div>
</div>

<div id="google_translate_element" style="display:none;"></div>

                    <!-- Light/Dark Mode Toggle -->
                    <!-- <button 
                        class="action-btn" 
                        id="themeToggle" 
                        title="Toggle Light/Dark Mode" 
                        aria-label="Toggle Light/Dark Mode"
                        type="button"
                    >
                        <i class="fas fa-sun"></i>
                        <span data-translate="mode">Mode</span>
                    </button> -->

                    <a href="<?php echo $base_url; ?>Components/login.php" class="login-btn" data-translate="login">
                        Login
                    </a>
                    <a href="<?php echo $base_url; ?>Components/register.php" class="register-btn" data-translate="get-started">
                        Get Started
                    </a>
                </div>

                <!-- Mobile Menu Toggle -->
                <button 
                    class="mobile-toggle" 
                    id="mobileToggle" 
                    aria-label="Toggle mobile menu"
                    aria-expanded="false"
                    type="button"
                >
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
                        <span data-translate="nav-home">Home</span>
                    </a>
                </li>
                <li class="nav-item" role="none">
                    <a href="<?php echo $base_url; ?>Includes/industries.php" class="nav-link" role="menuitem">
                        <i class="fas fa-industry"></i>
                        <span data-translate="nav-industries">Industries</span>
                    </a>
                </li>
                                <li class="nav-item dropdown" role="none">
                    <a href="#operations" class="nav-link" role="menuitem" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-tractor"></i>
                        <span data-translate="nav-operations">Operations</span>
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu absolute left-0 -translate-x-1/2 mt-0 w-[660px] shadow-2xl bg-white border border-green-200 rounded-xl overflow-hidden z-10 transition-all duration-300">
                        <div class="p-4 grid grid-cols-3 gap-6">
                            <div>
                                <p class="font-bold text-green-800 mb-2 border-b border-green-100 pb-1" data-translate="field-management">Field Management</p>
                                <div class="space-y-1 text-sm">
                                    <a href="<?php echo $base_url; ?>includes/megamenu/crop-planning.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition" data-translate="crop-planning">Crop Planning</a>
                                    <a href="<?php echo $base_url; ?>includes/megamenu/soil-health.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition" data-translate="soil-health">Soil Health</a>
                                    <a href="<?php echo $base_url; ?>includes/megamenu/irrigation-schedules.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition" data-translate="irrigation-schedules">Irrigation Schedules</a>
                                </div>
                            </div>
                            <div>
                                <p class="font-bold text-green-800 mb-2 border-b border-green-100 pb-1" data-translate="resources-assets">Resources & Assets</p>
                                <div class="space-y-1 text-sm">
                                    <a href="<?php echo $base_url; ?>includes/megamenu/equipment-tracking.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition" data-translate="equipment-tracking">Equipment Tracking</a>
                                    <a href="<?php echo $base_url; ?>includes/megamenu/inventory.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition" data-translate="inventory">Inventory (Seeds/Fertilizer)</a>
                                    <a href="<?php echo $base_url; ?>includes/megamenu/maintenance-logs.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition" data-translate="maintenance-logs">Maintenance Logs</a>
                                </div>
                            </div>
                            <div>
                                <p class="font-bold text-green-800 mb-2 border-b border-green-100 pb-1" data-translate="analytics-reporting">Analytics & Reporting</p>
                                <div class="space-y-1 text-sm">
                                    <a href="<?php echo $base_url; ?>includes/megamenu/yield-forecasting.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition" data-translate="yield-forecasting">Yield Forecasting</a>
                                    <a href="<?php echo $base_url; ?>includes/megamenu/financial-dashboards.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition" data-translate="financial-dashboards">Financial Dashboards</a>
                                    <a href="<?php echo $base_url; ?>includes/megamenu/audit-trails.php" class="block text-gray-700 hover:text-green-600 hover:bg-gray-50 p-1 rounded-md transition" data-translate="audit-trails">Audit Trails</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item" role="none">
                    <a href="<?php echo $base_url; ?>Includes/our-solutions.php" class="nav-link" role="menuitem">
                        <i class="fas fa-cogs"></i>
                        <span data-translate="nav-solutions">Our Solutions</span>
                    </a>
                </li>
                <li class="nav-item" role="none">
                    <a href="<?php echo $base_url; ?>Includes/features.php" class="nav-link" role="menuitem">
                        <i class="fas fa-star"></i>
                        <span data-translate="nav-features">Features</span>
                    </a>
                </li>
                <li class="nav-item" role="none">
                    <a href="<?php echo $base_url; ?>Includes/about-us.php" class="nav-link" role="menuitem">
                        <i class="fas fa-info-circle"></i>
                        <span data-translate="nav-about">About Us</span>
                    </a>
                </li>
                <li class="nav-item" role="none">
                    <a href="<?php echo $base_url; ?>Includes/support.php" class="nav-link" role="menuitem">
                        <i class="fas fa-hands-helping"></i>
                        <span data-translate="nav-supports">Supports</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Support Modal -->
    <div class="support-modal" id="supportModal">
        <div class="modal-overlay" onclick="closeSupportModal()"></div>
        <div class="support-content">
            <div class="support-header">
                <h3><i class="fas fa-headset"></i> <span data-translate="support-title">24/7 Customer Support</span></h3>
                <p data-translate="support-subtitle">We're here to help you anytime</p>
            </div>
            <div class="support-options">
                <div class="support-option" onclick="contactSupport('phone')">
                    <div class="support-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="support-info">
                        <h4 data-translate="call-us">Call Us</h4>
                        <p>+91 8511916407 (24/7 Available)</p>
                    </div>
                </div>
                <div class="support-option" onclick="contactSupport('whatsapp')">
                    <div class="support-icon">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div class="support-info">
                        <h4>WhatsApp</h4>
                        <p data-translate="quick-chat">Quick chat support</p>
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
                        <h4 data-translate="live-chat">Live Chat</h4>
                        <p data-translate="instant-messaging">Instant messaging support</p>
                    </div>
                </div>
            </div>
            <button class="close-modal" onclick="closeSupportModal()" style="position: absolute; top: 15px; right: 15px; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #666;">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <!-- Language Modal -->
    <div class="language-modal" id="languageModal">
        <div class="language-overlay" onclick="closeLanguageModal()"></div>
        <div class="language-content">
            <div class="language-header">
                <h3><i class="fas fa-globe"></i> Select Language</h3>
                <p>Choose your preferred language for the website</p>
            </div>
            
            <div class="language-search">
                <input 
                    type="text" 
                    id="languageSearch" 
                    placeholder="Search languages..." 
                    onkeyup="filterLanguages()"
                >
            </div>
            
            <div class="language-grid" id="languageGrid">
                <!-- Languages will be populated here -->
            </div>
            
            <button class="close-language-modal" onclick="closeLanguageModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    
<script type="text/javascript">
function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'en',
        includedLanguages: 'en,hi,gu,ta,te,kn,ml,mr,bn,pa,ur,or,as,ne,sd,sa,fr,de,es',
        layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL,
        autoDisplay: false
    }, 'google_translate_element');
}

function changeLanguage(lang, label) {
    // 1. Update the UI text
    document.getElementById('currentLangLabel').innerText = label;

    // 2. Find the Google Translate hidden dropdown
    const select = document.querySelector('.goog-te-combo');
    if (select) {
        select.value = lang;
        select.dispatchEvent(new Event('change'));
    } else {
        console.error("Google Translate not yet loaded");
    }
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>