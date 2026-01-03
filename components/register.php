<?php
    $base_url = "/farm/";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenAgro - Registration</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* Lighter background for centered look */
        }
        /* New elevated input style */
        .input-field {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #e5e7eb; /* Lighter border */
            background-color: white;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); /* subtle shadow */
            transition: all 0.2s;
        }
        .input-field:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.4);
        }
        .image-column {
            background-image: url('<?php echo $base_url; ?>assets/image/login.jpg');
            background-size: cover;
            background-position: center;
        }
        .logo{
            height: 120px; /* Slightly smaller logo */
            width: 120px;
            margin: 0 auto;
        }

        /* --- Seller Type Card Styling (NEW DESIGN) --- */
        .seller-card {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background-color: white;
        }
        .seller-card:hover {
            border-color: #34d399; /* Light green on hover */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06);
        }
        .seller-card.selected {
            border-color: #10b981; /* Green selected */
            background-color: #f0fdf4; /* Very light green background */
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.4);
        }

        /* --- Multi-step progress styling (kept mostly the same but condensed) --- */
        .step-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        .step-item {
            display: flex;
            align-items: center;
            flex-grow: 1;
            position: relative;
        }
        .step-item:last-child .step-separator {
            display: none;
        }
        .step-circle {
            width: 32px; /* Slightly smaller circle */
            height: 32px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 600;
            font-size: 0.9rem;
            color: #9ca3af;
            border: 2px solid #d1d5db;
            background-color: white;
            z-index: 10;
            transition: all 0.3s;
        }
        .step-label {
            margin-left: 8px;
            font-size: 0.875rem; /* Smaller label text */
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
            background-color: #10b981;
            color: white;
            border-color: #10b981;
        }
        .step-item.active .step-label {
            color: #10b981;
            font-weight: 600;
        }
        .step-item.completed .step-circle {
            background-color: white;
            color: #10b981;
            border-color: #10b981;
        }
        .step-item.completed .step-circle svg {
             display: block;
             width: 16px;
             height: 16px;
        }
        .step-item:not(.completed) .step-circle svg {
            display: none;
        }
        .step-separator.completed {
            background-color: #10b981;
        }

        /* Vertical Progress Bar for mobile */
        @media (max-width: 768px) {
            .step-container {
                flex-direction: column; 
                gap: 0.5rem; /* Reduced gap */
            }
            .step-item {
                flex-direction: row; 
                width: 100%;
                justify-content: flex-start;
                padding: 0 10%;
            }
             .step-label { margin-left: 15px; } /* Adjust margin for horizontal layout on mobile */

             /* Hide vertical separators on mobile since we don't stack them vertically */
             .step-separator { display: none; }
        }

        /* Step 4 success */
        .success-circle { 
            width:100px; 
            height:100px; 
            border-radius:50%; 
            background-color:#10b981; 
            display:flex; 
            align-items:center; 
            justify-content:center; 
            margin:auto; 
        }
        .success-circle svg { width:50px; height:50px; color:white; }
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

        <div class="pt-8 px-8 sm:px-12 lg:px-16 pb-8">
            <div class="max-w-md mx-auto">

                <div class="text-center mb-8">
                    <div class="logo">
                        <img src="<?php echo $base_url; ?>assets/image/logo.png" alt="GreenAgro">
                    </div>
                    <h1 class="text-3xl font-extrabold text-gray-900 mt-3" id="main-header-text">Create Your Account</h1>
                    <p class="mt-1 text-gray-500"><span id="step-status-text">Start your free trial today</span></p>
                </div> 

                <div id="progress-bar-container" class="step-container hidden">
                    
                    <div class="step-item active" data-step="1">
                        <div class="step-circle">
                             <span class="step-number">1</span>
                             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                 <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 0 1 .208 1.04l-9 13.5a.75.75 0 0 1-1.154.114l-6-6a.75.75 0 0 1 1.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 0 1 1.04-.208Z" clip-rule="evenodd" />
                             </svg>
                        </div>
                        <span class="step-label">Account</span>
                        <div class="step-separator" data-separator-step="1"></div>
                    </div>
                    
                    <div class="step-item" data-step="2">
                        <div class="step-circle">
                            <span class="step-number">2</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 0 1 .208 1.04l-9 13.5a.75.75 0 0 1-1.154.114l-6-6a.75.75 0 0 1 1.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 0 1 1.04-.208Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="step-label" id="step-2-label">Details</span>
                        <div class="step-separator" data-separator-step="2"></div>
                    </div>

                    <div class="step-item" data-step="3">
                        <div class="step-circle">
                            <span class="step-number">3</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 0 1 .208 1.04l-9 13.5a.75.75 0 0 1-1.154.114l-6-6a.75.75 0 0 1 1.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 0 1 1.04-.208Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="step-label" id="step-3-label">Setup</span>
                        <div class="step-separator" data-separator-step="3"></div>
                    </div>
                    
                    <div class="step-item" data-step="4">
                        <div class="step-circle">
                            <span class="step-number">4</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 0 1 .208 1.04l-9 13.5a.75.75 0 0 1-1.154.114l-6-6a.75.75 0 0 1 1.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 0 1 1.04-.208Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    <button type="submit" class="step-label text-green-600 font-semibold">Move to login</button>
                    </div>

                </div>

                <div id="message-box" class="hidden p-3 mb-6 rounded-lg font-medium text-sm text-center"></div>

                <form id="multi-step-form" class="space-y-6" method="POST" action="register_handler.php">                    
                    <div id="step-1" data-step="1" class="step-content">
                        
                        <div class="mb-8">
                            <label class="block text-base font-semibold text-gray-900 mb-4">I am registering as a:</label>
                            <input type="hidden" id="seller_type" name="seller_type" type="seller_type" required>
                            <div class="flex space-x-4">
                                
                                <div data-type="Farmer" class="seller-card seller-btn flex-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-green-600 mx-auto mb-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.715c0-1.637 1.082-3.179 2.195-3.179s2.195 1.542 2.195 3.179V21m-4.39 0h4.39m-4.39 0h-3.32a.75.75 0 0 1-.75-.75V8.452a30.686 30.686 0 0 1 1.258-3.551L10.5 2.25l3.565 2.651c.78.583 1.258 1.517 1.258 2.585V20.25c0 .414-.336.75-.75.75h-3.32m4.39 0h3.32c.414 0 .75-.336.75-.75V8.452a30.687 30.687 0 0 0-1.258-3.551L13.5 2.25l-3.565 2.651c-.78.583-1.258 1.517-1.258 2.585V20.25c0 .414.336.75.75.75Z" />
                                    </svg>
                                    <span class="font-bold text-gray-800">Farmer</span>
                                    <p class="text-xs text-gray-500 mt-1">Grower, producer, or ranch owner.</p>
                                </div>

                                <div data-type="Distributor" class="seller-card seller-btn flex-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-green-600 mx-auto mb-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-7.5v.007m0 7.493.75-.75c.414-.414 1.08-.414 1.494 0l1.25.75m-3.5-.75.75.75c.414.414 1.08.414 1.494 0l1.25-.75m-4.5 0h8.25" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 9-.75.75c-.414.414-1.08.414-1.494 0l-1.25-.75m-3 0 1.25.75c.414.414 1.08.414 1.494 0l.75-.75" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h8.25" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12V6.75c0-.414.336-.75.75-.75h14.25c.414 0 .75.336.75.75V12M4.5 12H3.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75h.75M19.5 12h.75a.75.75 0 0 1 .75.75v3.75c0 .414-.336.75-.75.75h-.75M6 18h12" />
                                    </svg>
                                    <span class="font-bold text-gray-800">Distributor</span>
                                    <p class="text-xs text-gray-500 mt-1">Supplier, retailer, or business partner.</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="firstname" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                <input id="firstname" name="firstname" type="text" required placeholder="Enter first name" class="input-field w-full">
                            </div>
                            <div>
                                <label for="lastname" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                <input id="lastname" name="lastname" type="text" required placeholder="Enter last name" class="input-field w-full">
                            </div>
                        </div><br>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="mobile" class="block text-sm font-medium text-gray-700 mb-1">Mobile No.</label>
                                <input id="mobile" name="mobile" type="text" required placeholder="Enter your mobile number" class="input-field w-full">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <input id="email" name="email" type="email" required placeholder="Enter your email address" class="input-field w-full">
                            </div>
                        </div><br>
                        
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input id="password" name="password" type="password" required placeholder="Create a secure password" class="input-field w-full">
                        </div>

                        <div class="flex items-center justify-between text-sm pt-2">
                            <div class="flex items-center">
                                <input id="agree-terms" name="agree-terms" type="checkbox" class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                                <label for="agree-terms" class="ml-2 text-gray-700">
                                    I agree to the <a href="#" class="text-green-600 hover:text-green-500 font-medium">Terms & Conditions</a>
                                </label>
                            </div>
                        </div>
                        
                        <button type="button" 
                            class="w-full flex justify-center py-3 px-4 mt-6 border border-transparent rounded-lg shadow-md text-base font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 transform hover:scale-[1.01]">
                            Continue to Details
                        </button>
                    </div>

                    <div id="step-2-farmer" data-step="2" class="step-content hidden">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Tell Us About Your Farm</h2>

                        <div class="space-y-4">
                            <div>
                                <label for="farm-name" class="block text-sm font-medium text-gray-700 mb-1">What do you call your farm?</label>
                                <input id="farm-name" name="farm-name" type="text" placeholder="For example: Mary's Organic Greens" class="input-field w-full">
                            </div>

                            <div class="pt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">What type of farm or ranch do you operate?</label>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <input id="type-both" name="farming-type" type="radio" value="both" checked class="h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500">
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
                            
                            <div class="pt-4 border-t border-gray-200">
                                <h3 class="text-sm font-medium text-gray-700 mb-2 pt-4">Farm Location Details</h3>
                                
                                <div class="grid grid-cols-3 gap-2 items-center mb-2">
                                    <label for="country" class="col-span-1 text-sm text-gray-700">Country</label>
                                    <input id="country" name="country" type="text" value="India" class="col-span-2 input-field w-full">
                                </div>

                                <div class="grid grid-cols-3 gap-2 items-center mb-2">
                                    <label for="address" class="col-span-1 text-sm text-gray-700">Address</label>
                                    <input id="address" name="address" type="text" placeholder="Enter your address" class="col-span-2 input-field w-full">
                                </div>
                                
                                <div class="grid grid-cols-3 gap-2 items-center mb-2">
                                    <label for="city" class="col-span-1 text-sm text-gray-700">City</label>
                                    <input id="city" name="city" type="text" placeholder="Enter your city" class="col-span-2 input-field w-full">
                                </div>

                                <div class="grid grid-cols-3 gap-2 items-center mb-2">
                                    <label for="state-province" class="col-span-1 text-sm text-gray-700">State/Province</label>
                                    <input id="state-province" name="state-province" type="text" placeholder="Enter your state/province" class="col-span-2 input-field w-full">
                                </div>

                                <div class="grid grid-cols-3 gap-2 items-center">
                                    <label for="postal-code" class="col-span-1 text-sm text-gray-700">Postal Code</label>
                                    <input id="postal-code" name="postal-code" type="text" placeholder="Enter your pincode" class="col-span-2 input-field w-full">
                                </div>
                            </div>
                            
                            <div class="pt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Coordinates (Optional)</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <input id="latitude" name="latitude" type="text" placeholder="Latitude" class="input-field w-full">
                                    </div>
                                    <div>
                                        <input id="longitude" name="longitude" type="text" placeholder="Longitude" class="input-field w-full">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between pt-6 border-t mt-8">
                            <button type="button" data-prev-step="1" class="prev-step-btn py-3 px-6 border border-gray-300 rounded-lg shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                                ← Back
                            </button>
                            <button type="button" data-next-step="3" class="next-step-btn-2 py-3 px-6 border border-transparent rounded-lg shadow-md text-base font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 transform hover:scale-[1.01]">
                                Next: Setup →
                            </button>
                        </div>
                    </div>

                    <div id="step-2-distributor" data-step="2" class="step-content hidden">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Tell Us About Your Business</h2>

                        <div class="space-y-4">
                            <div>
                                <label for="company-name" class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                                <input id="company-name" name="company-name" type="text" placeholder="Enter your registered business name" class="input-field w-full">
                            </div>

                            <div>
                                <label for="business-id" class="block text-sm font-medium text-gray-700 mb-1">Business License/Tax ID (Optional)</label>
                                <input id="business-id" name="business-id" type="text" placeholder="Enter business license or Tax ID" class="input-field w-full">
                            </div>

                            <div class="pt-4 border-t border-gray-200">
                                <h3 class="text-sm font-medium text-gray-700 mb-2 pt-4">Business Location (Head Office)</h3>
                                
                                <div class="grid grid-cols-3 gap-2 items-center mb-2">
                                    <label for="d-country" class="col-span-1 text-sm text-gray-700">Country</label>
                                    <input id="d-country" name="d-country" type="text" value="India" class="col-span-2 input-field w-full">
                                </div>

                                <div class="grid grid-cols-3 gap-2 items-center mb-2">
                                    <label for="d-address" class="col-span-1 text-sm text-gray-700">Address</label>
                                    <input id="d-address" name="d-address" type="text" placeholder="Enter office address" class="col-span-2 input-field w-full">
                                </div>
                                
                                <div class="grid grid-cols-3 gap-2 items-center mb-2">
                                    <label for="d-city" class="col-span-1 text-sm text-gray-700">City</label>
                                    <input id="d-city" name="d-city" type="text" placeholder="Enter city" class="col-span-2 input-field w-full">
                                </div>

                                <div class="grid grid-cols-3 gap-2 items-center mb-2">
                                    <label for="d-state-province" class="col-span-1 text-sm text-gray-700">State/Province</label>
                                    <input id="d-state-province" name="d-state-province" type="text" placeholder="Enter state/province" class="col-span-2 input-field w-full">
                                </div>

                                <div class="grid grid-cols-3 gap-2 items-center">
                                    <label for="d-postal-code" class="col-span-1 text-sm text-gray-700">Postal Code</label>
                                    <input id="d-postal-code" name="d-postal-code" type="text" placeholder="Enter pincode" class="col-span-2 input-field w-full">
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between pt-6 border-t mt-8">
                            <button type="button" data-prev-step="1" class="prev-step-btn py-3 px-6 border border-gray-300 rounded-lg shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                                ← Back
                            </button>
                            <button type="button" data-next-step="3" class="next-step-btn-2 py-3 px-6 border border-transparent rounded-lg shadow-md text-base font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 transform hover:scale-[1.01]">
                                Next: Setup →
                            </button>
                        </div>
                    </div>

                    <div id="step-3-farmer" data-step="3" class="step-content hidden">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Farm Preferences & Focus</h2>

                        <div class="space-y-6">
                            <div>
                                <label for="main-crops" class="block text-sm font-medium text-gray-700 mb-1">What are your main crops or livestock?</label>
                                <input id="main-crops" name="main-crops" type="text" placeholder="e.g., Wheat, Dairy Cows, Cotton" class="input-field w-full">
                            </div>

                            <div>
                                <label for="irrigation-method" class="block text-sm font-medium text-gray-700 mb-1">Primary Irrigation Method</label>
                                <select id="irrigation-method" name="irrigation-method" class="input-field w-full appearance-none bg-white">
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
                                        <input id="metric-rain" name="weather-metrics[]" type="checkbox" value="rainfall" checked class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
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
                            <button type="button" data-prev-step="2" class="prev-step-btn-3 py-3 px-6 border border-gray-300 rounded-lg shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                                ← Back
                            </button>
                            <button type="submit" id="submit-farmer-btn"
                                class="py-3 px-6 border border-transparent rounded-lg shadow-md text-base font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 transform hover:scale-[1.01]">
                                Complete Registration
                            </button>
                        </div>
                    </div>

                    <div id="step-3-distributor" data-step="3" class="step-content hidden">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Service Area & Products</h2>

                        <div class="space-y-6">
                            <div>
                                <label for="service-area" class="block text-sm font-medium text-gray-700 mb-1">Primary Service Area (Cities/Regions)</label>
                                <input id="service-area" name="service-area" type="text" placeholder="e.g., Maharashtra, Pune, North Karnataka" class="input-field w-full">
                            </div>

                            <div>
                                <label for="products" class="block text-sm font-medium text-gray-700 mb-1">Products/Categories Distributed</label>
                                <textarea id="products" name="products" rows="3" placeholder="e.g., Seeds, Fertilizers, Pesticides, Farm Equipment" class="input-field w-full"></textarea>
                            </div>

                            <div>
                                <label for="min-order" class="block text-sm font-medium text-gray-700 mb-1">Minimum Order Value (Optional)</label>
                                <input id="min-order" name="min-order" type="number" placeholder="Enter minimum order value in local currency" class="input-field w-full">
                            </div>
                        </div>

                        <div class="flex justify-between pt-6 border-t mt-8">
                            <button type="button" data-prev-step="2" class="prev-step-btn-3 py-3 px-6 border border-gray-300 rounded-lg shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                                ← Back
                            </button>
                            <button type="submit" id="submit-distributor-btn"
                                class="py-3 px-6 border border-transparent rounded-lg shadow-md text-base font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 transform hover:scale-[1.01]">
                                Complete Registration
                            </button>
                        </div>
                    </div>

                    <div id="step-4" data-step="4" class="step-content hidden text-center pt-10 pb-16">
                        <div class="success-circle mb-8">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 0 1 .208 1.04l-9 13.5a.75.75 0 0 1-1.154.114l-6-6a.75.75 0 0 1 1.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 0 1 1.04-.208Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h2 class="text-3xl font-extrabold text-gray-900 mb-3">Registration Complete!</h2>
                        <p class="text-gray-600 mb-8" id="success-message">Welcome to GreenAgro! We are setting up your personalized dashboard now.</p>
                        
                        <a href="login.php" class="py-3 px-8 border border-transparent rounded-lg shadow-md text-base font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                            Login
                        </a>
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
    </body>
    <script>
