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
                    
                    <!-- Language Selector -->
                    <button class="action-btn" id="languageBtn" title="Select Language" aria-label="Select Language" onclick="openLanguageModal(event)">
                        <i class="fas fa-globe"></i>
                        <span id="currentLanguage">En</span>
                    </button>

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
    
<script>
        // ⚙️ CONFIGURATION - Add your Google Translate API Key here
        const GOOGLE_TRANSLATE_API_KEY = 'YOUR_API_KEY_HERE'; // Replace with your actual API key
        
        // Alternative: LibreTranslate (Self-hosted or free instance)
        const LIBRETRANSLATE_API_URL = 'https://libretranslate.com/translate'; // Free API
        const LIBRETRANSLATE_API_KEY = ''; // Optional, leave empty for free tier
        
        const MYMEMORY_API_URL = 'https://api.mymemory.translated.net/get';
        // Choose translation service: 'google', 'libretranslate', or 'mymemory'
        const TRANSLATION_SERVICE = 'mymemory';

        // Language data with ISO 639-1 codes
        const languages = [
            { code: 'en', name: 'English', flag: '🇬🇧', native: 'English' },
            { code: 'hi', name: 'Hindi', flag: '🇮🇳', native: 'हिंदी' },
            { code: 'gu', name: 'Gujarati', flag: '🇮🇳', native: 'ગુજરાતી' },
            { code: 'ta', name: 'Tamil', flag: '🇮🇳', native: 'தமிழ்' },
            { code: 'te', name: 'Telugu', flag: '🇮🇳', native: 'తెలుగు' },
            { code: 'kn', name: 'Kannada', flag: '🇮🇳', native: 'ಕನ್ನಡ' },
            { code: 'ml', name: 'Malayalam', flag: '🇮🇳', native: 'മലയാളം' },
            { code: 'mr', name: 'Marathi', flag: '🇮🇳', native: 'मराठी' },
            { code: 'bn', name: 'Bengali', flag: '🇮🇳', native: 'বাংলা' },
            { code: 'pa', name: 'Punjabi', flag: '🇮🇳', native: 'ਪੰਜਾਬੀ' },
            { code: 'ur', name: 'Urdu', flag: '🇮🇳', native: 'اردو' },
            { code: 'or', name: 'Odia', flag: '🇮🇳', native: 'ଓଡ଼ିଆ' },
            { code: 'as', name: 'Assamese', flag: '🇮🇳', native: 'অসমীয়া' },
            { code: 'ne', name: 'Nepali', flag: '🇳🇵', native: 'नेपाली' },
            { code: 'sd', name: 'Sindhi', flag: '🇮🇳', native: 'सिन्धी' },
            { code: 'sa', name: 'Sanskrit', flag: '🇮🇳', native: 'संस्कृतम्' },
            { code: 'es', name: 'Spanish', flag: '🇪🇸', native: 'Español' },
            { code: 'fr', name: 'French', flag: '🇫🇷', native: 'Français' },
            { code: 'de', name: 'German', flag: '🇩🇪', native: 'Deutsch' },
            { code: 'zh-CN', name: 'Chinese', flag: '🇨🇳', native: '中文' },
            { code: 'ja', name: 'Japanese', flag: '🇯🇵', native: '日本語' },
            { code: 'ar', name: 'Arabic', flag: '🇸🇦', native: 'العربية' },
            { code: 'ru', name: 'Russian', flag: '🇷🇺', native: 'Русский' },
            { code: 'pt', name: 'Portuguese', flag: '🇵🇹', native: 'Português' }
        ];

        let currentLanguage = localStorage.getItem('selectedLanguage') || 'en';
        let translationCache = JSON.parse(localStorage.getItem('translationCache') || '{}');

        // Google Translate API
        async function translateWithGoogle(text, targetLang) {
            if (!GOOGLE_TRANSLATE_API_KEY || GOOGLE_TRANSLATE_API_KEY === 'YOUR_API_KEY_HERE') {
                console.error('❌ Google Translate API key not configured');
                return text;
            }

            try {
                const response = await fetch(
                    `https://translation.googleapis.com/language/translate/v2?key=${GOOGLE_TRANSLATE_API_KEY}`,
                    {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            q: text,
                            source: 'en',
                            target: targetLang,
                            format: 'text'
                        })
                    }
                );
                
                const data = await response.json();
                
                if (data.data && data.data.translations && data.data.translations[0]) {
                    return data.data.translations[0].translatedText;
                }
                
                throw new Error('Translation failed');
            } catch (error) {
                console.error('Google Translate error:', error);
                return text;
            }
        }

        // LibreTranslate API
        async function translateWithLibreTranslate(text, targetLang) {
            try {
                const response = await fetch(LIBRETRANSLATE_API_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        q: text,
                        source: 'en',
                        target: targetLang,
                        format: 'text',
                        api_key: LIBRETRANSLATE_API_KEY
                    })
                });
                
                const data = await response.json();
                
                if (data.translatedText) {
                    return data.translatedText;
                }
                
                throw new Error('Translation failed');
            } catch (error) {
                console.error('LibreTranslate error:', error);
                return text;
            }
        }

        // MyMemory API (Free, no API key needed)
        async function translateWithMyMemory(text, targetLang) {
            try {
                const response = await fetch(
                    `https://api.mymemory.translated.net/get?q=${encodeURIComponent(text)}&langpair=en|${targetLang}`
                );
                const data = await response.json();
                
                if (data.responseData && data.responseData.translatedText) {
                    return data.responseData.translatedText;
                }
                
                throw new Error('Translation failed');
            } catch (error) {
                console.error('MyMemory error:', error);
                return text;
            }
        }

        // Main translation function
        async function translateText(text, targetLang) {
            if (targetLang === 'en' || !text || text.trim() === '') return text;
            
            // Check cache first
            const cacheKey = `${text}_${targetLang}_${TRANSLATION_SERVICE}`;
            if (translationCache[cacheKey]) {
                return translationCache[cacheKey];
            }

            let translated = text;

            // Call appropriate translation service
            switch (TRANSLATION_SERVICE) {
                case 'google':
                    translated = await translateWithGoogle(text, targetLang);
                    break;
                case 'libretranslate':
                    translated = await translateWithLibreTranslate(text, targetLang);
                    break;
                case 'mymemory':
                default:
                    translated = await translateWithMyMemory(text, targetLang);
                    break;
            }

            // Cache the translation
            translationCache[cacheKey] = translated;
            localStorage.setItem('translationCache', JSON.stringify(translationCache));
            
            return translated;
        }

        // Translate entire page
        async function translatePage(targetLang) {
            if (targetLang === 'en') {
                location.reload();
                return;
            }

            showTranslationLoading();

            // Get all elements with data-translate attribute
            const elements = document.querySelectorAll('[data-translate]');
            
            // Translate in batches to avoid rate limiting
            const batchSize = 5;
            for (let i = 0; i < elements.length; i += batchSize) {
                const batch = Array.from(elements).slice(i, i + batchSize);
                
                await Promise.all(batch.map(async (element) => {
                    const originalText = element.textContent.trim();
                    if (originalText) {
                        const translatedText = await translateText(originalText, targetLang);
                        element.textContent = translatedText;
                    }
                }));
                
                // Small delay between batches
                await new Promise(resolve => setTimeout(resolve, 200));
            }

            // Translate placeholders
            const inputsWithPlaceholder = document.querySelectorAll('[data-translate-placeholder]');
            for (const input of inputsWithPlaceholder) {
                const originalPlaceholder = input.placeholder;
                const translatedPlaceholder = await translateText(originalPlaceholder, targetLang);
                input.placeholder = translatedPlaceholder;
            }

            hideTranslationLoading();
        }

        // Show/hide translation loading
        function showTranslationLoading() {
            document.getElementById('translationLoading').classList.add('show');
        }

        function hideTranslationLoading() {
            document.getElementById('translationLoading').classList.remove('show');
        }

        // Initialize language modal
        function initLanguageModal() {
            const languageGrid = document.getElementById('languageGrid');
            languageGrid.innerHTML = '';
            
            languages.forEach(lang => {
                const isActive = lang.code === currentLanguage;
                const languageOption = document.createElement('div');
                languageOption.className = `language-option ${isActive ? 'active' : ''}`;
                languageOption.innerHTML = `
                    <div class="language-flag">${lang.flag}</div>
                    <div class="language-info">
                        <div class="language-name">${lang.name}</div>
                        <div class="language-code">${lang.native}</div>
                        ${isActive ? '<div class="current-language">Current</div>' : ''}
                    </div>
                `;
                languageOption.onclick = () => selectLanguage(lang);
                languageGrid.appendChild(languageOption);
            });
            
            // Update button text
            const currentLang = languages.find(lang => lang.code === currentLanguage);
            if (currentLang) {
                document.getElementById('currentLanguage').textContent = currentLang.name.substring(0, 2);
            }
        }

        // Open language modal
        function openLanguageModal(event) {
            event.preventDefault();
            event.stopPropagation();
            const modal = document.getElementById('languageModal');
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
            initLanguageModal();
            
            // Highlight language button
            document.getElementById('languageBtn').classList.add('language-active');
        }

        // Close language modal
        function closeLanguageModal() {
            const modal = document.getElementById('languageModal');
            modal.style.display = 'none';
            document.body.style.overflow = '';
            
            // Remove highlight
            document.getElementById('languageBtn').classList.remove('language-active');
        }

        // Select language
        function selectLanguage(lang) {
            currentLanguage = lang.code;
            localStorage.setItem('selectedLanguage', lang.code);
            
            // Update UI
            document.getElementById('currentLanguage').textContent = lang.name.substring(0, 2);
            
            // Show notification
            showNotification(`Language changed to ${lang.name} (${lang.native})`, 'success');
            
            // Close modal after delay
            setTimeout(closeLanguageModal, 800);
            
            // Update all language options
            document.querySelectorAll('.language-option').forEach(option => {
                option.classList.remove('active');
            });
            event.target.closest('.language-option').classList.add('active');
            
            // Here you would typically call your translation API
            // translatePage(lang.code);
        }

        // Filter languages
        function filterLanguages() {
            const searchTerm = document.getElementById('languageSearch').value.toLowerCase();
            const languageOptions = document.querySelectorAll('.language-option');
            
            languageOptions.forEach(option => {
                const languageName = option.querySelector('.language-name').textContent.toLowerCase();
                const languageNative = option.querySelector('.language-code').textContent.toLowerCase();
                
                if (languageName.includes(searchTerm) || languageNative.includes(searchTerm)) {
                    option.style.display = 'flex';
                } else {
                    option.style.display = 'none';
                }
            });
        }

        // Translation function (placeholder - you'll need to implement actual translation)
        function translatePage(languageCode) {
            // This is where you would integrate with a translation API
            // For now, just log the selected language
            console.log(`Translating page to: ${languageCode}`);
            
            // Example of how you might implement translation:
            // 1. You could use Google Translate API
            // 2. Or implement your own translation dictionary
            // 3. Or use i18n library
        }

        // Notification function
        function showNotification(message, type = 'info') {
            // Use your existing notification system
            if (typeof window.showNotification === 'function') {
                window.showNotification(message, type);
            } else {
                // Fallback notification
                const notification = document.createElement('div');
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: ${type === 'success' ? '#10b981' : '#ef4444'};
                    color: white;
                    padding: 12px 24px;
                    border-radius: 8px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                    z-index: 10001;
                    animation: slideIn 0.3s ease-out;
                `;
                notification.textContent = message;
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.style.animation = 'slideOut 0.3s ease-out';
                    setTimeout(() => notification.remove(), 300);
                }, 3000);
            }
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            const modal = document.getElementById('languageModal');
            if (modal.style.display === 'block' && !e.target.closest('.language-content') && !e.target.closest('#languageBtn')) {
                closeLanguageModal();
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && document.getElementById('languageModal').style.display === 'block') {
                closeLanguageModal();
            }
            
            // Alt + L to open language modal
            if (e.altKey && e.key === 'l') {
                e.preventDefault();
                openLanguageModal(e);
            }
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            initLanguageModal();
            console.log('🌐 Language selector initialized');
        });

        // Keep existing support modal functions
        function openSupportModal(event) {
            event.preventDefault();
            // Your existing support modal code
        }

        function closeSupportModal() {
            // Your existing support modal code
        }

        function contactSupport(type) {
            // Your existing support modal code
        }
    </script>
    
    <script src="<?php echo $base_url; ?>assets/js/main.js"></script>
</body>
</html>