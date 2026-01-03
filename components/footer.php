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
    
    <style>
        .footer-gradient {
            background: linear-gradient(135deg, #ffffffff 0%, #ffffffff 100%);
        }
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(72, 187, 120, 0.1);
        }
        .newsletter-input {
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        .newsletter-input:focus {
            border-color: #48bb78;
            box-shadow: 0 0 0 3px rgba(72, 187, 120, 0.2);
        }
        .footer-link {
            position: relative;
            transition: all 0.3s ease;
        }
        .footer-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #48bb78;
            transition: width 0.3s ease;
        }
        .footer-link:hover:after {
            width: 100%;
        }
        .social-icon {
            transition: all 0.3s ease;
            border-radius: 50%;
        }
        .social-icon:hover {
            transform: scale(1.1);
            background-color: rgba(72, 187, 120, 0.1);
        }
        .badge {
            background: linear-gradient(45deg, #48bb78, #38a169);
        }
        .scroll-top {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body>
  <footer class="footer-gradient border-t-2 border-green-200 mt-0">
    <!-- Main Footer -->
    <div class="max-w-8xl mx-auto px-6 py-16">
      <!-- Top Section: Newsletter & Brand -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-16 pb-10 border-b border-green-200">
        <!-- Brand & Tagline -->
        <div class="flex flex-col justify-center">
          <div class="flex items-center mb-4">
            <a href="<?php echo $base_url; ?>index.php" class="logo-container" aria-label="GreenAgro Home">
                    <div class="logo"><img src="<?php echo $base_url; ?>assets/image/logo.png"></div>
                    <div class="logo-text">
                        <h1 data-translate="site-name">GreenAgro</h1>
                        <span data-translate="site-tagline">PREMIUM ORGANIC MARKETPLACE</span>
                    </div>
                </a>
          </div>
          <p class="text-gray-700 leading-relaxed">
            Empowering farmers with cutting-edge technology, data-driven insights, and fair market access 
            to revolutionize agriculture for a sustainable future.
          </p>
          
          <!-- App Download Badges -->
          <div class="flex space-x-4 mt-6">
            <div class="badge text-white px-4 py-2 rounded-lg flex items-center space-x-2 hover-lift cursor-pointer">
              <i class="fab fa-google-play"></i>
              <div>
                <p class="text-xs">Get it on</p>
                <p class="font-bold">Google Play</p>
              </div>
            </div>
            <div class="badge text-white px-4 py-2 rounded-lg flex items-center space-x-2 hover-lift cursor-pointer">
              <i class="fab fa-apple"></i>
              <div>
                <p class="text-xs">Download on the</p>
                <p class="font-bold">App Store</p>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Newsletter Subscription -->
        <div class="bg-white p-8 rounded-2xl shadow-md hover-lift">
          <h3 class="text-2xl font-bold mb-3" style="color: #16a34a;">Stay Updated</h3>
          <p class="text-gray-600 mb-6">Subscribe to our newsletter for farming tips, market updates, and platform news.</p>
          
          <form class="space-y-4" id="newsletterForm">
            <div>
              <input 
                type="email" 
                placeholder="Your email address" 
                class="w-full px-4 py-3 newsletter-input rounded-lg focus:outline-none"
                required
              >
            </div>
            <div class="flex items-center">
              <input type="checkbox" id="privacy" class="mr-2" required>
              <label for="privacy" class="text-sm text-gray-600">
                I agree to the privacy policy and terms of service
              </label>
            </div>
            <button 
              type="submit" 
              class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition duration-300"
            >
              Subscribe Now
            </button>
          </form>
          
          <p class="text-xs text-gray-500 mt-4">Join 15,000+ farmers already receiving our updates</p>
        </div>
      </div>
      
      <!-- Middle Section: Links & Services -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 mb-12">
        <!-- Quick Links -->
        <div>
          <h4 class="text-lg font-bold mb-6 pb-2 border-b border-green-200" style="color: #16a34a;">Quick Links</h4>
          <ul class="space-y-4">
            <li>
              <a href="<?php echo $base_url; ?>index.php" class="footer-link text-gray-700 hover:text-green-700 flex items-center">
                <i class="fas fa-home text-green-600 mr-3"></i>
                <span>Home</span>
              </a>
            </li>
            <li>
              <a href="<?php echo $base_url; ?>Includes/features.php" class="footer-link text-gray-700 hover:text-green-700 flex items-center">
                <i class="fas fa-star text-green-600 mr-3"></i>
                <span>Features</span>
              </a>
            </li>
            <li>
              <a href="<?php echo $base_url; ?>Includes/support.php" class="footer-link text-gray-700 hover:text-green-700 flex items-center">
                <i class="fas fa-hands-helping text-green-600 mr-3"></i>
                <span>Support Center</span>
              </a>
            </li>
            <li>
              <a href="<?php echo $base_url; ?>Components/login.php" class="footer-link text-gray-700 hover:text-green-700 flex items-center">
                <i class="fas fa-sign-in-alt text-green-600 mr-3"></i>
                <span>Login / Register</span>
              </a>
            </li>
          </ul>
        </div>
        
        <!-- Services -->
        <div>
          <h4 class="text-lg font-bold mb-6 pb-2 border-b border-green-200" style="color: #16a34a;">Our Services</h4>
          <ul class="space-y-4">
            <li class="flex items-center text-gray-700">
              <div class="p-2 bg-green-100 rounded-lg mr-3">
                <i class="fas fa-plant-wilt text-green-600"></i>
              </div>
              <span>Smart Farm Management</span>
            </li>
            <li class="flex items-center text-gray-700">
              <div class="p-2 bg-green-100 rounded-lg mr-3">
                <i class="fas fa-cloud-sun text-green-600"></i>
              </div>
              <span>Precision Weather Forecast</span>
            </li>
            <li class="flex items-center text-gray-700">
              <div class="p-2 bg-green-100 rounded-lg mr-3">
                <i class="fas fa-money-bill-wave text-green-600"></i>
              </div>
              <span>Live Market Prices</span>
            </li>
            <li class="flex items-center text-gray-700">
              <div class="p-2 bg-green-100 rounded-lg mr-3">
                <i class="fas fa-language text-green-600"></i>
              </div>
              <span>Language Translator</span>
            </li>
          </ul>
        </div>
        
        <!-- Resources -->
        <div>
          <h4 class="text-lg font-bold mb-6 pb-2 border-b border-green-200" style="color: #16a34a;">Resources</h4>
          <ul class="space-y-4">
            <li>
              <a href="#" class="footer-link text-gray-700 hover:text-green-700 flex items-center">
                <i class="fas fa-book-open text-green-600 mr-3"></i>
                <span>Farming Guides</span>
              </a>
            </li>
            <li>
              <a href="#" class="footer-link text-gray-700 hover:text-green-700 flex items-center">
                <i class="fas fa-video text-green-600 mr-3"></i>
                <span>Tutorial Videos</span>
              </a>
            </li>
            <li>
              <a href="#" class="footer-link text-gray-700 hover:text-green-700 flex items-center">
                <i class="fas fa-newspaper text-green-600 mr-3"></i>
                <span>Blog & Articles</span>
              </a>
            </li>
            <li>
              <a href="#" class="footer-link text-gray-700 hover:text-green-700 flex items-center">
                <i class="fas fa-question-circle text-green-600 mr-3"></i>
                <span>FAQ</span>
              </a>
            </li>
          </ul>
        </div>
        
        <!-- Company -->
        <div>
          <h4 class="text-lg font-bold mb-6 pb-2 border-b border-green-200" style="color: #16a34a;">Company</h4>
          <ul class="space-y-4">
            <li>
              <a href="#" class="footer-link text-gray-700 hover:text-green-700 flex items-center">
                <i class="fas fa-users text-green-600 mr-3"></i>
                <span>About Us</span>
              </a>
            </li>
            <li>
              <a href="#" class="footer-link text-gray-700 hover:text-green-700 flex items-center">
                <i class="fas fa-briefcase text-green-600 mr-3"></i>
                <span>Careers</span>
              </a>
            </li>
            <li>
              <a href="#" class="footer-link text-gray-700 hover:text-green-700 flex items-center">
                <i class="fas fa-handshake text-green-600 mr-3"></i>
                <span>Partnerships</span>
              </a>
            </li>
            <li>
              <a href="#" class="footer-link text-gray-700 hover:text-green-700 flex items-center">
                <i class="fas fa-file-contract text-green-600 mr-3"></i>
                <span>Privacy Policy</span>
              </a>
            </li>
          </ul>
        </div>
        
        <!-- Contact Info -->
        <div>
          <h4 class="text-lg font-bold mb-6 pb-2 border-b border-green-200" style="color: #16a34a;">Contact Us</h4>
          <div class="space-y-4">
            <div class="flex items-start">
              <div class="p-2 bg-green-100 rounded-lg mr-3">
                <i class="fas fa-map-marker-alt text-green-600"></i>
              </div>
              <div>
                <p class="font-medium text-gray-800">Our Office</p>
                <p class="text-sm text-gray-600">FarmTech Park, Green Valley, India 560001</p>
              </div>
            </div>
            
            <div class="flex items-center">
              <div class="p-2 bg-green-100 rounded-lg mr-3">
                <i class="fas fa-phone text-green-600"></i>
              </div>
              <div>
                <p class="font-medium text-gray-800">Call Us</p>
                <p class="text-sm text-gray-600">+91 8511903540</p>
              </div>
            </div>
            
            <div class="flex items-center">
              <div class="p-2 bg-green-100 rounded-lg mr-3">
                <i class="fas fa-envelope text-green-600"></i>
              </div>
              <div>
                <p class="font-medium text-gray-800">Email Us</p>
                <p class="text-sm text-gray-600">hello@greenagro.com</p>
              </div>
            </div>
            
            <!-- Social Media -->
            <div class="pt-4">
              <p class="font-medium text-gray-800 mb-3">Follow Us</p>
              <div class="flex space-x-3">
                <a href="#" class="social-icon p-3 text-green-600 hover:text-green-700">
                  <i class="fab fa-facebook-f text-lg"></i>
                </a>
                <a href="#" class="social-icon p-3 text-green-600 hover:text-green-700">
                  <i class="fab fa-instagram text-lg"></i>
                </a>
                <a href="#" class="social-icon p-3 text-green-600 hover:text-green-700">
                  <i class="fab fa-youtube text-lg"></i>
                </a>
                <a href="#" class="social-icon p-3 text-green-600 hover:text-green-700">
                  <i class="fab fa-twitter text-lg"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Trust Badges -->
      <div class="flex flex-wrap justify-center items-center gap-8 py-8 border-t border-b border-green-200">
        <div class="flex items-center">
          <i class="fas fa-shield-alt text-2xl text-green-600 mr-2"></i>
          <div>
            <p class="font-bold text-gray-800">100% Secure</p>
            <p class="text-xs text-gray-600">Data Protection</p>
          </div>
        </div>
        <div class="flex items-center">
          <i class="fas fa-hand-holding-heart text-2xl text-green-600 mr-2"></i>
          <div>
            <p class="font-bold text-gray-800">24/7 Support</p>
            <p class="text-xs text-gray-600">Farmer Assistance</p>
          </div>
        </div>
        <div class="flex items-center">
          <i class="fas fa-trophy text-2xl text-green-600 mr-2"></i>
          <div>
            <p class="font-bold text-gray-800">Award Winning</p>
            <p class="text-xs text-gray-600">Best Agri-Tech 2023</p>
          </div>
        </div>
        <div class="flex items-center">
          <i class="fas fa-users text-2xl text-green-600 mr-2"></i>
          <div>
            <p class="font-bold text-gray-800">50,000+ Farmers</p>
            <p class="text-xs text-gray-600">Trust Our Platform</p>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Bottom Footer -->
    <div class="bg-green-800 text-white" style="background-color: #16a34a;">
      <div class="max-w-8xl mx-auto px-6 py-6 flex flex-col md:flex-row justify-between items-center">
        <div class="mb-4 md:mb-0 text-center md:text-left">
          <p class="text-sm">
            © <?php echo date("Y"); ?> GreenAgro Technologies Pvt. Ltd. All rights reserved.
          </p>
          <p class="text-xs text-green-300 mt-1">
            Committed to sustainable agriculture and farmer empowerment.
          </p>
        </div>
        
        <div class="flex items-center space-x-6">
          <a href="#" class="text-sm hover:text-green-300 transition">Terms of Service</a>
          <a href="#" class="text-sm hover:text-green-300 transition">Privacy Policy</a>
          <a href="#" class="text-sm hover:text-green-300 transition">Cookie Policy</a>
          <a href="#" class="text-sm hover:text-green-300 transition">Sitemap</a>
          
          <!-- Scroll to top button -->
          <button 
            onclick="window.scrollTo({top: 0, behavior: 'smooth'})" 
            class="scroll-top bg-green-600 hover:bg-green-700 text-white p-3 rounded-full ml-4"
            aria-label="Scroll to top"
            style="background-color: #0a5e29ff;"
          >
            <i class="fas fa-arrow-up"></i>
          </button>
        </div>
      </div>
    </div>
  </footer>

  <script>
    // Newsletter form submission
    document.getElementById('newsletterForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const email = this.querySelector('input[type="email"]').value;
      
      // In a real application, you would send this to your server
      console.log('Newsletter subscription:', email);
      
      // Show success message
      alert('Thank you for subscribing to GreenAgro updates!');
      this.reset();
    });
    
    // Add hover effect to all footer links
    document.querySelectorAll('.footer-link').forEach(link => {
      link.addEventListener('mouseenter', function() {
        this.classList.add('text-green-700');
      });
      link.addEventListener('mouseleave', function() {
        this.classList.remove('text-green-700');
      });
    });
  </script>
</body>
</html>