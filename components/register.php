<?php
// Set a default base_url if it's not set elsewhere (like a config file)
if (!isset($base_url)) {
    $base_url = '/GreenAgro/';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenAgro - Register</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7fafc;
        }

        .input-field {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            transition: all 0.2s;
        }

        .input-field:focus {
            outline: none;
            border-color: #16a34a;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.4);
        }

        .image-column {
            background-image: url('<?php echo $base_url; ?>assets/images/login.jpg');
            background-size: cover;
            background-position: center;
        }

        .logo {
            height: 210px;
            width: 210px;
            margin: 0 auto;
        }

        /* Multi-step progress styling */
        .step-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .step-item {
            display: flex;
            align-items: center;
            flex-grow: 1;
        }

        .step-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 600;
            color: #d1d5db;
            border: 2px solid #d1d5db;
            background-color: white;
            z-index: 10;
            transition: all 0.3s;
        }

        .step-label {
            margin-left: 8px;
            font-size: 1rem;
            color: #6b7280;
            font-weight: 500;
            white-space: nowrap;
        }

        .step-separator {
            flex-grow: 1;
            height: 2px;
            background-color: #d1d5db;
            margin: 0 10px;
        }

        /* Active/Completed Styles */
        .step-item.active .step-circle {
            background-color: #16a34a;
            /* Green */
            color: white;
            border-color: #16a34a;
        }

        .step-item.active .step-label {
            color: #16a34a;
            font-weight: 600;
        }

        .step-item.completed .step-circle {
            background-color: white;
            color: #16a34a;
            border-color: #16a34a;
        }

        .step-item.completed .step-circle svg {
            display: block;
            width: 18px;
            height: 18px;
        }

        .step-item:not(.completed) .step-circle svg {
            display: none;
        }

        .step-item.completed .step-label {
            color: #16a34a;
        }

        .step-separator.completed {
            background-color: #16a34a;
        }

        /* Make step progress vertical on small screens */
        @media (max-width: 768px) {
            .step-container {
                flex-direction: column;
                /* Stack steps vertically */
                align-items: center;
                justify-content: center;
                gap: 1rem;
                /* Space between steps */
                max-width: 100%;
            }

            .step-item {
                flex-direction: column;
                /* Arrange circle & label vertically */
                align-items: center;
                text-align: center;
                position: relative;
            }

            .step-circle {
                width: 40px;
                height: 40px;
                font-size: 0.9rem;
            }

            .step-label {
                margin: 6px 0 0 0;
                /* Label below the circle */
                font-size: 0.9rem;
            }

            /* Make separator a vertical line between steps */
            .step-separator {
                width: 2px;
                height: 40px;
                background-color: #d1d5db;
                margin: 0;
            }

            /* Completed state for vertical line */
            .step-separator.completed {
                background-color: #16a34a;
            }
        }


        /* Step 4 success */
        .success-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #16a34a;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
        }

        .success-circle svg {
            width: 40px;
            height: 40px;
            color: white;
        }
    </style>
</head>

