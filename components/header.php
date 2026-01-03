<?php
// require_once 'config.php';
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
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            500: '#16a34a',
                            600: '#15803d',
                            700: '#166534',
                        },
                        accent: {
                            500: '#f59e0b',
                            600: '#d97706',
                        }
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                        'poppins': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* ===== ENHANCED CSS VARIABLES ===== */
        :root {
            /* Enhanced Primary Colors */
            --primary: #16a34a;
            --primary-dark: #15803d;
            --primary-light: #dcfce7;
            --primary-gradient: linear-gradient(90deg, #16a34a, #22c55e, #16a34a);
            --accent: #f59e0b;
            --accent-light: #fef3c7;
            --danger: #ef4444;
            
            /* Enhanced Shadows */
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.15);
            --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.2);
            
            /* Enhanced Transitions */
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-fast: all 0.2s ease;
            --transition-slow: all 0.5s ease;
            
            /* Enhanced Border Radius */
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 20px;
            --radius-xl: 28px;
        }

        /* SVG Icons - No Font Required */
        .announcement-icon {
            width: 20px;
            height: 20px;
            fill: var(--accent-light);
            transition: var(--transition);
            flex-shrink: 0;
            filter: drop-shadow(0 2px 3px rgba(0, 0, 0, 0.2));
        }

        .close-icon {
            width: 14px;
            height: 14px;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* Reset & Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* ===== PREMIUM ANNOUNCEMENT BAR ===== */
        .announcement-bar {
            background: var(--primary-gradient);
            color: white;
            width: 100%;
            position: relative;
            z-index: 1000;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            background-size: 200% 100%;
            animation: gradientShift 3s ease infinite;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transform: translateY(-100%);
            opacity: 0;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        /* Entrance Animation */
        .announcement-bar.show {
            animation: slideDown 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        @keyframes slideDown {
            0% {
                transform: translateY(-100%);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Exit Animation */
        .announcement-bar.hide {
            animation: slideUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        @keyframes slideUp {
            0% {
                transform: translateY(0);
                opacity: 1;
            }
            100% {
                transform: translateY(-100%);
                opacity: 0;
            }
        }

        .announcement-content {
            max-width: 1400px;
            width: 100%;
            padding: 0 20px;
            margin: 0 auto;
            position: relative;
            display: flex;
            align-items: center;
            min-height: 56px;
            gap: 20px;
        }

        /* Enhanced Marquee Container */
        .announcement-marquee {
            flex: 1;
            overflow: hidden;
            position: relative;
            padding: 12px 0;
        }

        .announcement-marquee::before,
        .announcement-marquee::after {
            content: '';
            position: absolute;
            top: 0;
            width: 80px;
            height: 100%;
            z-index: 2;
            pointer-events: none;
        }

        .announcement-marquee::before {
            left: 0;
            background: linear-gradient(90deg, #16a34a 0%, transparent 100%);
        }

        .announcement-marquee::after {
            right: 0;
            background: linear-gradient(90deg, transparent 0%, #16a34a 100%);
        }

        /* Enhanced Marquee Track */
        .marquee-track {
            display: flex;
            gap: 40px;
            animation: marqueeScroll 25s linear infinite;
            width: max-content;
        }

        .announcement-marquee:hover .marquee-track {
            animation-play-state: paused;
        }

        @keyframes marqueeScroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        /* Premium Announcement Items */
        .announcement-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 20px;
            border-radius: var(--radius-xl);
            background: rgba(255, 255, 255, 0.12);
            border: 1.5px solid rgba(255, 255, 255, 0.2);
            transition: var(--transition);
            cursor: pointer;
            flex-shrink: 0;
            backdrop-filter: blur(8px);
            white-space: nowrap;
            position: relative;
            overflow: hidden;
        }

        /* Shine effect on items */
        .announcement-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.7s ease;
        }

        .announcement-item:hover::before {
            left: 100%;
        }

        .announcement-item span {
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        .announcement-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: var(--shadow-sm);
        }

        .announcement-item:hover .announcement-icon {
            transform: scale(1.2) rotate(5deg);
            fill: #ffffff;
        }

        /* Premium Close Button */
        .close-announcement {
            position: relative;
            background: rgba(255, 255, 255, 0.15);
            border: 1.5px solid rgba(255, 255, 255, 0.25);
            color: white;
            font-size: 1.1rem;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: var(--transition);
            flex-shrink: 0;
            z-index: 3;
            backdrop-filter: blur(4px);
            border: none;
            outline: none;
        }

        .close-announcement::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .close-announcement:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: rotate(90deg) scale(1.1);
            border-color: rgba(255, 255, 255, 0.35);
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.1);
        }

        .close-announcement:hover::before {
            opacity: 1;
        }

        /* Notification Badge */
        .notification-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--danger);
            color: white;
            font-size: 0.7rem;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: 12px;
            animation: pulse 2s infinite;
            z-index: 4;
            border: 2px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 3px 10px rgba(239, 68, 68, 0.3);
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 3px 10px rgba(239, 68, 68, 0.3);
            }
            50% {
                transform: scale(1.15);
                box-shadow: 0 5px 15px rgba(239, 68, 68, 0.5);
            }
        }

        /* ===== ENHANCED RESPONSIVE DESIGN ===== */
        @media (max-width: 1200px) {
            .announcement-content {
                padding: 0 16px;
                min-height: 52px;
            }
            .announcement-item {
                padding: 7px 16px;
                gap: 10px;
            }
            .announcement-icon {
                width: 18px;
                height: 18px;
            }
            .announcement-item span {
                font-size: 0.95rem;
            }
            .close-announcement {
                width: 34px;
                height: 34px;
            }
            .close-icon {
                width: 12px;
                height: 12px;
            }
        }

        @media (max-width: 768px) {
            .announcement-bar {
                border-bottom-width: 2px;
            }
            
            .announcement-content {
                padding: 0 12px;
                min-height: 48px;
                gap: 15px;
            }
            
            .announcement-marquee {
                padding: 10px 0;
            }
            
            .announcement-marquee::before,
            .announcement-marquee::after {
                width: 50px;
            }
            
            .marquee-track {
                gap: 25px;
                animation-duration: 20s;
            }
            
            .announcement-item {
                padding: 6px 12px;
                border-radius: var(--radius-lg);
                gap: 8px;
            }
            
            .announcement-icon {
                width: 16px;
                height: 16px;
            }
            
            .announcement-item span {
                font-size: 0.9rem;
            }
            
            .close-announcement {
                width: 30px;
                height: 30px;
            }
            
            .close-icon {
                width: 10px;
                height: 10px;
            }
            
            .notification-badge {
                top: -6px;
                right: -6px;
                font-size: 0.65rem;
                padding: 2px 6px;
            }
        }

        @media (max-width: 480px) {
            .announcement-content {
                padding: 0 10px;
                min-height: 44px;
                gap: 10px;
            }
            
            .announcement-marquee {
                padding: 8px 0;
            }
            
            .announcement-marquee::before,
            .announcement-marquee::after {
                width: 40px;
            }
            
            .marquee-track {
                gap: 15px;
                animation-duration: 15s;
            }
            
            .announcement-item {
                padding: 5px 10px;
                border-radius: var(--radius-md);
                gap: 6px;
            }
            
            .announcement-icon {
                width: 14px;
                height: 14px;
            }
            
            .announcement-item span {
                font-size: 0.85rem;
            }
            
            .close-announcement {
                width: 28px;
                height: 28px;
            }
            
            .close-icon {
                width: 8px;
                height: 8px;
            }
        }

        @media (max-width: 360px) {
            .announcement-content {
                padding: 0 8px;
            }
            
            .marquee-track {
                gap: 10px;
                animation-duration: 12s;
            }
            
            .announcement-item {
                padding: 4px 8px;
                border-radius: var(--radius-sm);
            }
            
            .announcement-item span {
                font-size: 0.8rem;
            }
        }

        /* Reduced Motion Support */
        @media (prefers-reduced-motion: reduce) {
            .announcement-bar,
            .marquee-track,
            .announcement-item,
            .close-announcement,
            .notification-badge {
                animation: none !important;
                transition: none !important;
            }
            
            .announcement-bar {
                background-size: 100% 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Premium Announcement Bar -->
    <div class="announcement-bar" id="announcement">
        <div class="announcement-content">
            <!-- Marquee Container -->
            <div class="announcement-marquee">
                <div class="marquee-track">
                    <!-- Items with SVG icons (FIXED: Icons will be visible) -->
                    <div class="announcement-item">
                        <svg class="announcement-icon" viewBox="0 0 24 24">
                            <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9l1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
                        </svg>
                        <span>FREE Delivery on ₹2000+</span>
                    </div>
                    <div class="announcement-item">
                        <svg class="announcement-icon" viewBox="0 0 24 24">
                            <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/>
                        </svg>
                        <span>100% Organic Certified</span>
                    </div>
                    <div class="announcement-item">
                        <svg class="announcement-icon" viewBox="0 0 24 24">
                            <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                        </svg>
                        <span>Same Day Fresh Delivery</span>
                    </div>
                    <div class="announcement-item">
                        <svg class="announcement-icon" viewBox="0 0 24 24">
                            <path d="M20.38 8.57l-1.23 1.85a8 8 0 0 1-.22 7.58H5.07A8 8 0 0 1 15.58 6.85l1.85-1.23A10 10 0 0 0 3.35 19a2 2 0 0 0 1.72 1h13.85a2 2 0 0 0 1.74-1 10 10 0 0 0-.27-10.44z"/>
                            <path d="M10.59 15.41a2 2 0 0 0 2.83 0l5.66-8.49-8.49 5.66a2 2 0 0 0 0 2.83z"/>
                        </svg>
                        <span>Premium Quality Guaranteed</span>
                    </div>
                    <div class="announcement-item">
                        <svg class="announcement-icon" viewBox="0 0 24 24">
                            <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/>
                        </svg>
                        <span>Farm to Table Freshness</span>
                    </div>
                    <div class="announcement-item">
                        <svg class="announcement-icon" viewBox="0 0 24 24">
                            <path d="M13.5.67s.74 2.65.74 4.8c0 2.06-1.35 3.73-3.41 3.73-2.07 0-3.63-1.67-3.63-3.73l.03-.36C5.21 7.51 4 10.62 4 14c0 4.42 3.58 8 8 8s8-3.58 8-8C20 8.61 17.41 3.8 13.5.67zM11.71 19c-1.78 0-3.22-1.4-3.22-3.14 0-1.62 1.05-2.76 2.81-3.12 1.77-.36 3.6-1.21 4.62-2.58.39 1.29.59 2.65.59 4.04 0 2.65-2.15 4.8-4.8 4.8z"/>
                        </svg>
                        <span>Limited Time Offers</span>
                    </div>
                    
                    <!-- Duplicate for seamless loop -->
                    <div class="announcement-item">
                        <svg class="announcement-icon" viewBox="0 0 24 24">
                            <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9l1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
                        </svg>
                        <span>FREE Delivery on ₹2000+</span>
                    </div>
                    <div class="announcement-item">
                        <svg class="announcement-icon" viewBox="0 0 24 24">
                            <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/>
                        </svg>
                        <span>100% Organic Certified</span>
                    </div>
                    <div class="announcement-item">
                        <svg class="announcement-icon" viewBox="0 0 24 24">
                            <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                        </svg>
                        <span>Same Day Fresh Delivery</span>
                    </div>
                </div>
            </div>

            <!-- Close Button with Notification Badge -->
            <button class="close-announcement" id="closeButton" aria-label="Close announcement" title="Close announcement">
                <svg class="close-icon" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
    </div>

    <!-- FIXED JavaScript -->
    <script>
        (function() {
            'use strict';
            
            // Elements
            const announcement = document.getElementById('announcement');
            const closeButton = document.getElementById('closeButton');
            const marqueeTrack = document.querySelector('.marquee-track');
            
            // Variables
            let autoCloseTimer = null;
            let interactionCount = 0;
            const AUTO_CLOSE_TIME = 1209600; // in seconds
            
            // Storage Key - FIXED: Use cookie instead of sessionStorage
            const STORAGE_KEY = 'ga_announcement_state';
            
            // Initialize
            function init() {
                // Check if announcement was previously closed
            
                // Show announcement with animation
                setTimeout(() => {
                    announcement.classList.add('show');
                }, 100);
                
                // Start auto-close timer
                startAutoCloseTimer();
                
                // Setup event listeners
                setupEventListeners();
            }
            
            // Check if announcement should be hidden (FIXED: Using cookie)
            function shouldHideAnnouncement() {
                try {
                    const cookies = document.cookie.split(';');
                    for (let cookie of cookies) {
                        cookie = cookie.trim();
                        if (cookie.startsWith(STORAGE_KEY + '=')) {
                            const value = cookie.substring(STORAGE_KEY.length + 1);
                            const closedTime = parseInt(value);
                            const now = Date.now();
                            // Show again after 12 hours (43200000 ms)
                            if (now - closedTime < 43200000) {
                                return true;
                            }
                        }
                    }
                } catch (e) {
                    // If cookie fails, continue showing
                }
                return false;
            }
            
            // Save closed state (FIXED: Using cookie)
            function saveClosedState() {
                try {
                    const expires = new Date();
                    expires.setTime(expires.getTime() + (12 * 60 * 60 * 1000)); // 12 hours
                    document.cookie = `${STORAGE_KEY}=${Date.now()}; expires=${expires.toUTCString()}; path=/`;
                } catch (e) {
                    // Silently fail if cookie is blocked
                }
            }
            
            // Start auto-close timer
            function startAutoCloseTimer() {
                clearTimeout(autoCloseTimer);
                autoCloseTimer = setTimeout(() => {
                    closeAnnouncement();
                }, AUTO_CLOSE_TIME);
            }
            
            // Reset auto-close timer
            function resetAutoCloseTimer() {
                startAutoCloseTimer();
                
            }
            
            
            // Close announcement
            function closeAnnouncement() {
                if (!announcement || announcement.classList.contains('hide')) return;
                
                // Add exit animation
                announcement.classList.remove('show');
                announcement.classList.add('hide');
                
                // Save closed state to cookie (FIXED)
                saveClosedState();
                
                // Clear timer
                clearTimeout(autoCloseTimer);
                
                // Hide after animation
                setTimeout(() => {
                    announcement.style.display = 'none';
                }, 500);
            }
            
            // Setup event listeners
            function setupEventListeners() {
                // Close button
                closeButton.addEventListener('click', closeAnnouncement);
                
                // Reset timer on any announcement interaction
                announcement.addEventListener('click', (e) => {
                    if (!e.target.closest('.close-announcement')) {
                        resetAutoCloseTimer();
                    }
                });
                
                // Pause marquee on hover
                const marqueeContainer = document.querySelector('.announcement-marquee');
                marqueeContainer.addEventListener('mouseenter', () => {
                    marqueeTrack.style.animationPlayState = 'paused';
                });
                
                marqueeContainer.addEventListener('mouseleave', () => {
                    marqueeTrack.style.animationPlayState = 'running';
                });
                
                // Keyboard shortcut (ESC)
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') {
                        closeAnnouncement();
                    }
                });
                
                // Touch support for mobile
                announcement.addEventListener('touchstart', resetAutoCloseTimer);
                
                // Handle window resize
                let resizeTimer;
                window.addEventListener('resize', () => {
                    clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(() => {
                        const width = window.innerWidth;
                        if (width < 768) {
                            marqueeTrack.style.animationDuration = '20s';
                        } else if (width < 480) {
                            marqueeTrack.style.animationDuration = '15s';
                        } else {
                            marqueeTrack.style.animationDuration = '25s';
                        }
                    }, 250);
                });
            }
            
            // Start when DOM is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', init);
            } else {
                init();
            }
            
            // Expose close function globally
            window.closeAnnouncement = closeAnnouncement;
            
        })();
    </script>
</body>
</html>