<?php
// Set a default base_url if it's not set elsewhere (like a config file)
if (!isset($base_url)) {
    $base_url = '/farm/';
}

// NOTE: We assume 'logo_light.png' exists for the dark header background.
// If you don't have a light logo, you should use the PHP variable 
// for the dark background logo here: 'logo_dark_path'
$logo_light_path = $base_url . 'assets/image/logo_light.png'; 
?>

<footer class="bg-green-700 text-white pt-16 pb-10 shadow-inner">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-12">
            
            <div class="col-span-2 md:col-span-1">
                <a href="<?php echo $base_url; ?>index.php">
                    <div class="flex items-center space-x-2 mb-4">
                         <img src="<?php echo $base_url; ?>assets/image/logo2.png"
                             alt="FarmTech Logo" 
                             class="rounded-full shadow-md w-10 h-10 filter brightness-150"> <span class="text-xl font-bold text-white">FarmTech</span>
                    </div>
                </a>
                <p class="text-green-200 text-sm leading-relaxed max-w-xs">
                    Driving farm profitability and sustainability with unified, intelligent operations.
                </p>
                
                <div class="mt-6">
                    <p class="text-sm font-semibold text-green-300 mb-1">Talk to Sales</p>
                    <p class="text-xl font-extrabold text-white">+91 987 654 3210</p>
                </div>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-white mb-4 border-b-2 border-green-300 inline-block pb-1">Platform</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="#" class="text-green-200 hover:text-white transition">Field Management</a></li>
                    <li><a href="#" class="text-green-200 hover:text-white transition">Asset Tracking</a></li>
                    <li><a href="#" class="text-green-200 hover:text-white transition">Yield Analytics</a></li>
                    <li><a href="#" class="text-green-200 hover:text-white transition">IoT Integrations</a></li>
                    <li><a href="<?php echo $base_url; ?>pricing.php" class="text-green-300 hover:text-white transition font-bold">Pricing & Packages</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-lg font-semibold text-white mb-4 border-b-2 border-green-300 inline-block pb-1">Company</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="<?php echo $base_url; ?>about.php" class="text-green-200 hover:text-white transition">Our Story</a></li>
                    <li><a href="<?php echo $base_url; ?>careers.php" class="text-green-200 hover:text-white transition">Careers</a></li>
                    <li><a href="<?php echo $base_url; ?>support.php" class="text-green-200 hover:text-white transition">Help Center</a></li>
                    <li><a href="<?php echo $base_url; ?>blog.php" class="text-green-200 hover:text-white transition">Blog & Insights</a></li>
                    <li><a href="<?php echo $base_url; ?>request-demo.php" class="text-white hover:text-green-300 transition font-bold bg-green-600 px-3 py-1 rounded-full text-xs inline-block">Book a Demo &rarr;</a></li>
                </ul>
            </div>
            
            <div class="col-span-2 md:col-span-1">
                <h4 class="text-lg font-semibold text-white mb-4 border-b-2 border-green-300 inline-block pb-1">Connect</h4>
                
                <p class="text-green-200 text-sm mb-4">Follow us for updates and farming news.</p>
                
                <div class="flex space-x-4 mb-8">
                    <a href="#" class="text-green-300 hover:text-white transition transform hover:scale-110">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.791-1.574 2.153-2.723-.951.564-2.005.974-3.127 1.188-.936-.995-2.288-1.62-3.795-1.62-3.418 0-6.182 2.764-6.182 6.182 0 .484.053.952.148 1.403-5.144-.258-9.68-2.733-12.72-6.489-.53.914-.83 1.968-.83 3.12 0 2.144 1.096 4.043 2.766 5.146-.81-.025-1.572-.247-2.235-.616v.077c0 2.99 2.13 5.488 4.93 6.071-.518.14-1.066.216-1.627.216-.4 0-.78-.038-1.155-.11.782 2.454 3.064 4.246 5.785 4.298-2.083 1.631-4.723 2.59-7.59 2.59-.493 0-.98-.029-1.46-.086 2.756 1.766 6.03 2.795 9.57 2.795 11.485 0 17.76-9.524 17.76-17.756 0-.27-.006-.538-.017-.806.969-.699 1.808-1.574 2.478-2.556z"/></svg>
                    </a>
                    <a href="#" class="text-green-300 hover:text-white transition transform hover:scale-110">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.477 2 2 6.477 2 12c0 4.991 3.842 9.096 8.847 9.876V14.8h-2.27V12h2.27V9.33c0-2.25 1.373-3.483 3.38-3.483 0.963 0 1.963.171 1.963.171v2.15h-1.1c-1.117 0-1.463.693-1.463 1.407V12h3.58l-.57 2.8h-3.01v6.953C17.158 21.096 21 17.991 21 12c0-5.523-4.477-10-10-10z"/></svg>
                    </a>
                    <a href="#" class="text-green-300 hover:text-white transition transform hover:scale-110">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M22.23 0H1.77C.794 0 0 .794 0 1.77v20.46C0 23.206.794 24 1.77 24h20.46c.976 0 1.77-.794 1.77-1.77V1.77c0-.976-.794-1.77-1.77-1.77zm-18.42 19.34h-2.92V9h2.92v10.34zM5.56 7.42c-.75 0-1.23-.48-1.23-1.08S4.81 5.26 5.56 5.26c.74 0 1.22.48 1.22 1.08s-.48 1.08-1.22 1.08zm15.82 11.92h-2.9V14.6c0-1.23-.46-2.07-1.55-2.07-.85 0-1.35.58-1.57 1.15-.1.2-.13.5-.13.79v4.87h-2.91s.04-9.3 0-10.34h2.91v1.31c.42-.71 1.25-1.73 2.7-1.73 1.96 0 3.4 1.28 3.4 4.04v6.72z"/></svg>
                    </a>
                </div>
                
                <form action="#" method="POST" class="flex flex-col space-y-3">
                    <input type="email" placeholder="Email for our newsletter" required 
                           class="w-full px-4 py-2 rounded-lg bg-green-600 border border-green-500 text-white placeholder-green-200 focus:ring-green-300 focus:border-green-300 text-sm">
                    <button type="submit" 
                            class="w-full bg-white text-green-700 py-2 rounded-lg font-bold hover:bg-green-50 transition shadow-lg">
                        Sign Up
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-16 pt-8 border-t border-green-600 flex flex-col md:flex-row justify-between items-center text-sm text-green-300">
            <p>&copy; <?php echo date("Y"); ?> FarmTech Solutions, Inc. All rights reserved.</p>
            <div class="flex flex-wrap justify-center md:justify-end space-x-6 mt-4 md:mt-0">
                <a href="<?php echo $base_url; ?>legal/privacy.php" class="hover:text-white transition">Privacy Policy</a>
                <a href="<?php echo $base_url; ?>legal/terms.php" class="hover:text-white transition">Terms of Service</a>
                <a href="<?php echo $base_url; ?>legal/sitemap.php" class="hover:text-white transition">Sitemap</a>
            </div>
        </div>
        
    </div>
</footer>