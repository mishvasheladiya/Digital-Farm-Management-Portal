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
        /* fade + slide animation */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            animation: reveal 1s ease forwards;
        }

        @keyframes reveal {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-hover {
            transition: var(--transition);
        }

        .card-hover:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--shadow-lg);
        }

        .icon-animate {
            transition: var(--transition);
        }

        .card-hover:hover .icon-animate {
            transform: rotate(-5deg) scale(1.2);
            color: var(--primary-dark);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- header -->
    <?php include 'Components/header.php'; ?>

    <!-- navbar -->
    <?php include 'Components/navbar.php'; ?>

    <!-- video carousel -->
    <section class="video-carousel">
        <div class="video-slide active">
            <video autoplay muted loop>
                <source src="<?php echo $base_url; ?>assets/image/GreenAgro Video.mp4" type="video/mp4" />
            </video>
        </div>
    </section>

    <!-- Our Journey Section -->
    <?php include 'Components/Our-Journey.php'; ?>

    <!-- Trust Features -->
    <section class="bg-[var(--white)] py-20">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-12 text-center">

            <div class="reveal card-hover bg-[var(--light)] p-8 rounded-2xl shadow-md">
                <i class="fas fa-leaf text-4xl text-[var(--primary)] mb-4 icon-animate"></i>
                <h3 class="font-bold text-xl text-[var(--primary-dark)]">Fresh from Farm</h3>
                <p class="text-gray-600 mt-2">Directly sourced from verified farmers</p>
            </div>

            <div class="reveal card-hover bg-[var(--light)] p-8 rounded-2xl shadow-md" style="animation-delay:.2s">
                <i class="fas fa-truck-fast text-4xl text-[var(--primary)] mb-4 icon-animate"></i>
                <h3 class="font-bold text-xl text-[var(--primary-dark)]">Fast Delivery</h3>
                <p class="text-gray-600 mt-2">Quick and reliable logistics support</p>
            </div>

            <div class="reveal card-hover bg-[var(--light)] p-8 rounded-2xl shadow-md" style="animation-delay:.4s">
                <i class="fas fa-scale-balanced text-4xl text-[var(--primary)] mb-4 icon-animate"></i>
                <h3 class="font-bold text-xl text-[var(--primary-dark)]">Fair Prices</h3>
                <p class="text-gray-600 mt-2">Live market prices & transparent deals</p>
            </div>

        </div>
    </section>

    <!-- Our Mission -->
    <section class="py-16 bg-gradient-to-br from-[var(--primary-light)] to-white">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-14 items-center">

            <div class="reveal">
                <h2 class="text-4xl font-extrabold text-[var(--primary-dark)] mb-6">Our Mission</h2>
                <p class="text-gray-700 leading-relaxed text-lg">
                    Our mission is to bridge the gap between rural farmers and urban consumers.
                    We empower farmers with digital tools to manage farming activities,
                    sell produce at fair prices, and make data-driven decisions.
                    By integrating modern technology with agriculture, we promote
                    sustainable farming and smarter resource utilization.
                </p>
            </div>

            <div class="flex justify-center reveal" style="animation-delay:.3s">
                <img src="<?php echo $base_url; ?>assets/image/mission-farm.png" alt="Our Mission" class="max-w-md drop-shadow-xl" style="width: 100%; height: auto;">
            </div>

        </div>
    </section>

    <!-- Platform Features -->
    <section id="features" class="bg-[var(--white)] py-24">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-4xl font-extrabold text-center text-[var(--primary-dark)] mb-14 reveal">Platform Features</h2>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-10">

                <div class="reveal card-hover bg-[var(--light)] p-8 rounded-2xl shadow-md">
                    <i class="fas fa-chart-line text-[var(--primary)] text-3xl mb-4 icon-animate"></i>
                    <h4 class="font-bold mb-2">Live Market Prices</h4>
                    <p class="text-sm text-gray-600">Updated commodity prices in real time</p>
                </div>

                <div class="reveal card-hover bg-[var(--light)] p-8 rounded-2xl shadow-md" style="animation-delay:.2s">
                    <i class="fas fa-cloud-sun text-[var(--primary)] text-3xl mb-4 icon-animate"></i>
                    <h4 class="font-bold mb-2">Weather Integration</h4>
                    <p class="text-sm text-gray-600">Accurate forecasts & alerts</p>
                </div>

                <div class="reveal card-hover bg-[var(--light)] p-8 rounded-2xl shadow-md" style="animation-delay:.4s">
                    <i class="fas fa-robot text-[var(--primary)] text-3xl mb-4 icon-animate"></i>
                    <h4 class="font-bold mb-2">AI Chatbot</h4>
                    <p class="text-sm text-gray-600">Smart farming assistance 24/7</p>
                </div>

                <div class="reveal card-hover bg-[var(--light)] p-8 rounded-2xl shadow-md" style="animation-delay:.6s">
                    <i class="fas fa-language text-[var(--primary)] text-3xl mb-4 icon-animate"></i>
                    <h4 class="font-bold mb-2">Language Translator</h4>
                    <p class="text-sm text-gray-600">Supports regional languages</p>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include 'Components/footer.php'; ?>
</body>
</html>