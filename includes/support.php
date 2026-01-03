<?php
require_once './../config.php';
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support - <?php echo SITE_NAME; ?> | <?php echo SITE_TAGLINE; ?></title>
    
    <!-- CSS & Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        },
                        accent: {
                            50: '#fefce8',
                            100: '#fef9c3',
                            200: '#fef08a',
                            300: '#fde047',
                            400: '#facc15',
                            500: '#eab308',
                            600: '#ca8a04',
                            700: '#a16207',
                            800: '#854d0e',
                            900: '#713f12',
                        }
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-glow': 'pulse-glow 2s ease-in-out infinite',
                        'slide-up': 'slide-up 0.5s ease-out',
                        'slide-down': 'slide-down 0.5s ease-out',
                        'fade-in': 'fade-in 0.6s ease-out',
                        'bounce-subtle': 'bounce-subtle 2s infinite',
                        'shimmer': 'shimmer 2.5s infinite',
                    },
                    keyframes: {
                        'float': {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        'pulse-glow': {
                            '0%, 100%': { opacity: 1 },
                            '50%': { opacity: 0.7 },
                        },
                        'slide-up': {
                            '0%': { transform: 'translateY(20px)', opacity: 0 },
                            '100%': { transform: 'translateY(0)', opacity: 1 },
                        },
                        'slide-down': {
                            '0%': { transform: 'translateY(-20px)', opacity: 0 },
                            '100%': { transform: 'translateY(0)', opacity: 1 },
                        },
                        'fade-in': {
                            '0%': { opacity: 0 },
                            '100%': { opacity: 1 },
                        },
                        'bounce-subtle': {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-5px)' },
                        },
                        'shimmer': {
                            '0%': { backgroundPosition: '-500px 0' },
                            '100%': { backgroundPosition: '500px 0' },
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.15) 0%, rgba(16, 163, 74, 0.1) 100%);
        }
        
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #e5e7eb;
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: #22c55e;
        }
        
        .chat-bubble-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        .glow-effect {
            box-shadow: 0 0 40px rgba(34, 197, 94, 0.2);
        }
        
        .gradient-border {
            position: relative;
            background: linear-gradient(white, white) padding-box,
                        linear-gradient(135deg, #22c55e, #16a34a) border-box;
            border: 2px solid transparent;
        }
        
        .stat-card-gradient {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
        }
        
        .emergency-gradient {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }
        
        .knowledge-base-gradient {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }
        
        .phone-gradient {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }
        
        .email-gradient {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        }
        
        .typewriter {
            overflow: hidden;
            border-right: 3px solid #22c55e;
            white-space: nowrap;
            animation: typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite;
        }
        
        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }
        
        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: #22c55e }
        }
        
        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s cubic-bezier(0, 1, 0, 1);
        }
        
        .faq-answer.open {
            max-height: 1000px;
            transition: max-height 1s ease-in-out;
        }
        
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #22c55e;
            border-radius: 10px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #16a34a;
        }
        
        .shimmer {
            background: linear-gradient(90deg, 
                rgba(255,255,255,0) 0%, 
                rgba(255,255,255,0.8) 50%, 
                rgba(255,255,255,0) 100%);
            background-size: 200% 100%;
            animation: shimmer 2.5s infinite;
        }
        
        .feature-icon {
            transition: all 0.3s ease;
        }
        
        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }
        
        .agent-card {
            position: relative;
            overflow: hidden;
        }
        
        .agent-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #22c55e, #16a34a);
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        
        .agent-card:hover::before {
            transform: translateX(0);
        }
        
        .pulse-ring {
            animation: pulse-ring 2s infinite;
        }
        
        @keyframes pulse-ring {
            0% { transform: scale(0.8); opacity: 0.8; }
            50% { transform: scale(1.2); opacity: 0.4; }
            100% { transform: scale(0.8); opacity: 0.8; }
        }
        
        .floating-button {
            animation: float 3s ease-in-out infinite, pulse-glow 2s ease-in-out infinite;
        }
        
        .contact-form-input:focus {
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
            border-color: #22c55e;
        }
    </style>