<body class="min-h-screen flex justify-center items-center p-4 sm:p-8">

    <div id="main-container" class="main-container w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 bg-white rounded-3xl shadow-2xl overflow-hidden">

        <div id="image-column" class="image-column hidden lg:block relative">
            <div class="absolute inset-0 bg-green-700 opacity-60"></div>
            <div class="relative h-full flex flex-col justify-end text-white p-10">
                <h2 class="text-4xl font-bold mb-3 leading-tight">Join the Digital Farming Revolution.</h2>
                <p class="text-lg font-light">Sign up now to start tracking yields, managing resources, and optimizing your growth.</p>
            </div>
        </div>

        <div class="pt-0 px-8 sm:px-12 lg:px-16 pb-8">
            <div class="max-w-md mx-auto">

                <div class="text-center mb-8">
                    <div class="logo">
                        <img src="<?php echo $base_url; ?>assets/images/logowithname.png" alt="GreenAgro">
                    </div>
                    <h1 class="text-3xl font-extrabold text-gray-900 mt-3" id="main-header-text">Create Your Account</h1>
                    <p class="mt-1 text-gray-500"><span id="step-status-text">Start your free trial today</span></p>
                </div>

                <div id="progress-bar-container" class="step-container hidden">

                    <div class="step-item" data-step="2">
                        <div class="step-circle">
                            <span class="step-number">1</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-green-600">
                                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 0 1 .208 1.04l-9 13.5a.75.75 0 0 1-1.154.114l-6-6a.75.75 0 0 1 1.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 0 1 1.04-.208Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="step-label">About Your Farm</span>
                    </div>

                    <div class="step-separator" data-separator-step="2"></div>

                    <div class="step-item" data-step="3">
                        <div class="step-circle">
                            <span class="step-number">2</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-green-600">
                                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 0 1 .208 1.04l-9 13.5a.75.75 0 0 1-1.154.114l-6-6a.75.75 0 0 1 1.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 0 1 1.04-.208Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="step-label">Preferences</span>
                    </div>

                    <div class="step-separator" data-separator-step="3"></div>

                    <div class="step-item" data-step="4">
                        <div class="step-circle">
                            <span class="step-number">3</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-green-600">
                                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 0 1 .208 1.04l-9 13.5a.75.75 0 0 1-1.154.114l-6-6a.75.75 0 0 1 1.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 0 1 1.04-.208Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="step-label">Complete</span>
                    </div>

                </div>

                <div id="message-box" class="hidden p-3 mb-6 rounded-lg font-medium text-sm text-center"></div>

                <form id="multi-step-form" class="space-y-6" method="POST" action="">

                    <div id="step-1" data-step="1" class="step-content">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="firstname" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                <input id="firstname" name="firstname" type="text" required placeholder="Enter first name" class="input-field w-full">
                            </div>
                            <div>
                                <label for="lastname" class="block text-sm font-medium text-gray-700 mb-1">Last Name(surname)</label>
                                <input id="lastname" name="lastname" type="text" required placeholder="Enter last name" class="input-field w-full">
                            </div>
                        </div><br>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input id="email" name="email" type="email" required placeholder="Enter your email" class="input-field w-full">
                        </div><br>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input id="password" name="password" type="password" required placeholder="Enter your password" class="input-field w-full">
                        </div><br>

                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center">
                                <input id="agree-terms" name="agree-terms" type="checkbox" class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                                <label for="agree-terms" class="ml-2 text-gray-700">
                                    I agree to the <a href="#" class="text-green-600 hover:text-green-500 font-medium">Terms & Conditions</a>
                                </label>
                            </div>
                            <a href="#" class="font-medium text-green-600 hover:text-green-500 transition">Need help?</a>
                        </div>
                        <br>

                        <button type="button" id="start-step-2-btn" name="register"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-base font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 transform hover:scale-[1.01]">
                            Register
                        </button>
                    </div>

                    <div id="step-2" data-step="2" class="step-content hidden">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">About your Farm</h2>

                        <div class="space-y-4">
                            <div>
                                <label for="farm-name" class="block text-sm font-medium text-gray-700 mb-1">What do you call your farm?</label>
                                <input id="farm-name" name="farm-name" type="text" required placeholder="For example: Mary's Organic Greens" class="input-field w-full">
                            </div>

                            <div class="pt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">What type of farm or ranch do you operate?</label>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <input id="type-both" name="farming-type" type="radio" value="both" required class="h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500" checked>
                                        <label for="type-both" class="ml-3 block text-sm font-medium text-gray-700">Raise livestock and grow crops</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="type-livestock" name="farming-type" type="radio" value="livestock" class="h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500">
                                        <label for="type-livestock" class="ml-3 block text-sm font-medium text-gray-700">Only raise livestock</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="type-crop" name="farming-type" type="radio" value="crop" class="h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500">
                                        <label for="type-crop" class="ml-3 block text-sm font-medium text-gray-700">Only grow crops</label>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4">
                                <h3 class="text-sm font-medium text-gray-700 mb-1">Where are you located?</h3>
                                <p class="text-xs text-gray-500 mb-3">This will help to accurately map your farm. You can always add this later.</p>

                                <div class="grid grid-cols-3 gap-2 items-center mb-2">
                                    <label for="country" class="col-span-1 text-sm font-medium text-gray-700">Country</label>
                                    <input id="country" name="country" type="text" required value="India" class="col-span-2 input-field w-full">
                                </div>

                                <div class="grid grid-cols-3 gap-2 items-center mb-2">
                                    <label for="address" class="col-span-1 text-sm font-medium text-gray-700">Address</label>
                                    <input id="address" name="address" type="text" placeholder="Enter your address" class="col-span-2 input-field w-full">
                                </div>

                                <div class="grid grid-cols-3 gap-2 items-center mb-2">
                                    <label for="city" class="col-span-1 text-sm font-medium text-gray-700">City</label>
                                    <input id="city" name="city" type="text" placeholder="Enter your city" class="col-span-2 input-field w-full">
                                </div>

                                <div class="grid grid-cols-3 gap-2 items-center mb-2">
                                    <label for="state-province" class="col-span-1 text-sm font-medium text-gray-700">State/Province</label>
                                    <input id="state-province" name="state-province" type="text" placeholder="Enter your state/province" class="col-span-2 input-field w-full">
                                </div>

                                <div class="grid grid-cols-3 gap-2 items-center">
                                    <label for="postal-code" class="col-span-1 text-sm font-medium text-gray-700">Postal Code</label>
                                    <input id="postal-code" name="postal-code" type="text" placeholder="Enter your pincode" class="col-span-2 input-field w-full">
                                </div>
                            </div>

                            <div class="pt-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <input id="latitude" name="latitude" type="text" placeholder="Enter your latitude" class="input-field w-full">
                                    </div>
                                    <div>
                                        <input id="longitude" name="longitude" type="text" placeholder="Enter your longitude" class="input-field w-full">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="flex justify-end pt-6">
                            <button type="button" data-next-step="3"
                                class="next-step-btn py-3 px-6 border border-transparent rounded-lg shadow-md text-base font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 transform hover:scale-[1.01]">
                                Next →
                            </button>
                        </div>
                    </div>

                    <div id="step-3" data-step="3" class="step-content hidden">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">2. Preferences</h2>

                        <div class="space-y-6">
                            <div>
                                <label for="main-crops" class="block text-sm font-medium text-gray-700 mb-1">What are your main crops or livestock?</label>
                                <input id="main-crops" name="main-crops" type="text" required placeholder="e.g., Wheat, Dairy Cows, Cotton" class="input-field w-full">
                            </div>

                            <div>
                                <label for="irrigation-method" class="block text-sm font-medium text-gray-700 mb-1">Primary Irrigation Method</label>
                                <select id="irrigation-method" name="irrigation-method" required class="input-field w-full appearance-none bg-white">
                                    <option value="">Select Method</option>
                                    <option value="drip">Drip Irrigation</option>
                                    <option value="sprinkler">Sprinkler System</option>
                                    <option value="flood">Flood/Furrow Irrigation</option>
                                    <option value="rainfed">Rainfed (No Irrigation)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Which weather metrics are most important to you?</label>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <input id="metric-temp" name="weather-metrics[]" type="checkbox" value="temperature" class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                                        <label for="metric-temp" class="ml-3 block text-sm font-medium text-gray-700">Temperature</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="metric-rain" name="weather-metrics[]" type="checkbox" value="rainfall" class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500" checked>
                                        <label for="metric-rain" class="ml-3 block text-sm font-medium text-gray-700">Rainfall/Precipitation</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="metric-soil" name="weather-metrics[]" type="checkbox" value="soil_moisture" class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                                        <label for="metric-soil" class="ml-3 block text-sm font-medium text-gray-700">Soil Moisture</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between pt-6 border-t mt-8">
                            <button type="button" data-prev-step="2"
                                class="prev-step-btn py-3 px-6 border border-gray-300 rounded-lg shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                                ← Back
                            </button>
                            <button type="button" data-next-step="4" id="submit-step-3-btn"
                                class="next-step-btn py-3 px-6 border border-transparent rounded-lg shadow-md text-base font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 transform hover:scale-[1.01]">
                                Next →
                            </button>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div id="step-4" data-step="4" class="step-content hidden text-center">
                        <div class="success-circle mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Registration Successful!</h2>
                        <p class="text-gray-600 mb-4">Please verify your email to activate your account.</p>
                        <button type="submit" id="complete-registration-btn" class="py-2 px-6 bg-green-600 text-white rounded hover:bg-green-700">Finish</button>
                    </div>

                </form>

                <div class="mt-6 text-center text-sm text-gray-500 border-t pt-4">
                    <p>Already have an account?
                        <a href="login.php" class="font-medium text-green-600 hover:text-green-500 transition">Sign in here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo $base_url; ?>assets/js/register.js"></script>
</body>

</html>