document.addEventListener("DOMContentLoaded", () => {

    let currentStep = 1;
    let sellerType = "";

    const steps = document.querySelectorAll(".step-content");
    const progressItems = document.querySelectorAll(".step-item");
    const separators = document.querySelectorAll(".step-separator");

    const sellerInput = document.getElementById("seller_type");
    const progressBar = document.getElementById("progress-bar-container");
    const headerText = document.getElementById("main-header-text");
    const stepStatusText = document.getElementById("step-status-text");

    /* ------------------ UTIL FUNCTIONS ------------------ */

    function showStep(step) {
        steps.forEach(s => s.classList.add("hidden"));

        if (step === 2) {
            document.getElementById(
                sellerType === "Farmer" ? "step-2-farmer" : "step-2-distributor"
            ).classList.remove("hidden");
        }
        else if (step === 3) {
            document.getElementById(
                sellerType === "Farmer" ? "step-3-farmer" : "step-3-distributor"
            ).classList.remove("hidden");
        }
        else {
            document.getElementById(`step-${step}`).classList.remove("hidden");
        }

        updateProgress(step);
        currentStep = step;
    }

    function updateProgress(step) {
        progressItems.forEach((item, index) => {
            const stepNum = index + 1;
            item.classList.remove("active", "completed");

            if (stepNum < step) {
                item.classList.add("completed");
            } else if (stepNum === step) {
                item.classList.add("active");
            }
        });

        separators.forEach((sep, index) => {
            sep.classList.toggle("completed", index + 1 < step);
        });
    }

    function validateStep1() {
        const requiredFields = [
            "firstname", "lastname", "mobile", "email", "password"
        ];

        for (let id of requiredFields) {
            const el = document.getElementById(id);
            if (!el.value.trim()) {
                alert("Please fill all required fields.");
                el.focus();
                return false;
            }
        }

        if (!sellerType) {
            alert("Please select Farmer or Distributor.");
            return false;
        }

        if (!document.getElementById("agree-terms").checked) {
            alert("You must agree to Terms & Conditions.");
            return false;
        }

        return true;
    }

    /* ------------------ SELLER TYPE SELECTION ------------------ */

    document.querySelectorAll(".seller-btn").forEach(card => {
        card.addEventListener("click", () => {
            document.querySelectorAll(".seller-card").forEach(c => c.classList.remove("selected"));
            card.classList.add("selected");

            sellerType = card.dataset.type;
            sellerInput.value = sellerType;

            document.getElementById("step-2-label").innerText =
                sellerType === "Farmer" ? "Farm Details" : "Business Details";
            document.getElementById("step-3-label").innerText =
                sellerType === "Farmer" ? "Farm Setup" : "Services";
        });
    });

    /* ------------------ STEP 1 → STEP 2 ------------------ */

    document.querySelector("#step-1 button").addEventListener("click", () => {
        if (!validateStep1()) return;

        progressBar.classList.remove("hidden");
        headerText.innerText = "Complete Your Profile";
        stepStatusText.innerText = "Step 2 of 4";

        showStep(2);
    });

    /* ------------------ NEXT BUTTONS ------------------ */

    document.querySelectorAll(".next-step-btn-2").forEach(btn => {
        btn.addEventListener("click", () => {
            stepStatusText.innerText = "Step 3 of 4";
            showStep(3);
        });
    });

    /* ------------------ PREVIOUS BUTTONS ------------------ */

    document.querySelectorAll("[data-prev-step]").forEach(btn => {
        btn.addEventListener("click", () => {
            const prev = parseInt(btn.dataset.prevStep);
            stepStatusText.innerText = `Step ${prev} of 4`;
            showStep(prev);
        });
    });

    /* ------------------ FORM SUBMIT ------------------ */

document.getElementById("multi-step-form").addEventListener("submit", () => {
    // allow normal form submit to PHP
});

});
</script>
</html>