</head>
<body class="font-inter bg-gray-50 text-gray-800">
    <!-- Header -->
    <?php include '../Components/header.php'; ?>

    <!-- Navbar -->
    <?php include '../Components/navbar.php'; ?>

    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section class="relative overflow-hidden hero-gradient pt-24 pb-20 md:pt-32 md:pb-28">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%2316a34a" fill-opacity="0.4"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            </div>
            
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="max-w-7xl mx-auto">
                    <div class="text-center mb-16 animate-fade-in">
                        <div class="inline-flex items-center bg-white px-4 py-2 rounded-full shadow-md mb-8 animate-slide-down">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                            <span class="text-sm font-medium text-gray-700">24/7 Support Available</span>
                        </div>
                        
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black mb-6 leading-tight">
                            <span class="block">We're Here to</span>
                            <span class="gradient-text">Help You Grow</span>
                        </h1>
                        
                        <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto mb-10 leading-relaxed">
                            Get instant support from our team of agricultural experts. Whether you need technical help, 
                            farming advice, or platform assistance, we're just a click away.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                            <a href="#contact" 
                               class="group relative overflow-hidden bg-gradient-to-r from-green-500 to-green-600 text-white px-8 py-4 rounded-xl font-semibold text-lg shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                                <span class="relative z-10 flex items-center">
                                    <i class="fas fa-headset mr-3"></i>
                                    Get Support Now
                                </span>
                                <div class="absolute inset-0 shimmer"></div>
                            </a>
                            
                            <a href="#solutions" 
                               class="group border-2 border-green-500 text-green-600 hover:bg-green-50 px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-300 hover:-translate-y-1">
                                <span class="flex items-center">
                                    <i class="fas fa-lightbulb mr-3"></i>
                                    Quick Solutions
                                </span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto animate-slide-up">
                        <div class="bg-white rounded-2xl p-6 shadow-lg text-center border border-gray-100">
                            <div class="text-3xl font-bold text-green-600 mb-2">24/7</div>
                            <div class="text-sm text-gray-600 font-medium">Availability</div>
                        </div>
                        
                        <div class="bg-white rounded-2xl p-6 shadow-lg text-center border border-gray-100">
                            <div class="text-3xl font-bold text-green-600 mb-2">2 min</div>
                            <div class="text-sm text-gray-600 font-medium">Avg Response</div>
                        </div>
                        
                        <div class="bg-white rounded-2xl p-6 shadow-lg text-center border border-gray-100">
                            <div class="text-3xl font-bold text-green-600 mb-2">98%</div>
                            <div class="text-sm text-gray-600 font-medium">Satisfaction</div>
                        </div>
                        
                        <div class="bg-white rounded-2xl p-6 shadow-lg text-center border border-gray-100">
                            <div class="text-3xl font-bold text-green-600 mb-2">250+</div>
                            <div class="text-sm text-gray-600 font-medium">Farmers Helped</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Floating Elements -->
            <div class="absolute top-1/4 left-10 w-72 h-72 bg-green-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float"></div>
            <div class="absolute bottom-1/4 right-10 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float" style="animation-delay: 1s;"></div>
        </section>

        <!-- Quick Help Cards -->
        <section id="solutions" class="py-20 bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-6xl mx-auto">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                            How Can We <span class="gradient-text">Help You Today?</span>
                        </h2>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                            Choose the support option that works best for you
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <!-- Live Chat -->
                        <div class="group card-hover bg-white rounded-2xl p-8 text-center relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-20 h-20 bg-green-50 rounded-bl-3xl transition-all duration-300 group-hover:bg-green-100"></div>
                            
                            <div class="feature-icon w-20 h-20 stat-card-gradient rounded-2xl flex items-center justify-center mb-6 mx-auto shadow-lg group-hover:shadow-xl">
                                <i class="fas fa-comments text-3xl text-white"></i>
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Live Chat</h3>
                            <p class="text-gray-600 mb-6">
                                Instant chat with our support team. Get real-time solutions to your problems.
                            </p>
                            
                            <div class="space-y-4">
                                <div class="flex items-center justify-center text-sm text-gray-500">
                                    <i class="fas fa-clock mr-2 text-green-500"></i>
                                    <span>Average response: 2 minutes</span>
                                </div>
                                <button onclick="openLiveChat()" 
                                        class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                                    Start Chat
                                </button>
                            </div>
                        </div>

                        <!-- Phone Support -->
                        <div class="group card-hover bg-white rounded-2xl p-8 text-center relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-20 h-20 bg-blue-50 rounded-bl-3xl transition-all duration-300 group-hover:bg-blue-100"></div>
                            
                            <div class="feature-icon w-20 h-20 phone-gradient rounded-2xl flex items-center justify-center mb-6 mx-auto shadow-lg group-hover:shadow-xl">
                                <i class="fas fa-phone-alt text-3xl text-white"></i>
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Phone Support</h3>
                            <p class="text-gray-600 mb-6">
                                Speak directly with our farming experts for personalized assistance.
                            </p>
                            
                            <div class="space-y-4">
                                <div class="flex items-center justify-center text-sm text-gray-500">
                                    <i class="fas fa-clock mr-2 text-blue-500"></i>
                                    <span>Available: 6AM - 10PM IST</span>
                                </div>
                                <a href="tel:+9118001234567" 
                                   class="block w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                                    Call Now
                                </a>
                            </div>
                        </div>

                        <!-- Email Support -->
                        <div class="group card-hover bg-white rounded-2xl p-8 text-center relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-20 h-20 bg-cyan-50 rounded-bl-3xl transition-all duration-300 group-hover:bg-cyan-100"></div>
                            
                            <div class="feature-icon w-20 h-20 email-gradient rounded-2xl flex items-center justify-center mb-6 mx-auto shadow-lg group-hover:shadow-xl">
                                <i class="fas fa-envelope text-3xl text-white"></i>
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Email Support</h3>
                            <p class="text-gray-600 mb-6">
                                Send detailed queries and receive comprehensive written solutions.
                            </p>
                            
                            <div class="space-y-4">
                                <div class="flex items-center justify-center text-sm text-gray-500">
                                    <i class="fas fa-clock mr-2 text-cyan-500"></i>
                                    <span>Response within: 4 hours</span>
                                </div>
                                <a href="mailto:support@agrisync.com" 
                                   class="block w-full bg-gradient-to-r from-cyan-500 to-cyan-600 text-white py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                                    Send Email
                                </a>
                            </div>
                        </div>

                        <!-- Knowledge Base -->
                        <div class="group card-hover bg-white rounded-2xl p-8 text-center relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-20 h-20 bg-purple-50 rounded-bl-3xl transition-all duration-300 group-hover:bg-purple-100"></div>
                            
                            <div class="feature-icon w-20 h-20 knowledge-base-gradient rounded-2xl flex items-center justify-center mb-6 mx-auto shadow-lg group-hover:shadow-xl">
                                <i class="fas fa-book-open text-3xl text-white"></i>
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Knowledge Base</h3>
                            <p class="text-gray-600 mb-6">
                                Self-help articles, guides, and tutorials for common questions.
                            </p>
                            
                            <div class="space-y-4">
                                <div class="flex items-center justify-center text-sm text-gray-500">
                                    <i class="fas fa-file-alt mr-2 text-purple-500"></i>
                                    <span>250+ articles available</span>
                                </div>
                                <a href="#knowledge-base" 
                                   class="block w-full bg-gradient-to-r from-purple-500 to-purple-600 text-white py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                                    Browse Articles
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-20 bg-gray-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                            Frequently Asked <span class="gradient-text">Questions</span>
                        </h2>
                        <p class="text-lg text-gray-600">
                            Quick answers to common questions about <?php echo SITE_NAME; ?>
                        </p>
                    </div>
                    
                    <div class="space-y-4">
                        <?php
                        $faqs = [
                            [
                                'question' => 'How do I create an account?',
                                'answer' => 'Creating an account is simple and free! Click the "Sign Up" button on the top right corner, fill in your details (name, phone number, location), and verify your phone number via OTP. You\'ll have immediate access to all features.',
                                'icon' => 'user-plus'
                            ],
                            [
                                'question' => 'Is the platform really free forever?',
                                'answer' => 'Yes! ' . SITE_NAME . ' is completely free forever. We\'re backed by agricultural initiatives and government support to ensure every farmer in India has access to modern farming tools without any cost. There are no hidden charges or premium tiers.',
                                'icon' => 'tag'
                            ],
                            [
                                'question' => 'How accurate are the weather predictions?',
                                'answer' => 'Our weather forecasts are 92% accurate for the next 48 hours and 85% accurate for the next 7 days. We use data from multiple sources including IMD, NOAA, and local weather stations. For hyper-local accuracy, we also consider micro-climate factors specific to farming regions.',
                                'icon' => 'cloud-sun'
                            ],
                            [
                                'question' => 'Which languages are supported for translation?',
                                'answer' => 'We support 12 Indian languages: हिन्दी (Hindi), বাংলা (Bengali), తెలుగు (Telugu), मराठी (Marathi), தமிழ் (Tamil), ગુજરાતી (Gujarati), ಕನ್ನಡ (Kannada), മലയാളം (Malayalam), ଓଡ଼ିଆ (Odia), ਪੰਜਾਬੀ (Punjabi), संस्कृतम् (Sanskrit), and असमिया (Assamese).',
                                'icon' => 'language'
                            ],
                            [
                                'question' => 'Can I use the app without internet?',
                                'answer' => 'Yes! Our mobile app has offline functionality for key features. You can access saved market prices, crop information, and use the language translator offline. Weather updates and real-time market prices require internet connection, but all data syncs automatically when you\'re back online.',
                                'icon' => 'wifi'
                            ]
                        ];
                        
                        foreach ($faqs as $index => $faq):
                        ?>
                        <div class="faq-item bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <button class="faq-question w-full p-6 text-left flex items-center justify-between hover:bg-gray-50 transition-colors duration-200"
                                    onclick="toggleFaq(<?php echo $index; ?>)">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-<?php echo $faq['icon']; ?> text-green-600"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900"><?php echo $faq['question']; ?></h3>
                                </div>
                                <i class="fas fa-chevron-down text-gray-400 transition-transform duration-300" id="faq-icon-<?php echo $index; ?>"></i>
                            </button>
                            <div class="faq-answer" id="faq-answer-<?php echo $index; ?>">
                                <div class="p-6 pt-0">
                                    <div class="pl-14">
                                        <p class="text-gray-600 leading-relaxed"><?php echo $faq['answer']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="text-center mt-12">
                        <p class="text-gray-600 mb-6">
                            Still have questions? We're here to help!
                        </p>
                        <a href="#contact" 
                           class="inline-flex items-center bg-gradient-to-r from-green-500 to-green-600 text-white px-8 py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                            <i class="fas fa-question-circle mr-3"></i>
                            Ask Your Question
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="py-20 bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-6xl mx-auto">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                            Get in <span class="gradient-text">Touch</span>
                        </h2>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                            Fill out the form below and we'll get back to you as soon as possible
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                        <!-- Contact Form -->
                        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Send us a Message</h3>
                            
                            <form id="supportForm" class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Full Name *
                                        </label>
                                        <input type="text" 
                                               required
                                               class="contact-form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none transition-all duration-200"
                                               placeholder="Enter your name">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Phone Number *
                                        </label>
                                        <input type="tel" 
                                               required
                                               class="contact-form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none transition-all duration-200"
                                               placeholder="Enter your phone number">
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Email Address
                                    </label>
                                    <input type="email" 
                                           class="contact-form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none transition-all duration-200"
                                           placeholder="Enter your email">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Issue Category *
                                    </label>
                                    <select required
                                            class="contact-form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none transition-all duration-200">
                                        <option value="">Select a category</option>
                                        <option value="account">Account Issues</option>
                                        <option value="technical">Technical Problems</option>
                                        <option value="features">Feature Questions</option>
                                        <option value="market">Market Price Issues</option>
                                        <option value="weather">Weather Forecast</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Message *
                                    </label>
                                    <textarea rows="5" 
                                              required
                                              class="contact-form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none transition-all duration-200"
                                              placeholder="Describe your issue in detail..."></textarea>
                                </div>
                                
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           id="urgent"
                                           class="w-5 h-5 text-green-600 rounded focus:ring-green-500 focus:ring-offset-0">
                                    <label for="urgent" class="ml-3 text-sm text-gray-700">
                                        This is an urgent issue requiring immediate attention
                                    </label>
                                </div>
                                
                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-4 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Send Message
                                </button>
                            </form>
                        </div>
                        
                        <!-- Contact Info & Team -->
                        <div class="space-y-8">
                            <!-- Contact Info Cards -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-gradient-to-br from-green-50 to-white rounded-2xl p-6 border border-green-100">
                                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
                                        <i class="fas fa-map-marker-alt text-green-600 text-xl"></i>
                                    </div>
                                    <h4 class="font-bold text-gray-900 mb-2">Office Address</h4>
                                    <p class="text-gray-600 text-sm">
                                        Agricultural Technology Park<br>
                                        Sector 62, Noida<br>
                                        Uttar Pradesh 201309
                                    </p>
                                </div>
                                
                                <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl p-6 border border-blue-100">
                                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
                                        <i class="fas fa-phone-alt text-blue-600 text-xl"></i>
                                    </div>
                                    <h4 class="font-bold text-gray-900 mb-2">Phone Numbers</h4>
                                    <p class="text-gray-600 text-sm">
                                        Toll-Free: 1800-123-4567<br>
                                        Direct: +91-11-23456789
                                    </p>
                                </div>
                                
                                <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl p-6 border border-purple-100">
                                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                                        <i class="fas fa-envelope text-purple-600 text-xl"></i>
                                    </div>
                                    <h4 class="font-bold text-gray-900 mb-2">Email Address</h4>
                                    <p class="text-gray-600 text-sm">
                                        support@<?php echo strtolower(str_replace(' ', '', SITE_NAME)); ?>.com<br>
                                        help@<?php echo strtolower(str_replace(' ', '', SITE_NAME)); ?>.com
                                    </p>
                                </div>
                                
                                <div class="bg-gradient-to-br from-yellow-50 to-white rounded-2xl p-6 border border-yellow-100">
                                    <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center mb-4">
                                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                                    </div>
                                    <h4 class="font-bold text-gray-900 mb-2">Support Hours</h4>
                                    <p class="text-gray-600 text-sm">
                                        Live Chat: 24/7<br>
                                        Phone: 6 AM - 10 PM<br>
                                        Email: Response within 4 hours
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Support Team -->
                            <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl p-6 border border-gray-100">
                                <h4 class="text-xl font-bold text-gray-900 mb-6">Our Support Team</h4>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="agent-card bg-white rounded-xl p-4 border border-gray-100">
                                        <div class="flex items-center">
                                            <div class="relative">
                                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                                    <span class="text-green-600 font-bold">RK</span>
                                                </div>
                                                <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                                            </div>
                                            <div class="ml-3">
                                                <h5 class="font-semibold text-gray-900 text-sm">Rajesh Kumar</h5>
                                                <p class="text-green-600 text-xs font-medium">Agricultural Expert</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="agent-card bg-white rounded-xl p-4 border border-gray-100">
                                        <div class="flex items-center">
                                            <div class="relative">
                                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <span class="text-blue-600 font-bold">PS</span>
                                                </div>
                                                <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                                            </div>
                                            <div class="ml-3">
                                                <h5 class="font-semibold text-gray-900 text-sm">Priya Sharma</h5>
                                                <p class="text-blue-600 text-xs font-medium">Technical Support</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Emergency Banner -->
        <section class="py-16 bg-gradient-to-r from-red-500 via-red-600 to-red-700">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center">
                    <div class="inline-flex items-center bg-white/20 backdrop-blur-sm px-6 py-3 rounded-full mb-8">
                        <i class="fas fa-exclamation-triangle mr-3 text-white text-xl"></i>
                        <span class="text-white font-bold text-lg">Emergency Support</span>
                    </div>
                    
                    <h3 class="text-3xl font-bold text-white mb-6">
                        Need Immediate Assistance?
                    </h3>
                    
                    <p class="text-white/90 text-lg mb-10 max-w-2xl mx-auto">
                        For urgent farming-related emergencies or critical issues affecting your crops
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-6 justify-center">
                        <a href="tel:+9118001234567" 
                           class="group bg-white text-red-600 px-8 py-4 rounded-xl font-bold text-lg shadow-2xl hover:shadow-3xl transition-all duration-300 hover:-translate-y-1">
                            <i class="fas fa-phone-alt mr-3"></i>
                            Call Emergency Hotline
                        </a>
                        
                        <button onclick="openEmergencyChat()" 
                                class="group bg-red-800 text-white px-8 py-4 rounded-xl font-bold text-lg shadow-2xl hover:shadow-3xl transition-all duration-300 hover:-translate-y-1">
                            <i class="fas fa-comment-medical mr-3"></i>
                            Start Emergency Chat
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Live Chat Bubble -->
    <div class="fixed bottom-8 right-8 z-50">
        <button onclick="openLiveChat()" 
                class="floating-button w-16 h-16 stat-card-gradient text-white rounded-full shadow-2xl flex items-center justify-center hover:shadow-3xl transition-all duration-300">
            <i class="fas fa-comment-dots text-2xl"></i>
            <span class="absolute -top-1 -right-1 w-6 h-6 bg-red-500 text-white text-xs rounded-full flex items-center justify-center font-bold">
                3
            </span>
        </button>
    </div>

    <!-- Chat Modal -->
    <div id="chatModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeChat()"></div>
        
        <div class="absolute bottom-0 right-0 w-full md:w-96 h-[80vh] md:h-[600px] bg-white rounded-t-2xl md:rounded-2xl shadow-2xl overflow-hidden">
            <!-- Chat Header -->
            <div class="stat-card-gradient p-6 text-white">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="relative">
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-headset text-xl"></i>
                            </div>
                            <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 rounded-full border-2 border-white"></div>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Live Chat</h3>
                            <p class="text-sm opacity-90">Online now</p>
                        </div>
                    </div>
                    <button onclick="closeChat()" 
                            class="text-white hover:text-gray-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <div class="flex items-center text-sm">
                    <div class="flex items-center mr-4">
                        <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                        <span>Typically replies in 2 minutes</span>
                    </div>
                </div>
            </div>
            
            <!-- Chat Messages -->
            <div id="chatMessages" class="flex-1 p-4 overflow-y-auto custom-scrollbar">
                <!-- Messages will be dynamically added here -->
            </div>
            
            <!-- Chat Input -->
            <div class="border-t border-gray-200 p-4">
                <div class="flex items-center">
                    <input type="text" 
                           id="chatInput"
                           placeholder="Type your message..."
                           class="flex-1 px-4 py-3 border border-gray-300 rounded-l-xl focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200"
                           onkeypress="if(event.key === 'Enter') sendMessage()">
                    <button onclick="sendMessage()" 
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-r-xl transition-colors">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include '../Components/footer.php'; ?>

    <script>
        // FAQ Toggle Function
        function toggleFaq(index) {
            const answer = document.getElementById(`faq-answer-${index}`);
            const icon = document.getElementById(`faq-icon-${index}`);
            
            answer.classList.toggle('open');
            icon.classList.toggle('fa-chevron-down');
            icon.classList.toggle('fa-chevron-up');
            
            // Close other FAQs
            document.querySelectorAll('.faq-item').forEach((item, i) => {
                if (i !== index) {
                    const otherAnswer = document.getElementById(`faq-answer-${i}`);
                    const otherIcon = document.getElementById(`faq-icon-${i}`);
                    if (otherAnswer && otherIcon) {
                        otherAnswer.classList.remove('open');
                        otherIcon.classList.remove('fa-chevron-up');
                        otherIcon.classList.add('fa-chevron-down');
                    }
                }
            });
        }

        // Chat Functions
        let chatMessages = [
            {
                type: 'bot',
                message: 'Hello! I\'m <?php echo SITE_NAME; ?> Support Bot. How can I help you today?',
                time: 'Just now'
            }
        ];

        function openLiveChat() {
            document.getElementById('chatModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            document.getElementById('chatInput').focus();
            renderChatMessages();
        }

        function openEmergencyChat() {
            openLiveChat();
            document.getElementById('chatInput').value = 'EMERGENCY: Need immediate assistance with a critical farming issue.';
            sendMessage();
        }

        function closeChat() {
            document.getElementById('chatModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function sendMessage() {
            const input = document.getElementById('chatInput');
            const message = input.value.trim();
            
            if (message) {
                // Add user message
                chatMessages.push({
                    type: 'user',
                    message: message,
                    time: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})
                });
                
                // Clear input
                input.value = '';
                
                // Render messages
                renderChatMessages();
                
                // Simulate bot response
                setTimeout(() => {
                    const responses = [
                        "I understand. Let me check that for you.",
                        "Thanks for sharing that. Our support team will review your query.",
                        "I can help with that. Could you provide more details?",
                        "This sounds like a technical issue. Let me connect you with a specialist.",
                        "For this specific issue, I recommend checking our knowledge base article on this topic."
                    ];
                    
                    chatMessages.push({
                        type: 'bot',
                        message: responses[Math.floor(Math.random() * responses.length)],
                        time: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})
                    });
                    
                    renderChatMessages();
                }, 1000);
            }
        }

        function renderChatMessages() {
            const container = document.getElementById('chatMessages');
            container.innerHTML = '';
            
            chatMessages.forEach(msg => {
                const messageDiv = document.createElement('div');
                messageDiv.className = `mb-4 ${msg.type === 'user' ? 'text-right' : 'text-left'}`;
                
                if (msg.type === 'user') {
                    messageDiv.innerHTML = `
                        <div class="inline-block max-w-[80%]">
                            <div class="bg-green-600 text-white p-3 rounded-2xl rounded-tr-none">
                                <p>${msg.message}</p>
                            </div>
                            <div class="text-xs text-gray-500 mt-1">${msg.time}</div>
                        </div>
                    `;
                } else {
                    messageDiv.innerHTML = `
                        <div class="inline-block max-w-[80%]">
                            <div class="bg-gray-100 text-gray-800 p-3 rounded-2xl rounded-tl-none">
                                <p>${msg.message}</p>
                            </div>
                            <div class="text-xs text-gray-500 mt-1">${msg.time}</div>
                        </div>
                    `;
                }
                
                container.appendChild(messageDiv);
            });
            
            // Scroll to bottom
            container.scrollTop = container.scrollHeight;
        }

        // Contact Form Submission
        document.getElementById('supportForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show success message
            const button = this.querySelector('button[type="submit"]');
            const originalText = button.innerHTML;
            
            button.innerHTML = '<i class="fas fa-check mr-2"></i>Message Sent!';
            button.disabled = true;
            button.classList.remove('from-green-500', 'to-green-600', 'hover:-translate-y-1');
            button.classList.add('from-green-400', 'to-green-500');
            
            // Reset form
            this.reset();
            
            // Reset button after 3 seconds
            setTimeout(() => {
                button.innerHTML = originalText;
                button.disabled = false;
                button.classList.remove('from-green-400', 'to-green-500');
                button.classList.add('from-green-500', 'to-green-600', 'hover:-translate-y-1');
            }, 3000);
            
            // In a real application, you would send this data to your server
            console.log('Support request submitted');
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#') return;
                
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add floating animation to some elements on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Add stagger animation to cards
            const cards = document.querySelectorAll('.card-hover');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('animate-slide-up');
            });
            
            // Initialize chat messages
            renderChatMessages();
        });

        // Close modal when clicking outside
        document.getElementById('chatModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeChat();
            }
        });

        // Press Enter to send message in chat
        document.getElementById('chatInput')?.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    </script>
</body>
</html>