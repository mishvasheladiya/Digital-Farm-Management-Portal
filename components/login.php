<?php
// Set a default base_url if it's not set elsewhere (like a config file)
if (!isset($base_url)) {
    $base_url = '/farm/';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenAgro</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7fafc; /* Very light gray background */
        }
        .main-container {
            max-width: 1200px; /* Max width for the entire card on desktop */
            height: auto; /* Auto height to accommodate content */
        }
        /* Custom input focus styling */
        .input-field {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            transition: all 0.2s;
        }
        .input-field:focus {
            outline: none;
            border-color: #10b981; /* Emerald 500 */
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.4);
        }
        /* Image column background style */
        .image-column {
            /* Updated placeholder text for login focus */
            background-image: url('<?php echo $base_url; ?>assets/image/login.jpg');
            background-size: cover;
            background-position: center;
        }
        .logo{
            height: 150px;
            width: 150px;    
            margin: 0 auto;
        }
    </style>
</head>
<body class="min-h-screen flex justify-center items-center p-4 sm:p-8">

    <!-- Main Two-Column Container -->
    <div class="main-container w-full grid grid-cols-1 lg:grid-cols-2 bg-white rounded-3xl shadow-2xl overflow-hidden animate-fadeIn">

        <!-- Left Column: Image/Visual -->
        <div class="image-column hidden lg:block p-8 relative">
            <div class="absolute inset-0 bg-green-700 opacity-60"></div>
            <div class="relative h-full flex flex-col justify-end text-white">
                <h2 class="text-4xl font-bold mb-3 leading-tight">
                    Data-Driven Decisions. Better Harvests.
                </h2>
                <p class="text-lg font-light">
                    Manage your crops, finances, and tasks all in one seamless portal.
                </p>
            </div>
        </div>

        <!-- Right Column: Login Form -->
<div class="pt-0 px-8 sm:px-12 lg:px-16 pb-8">
            <div class="max-w-md mx-auto">
                <!-- Header -->
                <div class="text-center mb-8">
                    <!-- Icon: Stylized Leaf -->
                    <div class="logo">
                        <img src="<?php echo $base_url; ?>assets/image/logo.png" alt="GreenAgro">
                    </div>
                    <h1 class="text-3xl font-extrabold text-gray-900 mt-3">
                        Welcome Back
                    </h1>
                    <p class="mt-1 text-gray-500">Sign in to access your farm data</p>
                </div>

                <!-- Notification Area -->
                <div id="message-box" class="hidden p-3 mb-6 rounded-lg font-medium text-sm" role="alert">
                    <!-- Messages will appear here -->
                </div>

                <!-- Login Form -->
                <form id="login-form" class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required placeholder="Enter Your Email"
                               class="input-field w-full">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required placeholder="Enter Your Password"
                               class="input-field w-full">
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox"
                                   class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                            <label for="remember-me" class="ml-2 text-gray-700">Remember me</label>
                        </div>
                        <a href="<?php echo $base_url; ?>components/forgot-password.php" class="font-medium text-green-600 hover:text-green-500 transition">
                            Forgot password?
                        </a>
                    </div>

                    <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-base font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 transform hover:scale-[1.01]">
                             Sign in
                    </button>
                </form>
                
                <!-- Footer link to Sign Up -->
                <div class="mt-6 text-center text-sm text-gray-500 border-t pt-4">
                    <p>Don't have an account? 
                        <a href="register.php" class="font-medium text-green-600 hover:text-green-500 transition">Sign up here</a>
                    </p>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const messageBox = document.getElementById('message-box');
            
            // Simple mock authentication logic
            const email = emailInput.value.trim();
            const password = passwordInput.value.trim();

            // Clear previous message classes
            messageBox.classList.remove('hidden', 'bg-red-100', 'text-red-800', 'bg-green-100', 'text-green-800');
            messageBox.textContent = '';

            if (email === 'farmer@example.com' && password === 'password123') {
                // Mock Success for Farmer
                messageBox.classList.add('bg-green-100', 'text-green-800');
                messageBox.textContent = 'Login Successful! Redirecting to Dashboard...';
                
                console.log('Mock Farmer Login Success. Ready to redirect.');

            } else if (email === 'admin@example.com' && password === 'adminpass') {
                 // Mock Admin Success
                messageBox.classList.add('bg-green-100', 'text-green-800');
                messageBox.textContent = 'Admin Login Successful! Redirecting...';
                console.log('Mock Admin Login Success. Ready to redirect.');

            } else {
                // Mock Failure
                messageBox.classList.add('bg-red-100', 'text-red-800');
                messageBox.textContent = 'Invalid credentials. Please check your email and password.';
                
            }
        });
    </script>
</body>
</html>
