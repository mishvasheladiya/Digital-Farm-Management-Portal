<?php
require_once 'config.php';
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
    <style>
        :root {
            --primary: #16a34a;
            --primary-dark: #15803d;
            --primary-light: #dcfce7;
            --primary-gradient: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
            --secondary: #1f2937;
            --accent: #f59e0b;
            --accent-light: #fef3c7;
            --white: #ffffff;
            --light: #f9fafb;
            --light-gray: #f3f4f6;
            --text-primary: #111827;
            --text-secondary: #374151;
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            --border-radius: 12px;
            --border-radius-lg: 16px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #f0fdf4 0%, #f9fafb 100%);
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .journey-section {
            padding: 5rem 1.5rem;
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .journey-title {
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            font-weight: 800;
            text-align: center;
            margin-bottom: 1rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            z-index: 2;
            line-height: 1.2;
        }

        .journey-subtitle {
            text-align: center;
            max-width: min(700px, 90vw);
            margin: 0 auto 4rem;
            color: var(--text-secondary);
            font-size: clamp(1rem, 2vw, 1.125rem);
            position: relative;
            z-index: 2;
            line-height: 1.6;
            margin-bottom: 0rem;
        }

        .timeline-container {
            max-width: 1200px;
            width: 100%;
            position: relative;
            z-index: 2;
            margin-top: 1rem;
            margin-bottom: 8rem;
        }

        /* Enhanced Timeline with Curved Path */
        .timeline-path {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 400px;
            transform: translateY(-50%);
            z-index: 1;
            overflow: visible;
        }

        .timeline-line {
            fill: none;
            stroke: var(--primary-light);
            stroke-width: 6;
            stroke-dasharray: 10, 6;
        }

        .timeline-fill {
            fill: none;
            stroke: var(--primary);
            stroke-width: 6;
            stroke-dasharray: 1000;
            stroke-dashoffset: 1000;
            animation: drawPath 3s ease-in-out forwards;
        }

        @keyframes drawPath {
            to {
                stroke-dashoffset: 0;
            }
        }

        /* Floating Timeline Items */
        .timeline-items {
            position: relative;
            z-index: 3;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 500px;
        }

        .timeline-item {
            position: absolute;
            width: clamp(200px, 20vw, 240px);
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: var(--transition);
            cursor: pointer;
            animation: float 6s ease-in-out infinite;
        }

        .timeline-item:nth-child(even) {
            animation-delay: 1s;
        }

        .timeline-item:nth-child(3) {
            animation-delay: 2s;
        }

        .timeline-item:nth-child(5) {
            animation-delay: 3s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        .timeline-item.above {
            top: 20%;
        }

        .timeline-item.below {
            top: 65%;
        }

        /* Enhanced Icon Design */
        .timeline-icon {
            width: clamp(70px, 8vw, 90px);
            height: clamp(70px, 8vw, 90px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            background: var(--primary-gradient);
            color: var(--white);
            font-size: clamp(1.5rem, 2.5vw, 2rem);
            box-shadow: var(--shadow-xl);
            transition: var(--transition);
            position: relative;
            z-index: 4;
            border: 4px solid var(--white);
        }

        .timeline-item:hover .timeline-icon {
            transform: scale(1.15) rotate(5deg);
            box-shadow: 0 15px 30px rgba(22, 163, 74, 0.4);
        }

        /* Year Styling */
        .year {
            font-size: clamp(1.5rem, 2vw, 1.75rem);
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 1rem;
            position: relative;
            background: var(--white);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            box-shadow: var(--shadow);
            text-align: center;
            width: fit-content;
        }

        .year::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 3px;
            background: var(--primary);
            border-radius: 2px;
        }

        /* Enhanced Card Design */
        .milestone-card {
            background: var(--white);
            padding: clamp(1rem, 2vw, 1.5rem);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--light-gray);
            transition: var(--transition);
            max-width: 220px;
            text-align: center;
            position: relative;
            backdrop-filter: blur(10px);
            width: 100%;
        }

        .milestone-card::before {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            border-left: 12px solid transparent;
            border-right: 12px solid transparent;
            border-bottom: 12px solid var(--white);
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            filter: drop-shadow(0 -2px 2px rgba(0,0,0,0.05));
        }

        .timeline-item:hover .milestone-card {
            transform: translateY(-10px) scale(1.05);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary-light);
        }

        .milestone-text {
            color: var(--text-secondary);
            font-size: clamp(0.9rem, 1.5vw, 1rem);
            line-height: 1.6;
        }

        /* Background Decorations */
        .bg-decoration {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            z-index: 0;
            animation: pulse 8s ease-in-out infinite;
        }
        
        .decoration-1 {
            width: min(400px, 40vw);
            height: min(400px, 40vw);
            background: var(--primary);
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }
        
        .decoration-2 {
            width: min(300px, 30vw);
            height: min(300px, 30vw);
            background: var(--accent);
            bottom: 10%;
            right: 5%;
            animation-delay: 2s;
        }
        
        .decoration-3 {
            width: min(200px, 20vw);
            height: min(200px, 20vw);
            background: var(--primary);
            top: 50%;
            left: 10%;
            animation-delay: 4s;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 0.1;
            }
            50% {
                transform: scale(1.1);
                opacity: 0.15;
            }
        }

        /* Particle Effects */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            background: var(--primary);
            border-radius: 50%;
            opacity: 0.3;
            animation: floatParticle 15s linear infinite;
        }

        @keyframes floatParticle {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.3;
            }
            90% {
                opacity: 0.3;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Enhanced Responsive Design */
        @media (max-width: 1200px) {
            .timeline-container {
                min-height: 700px;
            }
            
            .timeline-path {
                height: 450px;
            }
            
            .timeline-items {
                height: 450px;
            }
            
            .timeline-item {
                width: clamp(180px, 18vw, 220px);
            }
        }

        @media (max-width: 1024px) {
            .timeline-container {
                min-height: 800px;
            }
            
            .timeline-path {
                height: 500px;
            }
            
            .timeline-items {
                height: 500px;
            }
            
            .timeline-item {
                width: clamp(160px, 16vw, 200px);
            }
            
            .timeline-item.above {
                top: 15%;
            }
            
            .timeline-item.below {
                top: 70%;
            }
        }

        @media (max-width: 768px) {
            .journey-section {
                padding: 3rem 1rem;
                min-height: auto;
            }
            
            .journey-title {
                font-size: 2.25rem;
            }
            
            .timeline-path {
                display: none;
            }
            
            .timeline-items {
                flex-direction: column;
                gap: 3rem;
                height: auto;
                padding: 2rem 0;
            }
            
            .timeline-item {
                position: static;
                width: 100%;
                max-width: 400px;
                animation: none !important;
                margin-bottom: 2rem;
            }
            
            .timeline-item:hover .timeline-icon {
                transform: scale(1.1) rotate(5deg);
            }
            
            .timeline-item:hover .milestone-card {
                transform: translateY(-5px) scale(1.02);
            }
            
            .timeline-icon {
                width: 80px;
                height: 80px;
                font-size: 1.75rem;
            }
            
            .milestone-card {
                max-width: 100%;
            }
            
            .bg-decoration {
                display: none;
            }
        }

        @media (max-width: 640px) {
            .journey-section {
                padding: 2rem 1rem;
            }
            
            .journey-title {
                font-size: 2rem;
                margin-bottom: 0.5rem;
            }
            
            .journey-subtitle {
                margin-bottom: 3rem;
                font-size: 1rem;
            }
            
            .timeline-items {
                gap: 2rem;
            }
            
            .timeline-item {
                margin-bottom: 1rem;
            }
            
            .timeline-icon {
                width: 70px;
                height: 70px;
                font-size: 1.5rem;
            }
            
            .year {
                font-size: 1.5rem;
            }
            
            .milestone-card {
                padding: 1.25rem;
            }
        }

        @media (max-width: 480px) {
            .journey-title {
                font-size: 1.75rem;
            }
            
            .journey-subtitle {
                font-size: 0.95rem;
                margin-bottom: 2.5rem;
            }
            
            .timeline-icon {
                width: 60px;
                height: 60px;
                font-size: 1.25rem;
                margin-bottom: 1rem;
            }
            
            .year {
                font-size: 1.25rem;
                margin-bottom: 0.75rem;
            }
            
            .milestone-text {
                font-size: 0.9rem;
            }
            
            .timeline-items {
                gap: 1.5rem;
            }
        }

        @media (max-width: 360px) {
            .journey-section {
                padding: 1.5rem 0.5rem;
            }
            
            .journey-title {
                font-size: 1.5rem;
            }
            
            .timeline-icon {
                width: 55px;
                height: 55px;
                font-size: 1.1rem;
            }
            
            .year {
                font-size: 1.1rem;
                padding: 0.4rem 0.8rem;
            }
            
            .milestone-card {
                padding: 1rem;
            }
        }

        /* Touch device optimizations */
        @media (hover: none) and (pointer: coarse) {
            .timeline-item {
                animation: none;
            }
            
            .timeline-item:active .timeline-icon {
                transform: scale(1.1) rotate(5deg);
            }
            
            .timeline-item:active .milestone-card {
                transform: translateY(-5px) scale(1.02);
            }
        }

        /* Animation for items */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .timeline-item {
            animation: fadeInUp 0.8s ease-out forwards, float 6s ease-in-out infinite;
            opacity: 0;
        }

        .timeline-item:nth-child(1) { animation-delay: 0.2s; }
        .timeline-item:nth-child(2) { animation-delay: 0.4s; }
        .timeline-item:nth-child(3) { animation-delay: 0.6s; }
        .timeline-item:nth-child(4) { animation-delay: 0.8s; }
        .timeline-item:nth-child(5) { animation-delay: 1s; }
        .timeline-item:nth-child(6) { animation-delay: 1.2s; }

        /* Interactive Cursor Effect */
        .cursor-follower {
            position: fixed;
            width: 20px;
            height: 20px;
            background: var(--primary);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            mix-blend-mode: difference;
            transition: transform 0.1s;
        }

        /* Hide cursor on touch devices */
        @media (hover: none) and (pointer: coarse) {
            .cursor-follower {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Custom Cursor -->
    <div class="cursor-follower"></div>

    <section class="journey-section">
        <!-- Background Decorations -->
        <div class="bg-decoration decoration-1"></div>
        <div class="bg-decoration decoration-2"></div>
        <div class="bg-decoration decoration-3"></div>
        
        <!-- Particle Effects -->
        <div class="particles" id="particles"></div>
        
        <h2 class="journey-title">Our Journey</h2>
        <p class="journey-subtitle">
            Follow our incredible journey through innovation, growth, and global expansion in the Ag-Tech industry.
        </p>

        <div class="timeline-container">
            <!-- Curved Timeline Path -->
            <svg class="timeline-path" viewBox="0 0 1200 400" preserveAspectRatio="none">
                <path class="timeline-line" d="M 50 300 
                    C 300 300, 300 100, 550 100 
                    C 800 100, 800 300, 1050 300 
                    C 1150 300, 1150 200, 1150 200" />
                <path class="timeline-fill" d="M 50 300 
                    C 300 300, 300 100, 550 100 
                    C 800 100, 800 300, 1050 300 
                    C 1150 300, 1150 200, 1150 200" />
            </svg>

            <div class="timeline-items">
                <!-- 2020 -->
                <div class="timeline-item above" style="left: 8%;">
                    <div class="timeline-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3 class="year">2020</h3>
                    <div class="milestone-card">
                        <p class="milestone-text">Started operations with an innovative Ag-Tech vision.</p>
                    </div>
                </div>

                <!-- 2021 -->
                <div class="timeline-item below" style="left: 23%;">
                    <div class="timeline-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 class="year">2021</h3>
                    <div class="milestone-card">
                        <p class="milestone-text">Launched smart farming solutions across India.</p>
                    </div>
                </div>

                <!-- 2022 -->
                <div class="timeline-item above" style="left: 38%;">
                    <div class="timeline-icon">
                        <i class="fas fa-globe-asia"></i>
                    </div>
                    <h3 class="year">2022</h3>
                    <div class="milestone-card">
                        <p class="milestone-text">Expanded to Asia & introduced IoT-based crop monitoring.</p>
                    </div>
                </div>

                <!-- 2023 -->
                <div class="timeline-item below" style="left: 53%;">
                    <div class="timeline-icon">
                        <i class="fas fa-microchip"></i>
                    </div>
                    <h3 class="year">2023</h3>
                    <div class="milestone-card">
                        <p class="milestone-text">Achieved major milestone of 5M+ device installations.</p>
                    </div>
                </div>

                <!-- 2024 -->
                <div class="timeline-item above" style="left: 68%;">
                    <div class="timeline-icon">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h3 class="year">2024</h3>
                    <div class="milestone-card">
                        <p class="milestone-text">Launched AI-powered farm automation tools.</p>
                    </div>
                </div>

                <!-- 2025 -->
                <div class="timeline-item below" style="left: 83%;">
                    <div class="timeline-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h3 class="year">2025</h3>
                    <div class="milestone-card">
                        <p class="milestone-text">Started global expansion & became Ag-Tech leader.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const timelineItems = document.querySelectorAll('.timeline-item');
            const cursorFollower = document.querySelector('.cursor-follower');
            const particlesContainer = document.getElementById('particles');
            
            // Create particle effects
            function createParticles() {
                const particleCount = 30;
                
                for (let i = 0; i < particleCount; i++) {
                    const particle = document.createElement('div');
                    particle.classList.add('particle');
                    
                    // Random properties
                    const size = Math.random() * 10 + 5;
                    const left = Math.random() * 100;
                    const animationDuration = Math.random() * 20 + 10;
                    const animationDelay = Math.random() * 10;
                    const color = Math.random() > 0.5 ? 'var(--primary)' : 'var(--accent)';
                    
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    particle.style.left = `${left}%`;
                    particle.style.background = color;
                    particle.style.animationDuration = `${animationDuration}s`;
                    particle.style.animationDelay = `${animationDelay}s`;
                    
                    particlesContainer.appendChild(particle);
                }
            }
            
            // Custom cursor effect (only for non-touch devices)
            if (window.matchMedia("(hover: hover) and (pointer: fine)").matches) {
                document.addEventListener('mousemove', (e) => {
                    cursorFollower.style.left = e.clientX + 'px';
                    cursorFollower.style.top = e.clientY + 'px';
                });
                
                // Hover effects for timeline items
                timelineItems.forEach(item => {
                    item.addEventListener('mouseenter', () => {
                        cursorFollower.style.transform = 'scale(2)';
                        cursorFollower.style.background = 'var(--accent)';
                    });
                    
                    item.addEventListener('mouseleave', () => {
                        cursorFollower.style.transform = 'scale(1)';
                        cursorFollower.style.background = 'var(--primary)';
                    });
                });
            }
            
            // Click/touch interactions
            timelineItems.forEach(item => {
                item.addEventListener('click', function() {
                    const year = this.querySelector('.year').textContent;
                    const text = this.querySelector('.milestone-text').textContent;
                    
                    // Create a ripple effect
                    const ripple = document.createElement('div');
                    ripple.style.position = 'absolute';
                    ripple.style.borderRadius = '50%';
                    ripple.style.background = 'rgba(22, 163, 74, 0.3)';
                    ripple.style.transform = 'scale(0)';
                    ripple.style.animation = 'ripple 0.6s linear';
                    
                    const icon = this.querySelector('.timeline-icon');
                    const rect = icon.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height) * 2;
                    
                    ripple.style.width = `${size}px`;
                    ripple.style.height = `${size}px`;
                    ripple.style.left = `${rect.left + rect.width/2 - size/2}px`;
                    ripple.style.top = `${rect.top + rect.height/2 - size/2}px`;
                    
                    document.body.appendChild(ripple);
                    
                    // Remove ripple after animation
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                    
                    // Show alert with details
                    setTimeout(() => {
                        alert(`Year: ${year}\n\n${text}`);
                    }, 300);
                });
            });
            
            // Intersection Observer for animation triggers
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                    }
                });
            }, { 
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });
            
            timelineItems.forEach(item => {
                observer.observe(item);
            });
            
            // Initialize particles
            createParticles();
            
            // Add ripple animation to styles
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(2.5);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);

            // Handle window resize for better responsiveness
            let resizeTimer;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function() {
                    // Re-initialize animations on resize
                    timelineItems.forEach(item => {
                        if (item.getBoundingClientRect().top < window.innerHeight) {
                            item.style.opacity = 1;
                        }
                    });
                }, 250);
            });
        });
    </script>
</body>
</html>