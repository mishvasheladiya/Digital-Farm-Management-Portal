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
    <title>Forgot Password - GreenAgro</title>
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
            /* Reusing the login image/style for consistency */
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

    <div class="main-container w-full grid grid-cols-1 lg:grid-cols-2 bg-white rounded-3xl shadow-2xl overflow-hidden">

        <div class="image-column hidden lg:block p-8 relative">
            <div class="absolute inset-0 bg-gray-700 opacity-60"></div>
            <div class="relative h-full flex flex-col justify-end text-white">
                <h2 class="text-4xl font-bold mb-3 leading-tight">
                    Security First.
                </h2>
                <p class="text-lg font-light">
                    We'll help you get back into your account safely and quickly.
                </p>
            </div>
        </div>

        <div class="pt-0 px-8 sm:px-12 lg:px-16 pb-8">
            <div class="max-w-md mx-auto">
                <div class="text-center mb-8 pt-10">
                    <div class="logo">
                        <img src="<?php echo $base_url; ?>assets/image/logo.png" alt="GreenAgro">
                    </div>
                    <h1 class="text-3xl font-extrabold text-gray-900 mt-3">
                        Reset Your Password
                    </h1>
                    <p class="mt-1 text-gray-500">
                        Enter your email address below to receive a password reset link.
                    </p>
                </div>

                <div id="message-box" class="hidden p-3 mb-6 rounded-lg font-medium text-center text-sm" role="alert">
                    </div>

                <form id="reset-form" class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required placeholder="Enter your registered email"
                               class="input-field w-full">
                    </div>

                    <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-base font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 transform hover:scale-[1.01]">
                            Send Reset Link
                    </button>
                </form>
                
                <div class="mt-6 text-center text-sm text-gray-500 border-t pt-4">
                    <p>Remembered your password? 
                        <a href="<?php echo $base_url; ?>components/login.php" class="font-medium text-green-600 hover:text-green-500 transition">Go back to Sign In</a>
                    </p>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.getElementById('reset-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const emailInput = document.getElementById('email');
            const messageBox = document.getElementById('message-box');
            const email = emailInput.value.trim();
            const submitButton = document.querySelector('#reset-form button[type="submit"]');

            // --- 1. Reset Message Box and Button ---
            messageBox.classList.add('hidden'); // Start by hiding it
            messageBox.classList.remove('bg-red-100', 'text-red-800', 'bg-green-100', 'text-green-800');
            messageBox.textContent = '';
            submitButton.disabled = false; // Re-enable button for new attempt

            // --- 2. Validation ---

            // Email Required Check
            if (email === "") {
                messageBox.classList.remove('hidden');
                messageBox.classList.add('bg-red-100', 'text-red-800');
                messageBox.textContent = 'Please enter your email address.';
                return;
            }

            // Email Format Check (Robust)
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                messageBox.classList.remove('hidden');
                messageBox.classList.add('bg-red-100', 'text-red-800');
                messageBox.textContent = 'Please enter a valid email address format.';
                return;
            }

            // --- 3. Mock Success Message (Simulate server sending email) ---

            // In a real application, an AJAX call to the server would happen here.
            // If the server confirms the email was sent:
            
            messageBox.classList.remove('hidden');
            messageBox.classList.add('bg-green-100', 'text-green-800');
            messageBox.textContent = `✅ A password reset link has been successfully sent to ${email}. Please check your inbox.`;
            
            // Disable the button to prevent spamming while the user checks their email
            submitButton.disabled = true;

            // Optional: Clear the input field after success
            emailInput.value = '';
        });
    </script>
</body>
</html>