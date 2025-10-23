<?php
// Set a default base_url if it's not set elsewhere (like a config file)
if (!isset($base_url)) {
    $base_url = '/farm/';
}

// Define specific paths for the About Us section
// We're going back to a single clickable video link for the best user experience (UX)
$about_video_link = 'https://www.youtube.com/watch?v=YOUR_GREENAGRO_STORY'; // Use a dedicated video link
$about_image_path = $base_url . 'assets/image/farm_team.jpg'; // Compelling image for the video poster
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GreenAgro</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    /* Carousel styles from your existing code (omitted for brevity) */
    .video-carousel {
      position: relative;
      width: 100%;
      height: 600px;
      overflow: hidden;
    }
    .video-slide.active {
      opacity: 1;
      z-index: 1;
    }
    .video-slide video {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* --- NEW TIMELINE/STORY STYLES --- */

    /* Container for the video image/poster */
    .video-poster-container {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 aspect ratio */
        height: 0;
        overflow: hidden;
        cursor: pointer;
    }

    .video-poster-container img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .video-poster-container:hover img {
        transform: scale(1.03); /* Slight zoom effect on hover */
    }

    /* Play Button centered over the image */
    .play-button-center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80px;
        height: 80px;
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); 
        animation: pulse-ring 2s infinite;
    }

    .play-button-center:hover {
        background-color: white;
        transform: translate(-50%, -50%) scale(1.15);
    }
    
    @keyframes pulse-ring {
        0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
        70% { box-shadow: 0 0 0 20px rgba(16, 185, 129, 0); }
        100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }

    /* Vertical Timeline Separator */
    .timeline-separator {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 100%;
        background: #d1fae5; /* Green-100 */
        border-radius: 9999px;
    }
    /* Timeline Dots */
    .timeline-dot {
        position: absolute;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 20px;
        height: 20px;
        background: #10b981; /* Green-600 */
        border-radius: 50%;
        z-index: 10;
        border: 4px solid #f9fafb; /* White background border */
    }
  </style>
</head>

<body>
<?php include 'components/header.php'; ?>
  <section class="video-carousel">
    <div class="video-slide active">
      <video autoplay muted loop>
        <source src="<?php echo $base_url; ?>assets/image/farm1.mp4" type="video/mp4" />
      </video>
    </div>
  </section>

  <section class="py-20 bg-white sm:py-32">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center mb-16">
        <p class="text-sm font-bold text-green-700 uppercase tracking-widest mb-2">
          Our Journey
        </p>
        <h2 class="text-4xl font-extrabold text-gray-900 sm:text-5xl leading-tight max-w-3xl mx-auto">
          From a Farmer's Idea to a Global <span class="text-green-600">Ag-Tech Leader</span>.
        </h2>
      </div>

      <div class="relative pt-8">
        
        <div class="timeline-separator"></div>

        <div class="relative pt-12">
            <div class="timeline-dot top-0"></div>
            <div class="max-w-xl mx-auto text-center p-6 bg-green-50 rounded-xl shadow-lg border-t-4 border-green-600 transform hover:scale-[1.01] transition duration-300">
                <p class="text-xs font-semibold text-gray-500 uppercase">Phase 1: 2018 - The Seed</p>
                <h3 class="mt-2 text-2xl font-bold text-gray-900">Identifying the Need for Change</h3>
                <p class="mt-3 text-gray-600">
                    GreenAgro was founded by farmers, for farmers. We recognized the need for simple, data-driven tools to combat rising costs and unpredictable weather patterns, starting with our first MVP focused on soil monitoring.
                </p>
            </div>
        </div>

<div class="mt-12 mb-16 relative group">
          <div class="video-container-centered shadow-2xl overflow-hidden rounded-xl transition duration-500 group-hover:shadow-green-500/70 group-hover:scale-[1.005]">
              <video 
                  autoplay 
                  muted 
                  loop 
                  playsinline 
                  poster="<?php echo $about_image_path; ?>" 
                  class="w-full h-full"
              >
                  <source src="<?php echo $base_url; ?>assets/image/farm4.mp4" type="video/mp4">
                  Your browser does not support the video tag.
              </video>
          </div>
          <div class="absolute inset-0 bg-black opacity-10 rounded-xl pointer-events-none"></div>
      </div>
        
        <div class="relative pt-12">
            <div class="timeline-dot top-0"></div>
            <div class="max-w-xl mx-auto text-center p-6 bg-green-50 rounded-xl shadow-lg border-t-4 border-green-600 transform hover:scale-[1.01] transition duration-300">
                <p class="text-xs font-semibold text-gray-500 uppercase">Phase 2: Today - Proven Impact</p>
                <h3 class="mt-2 text-2xl font-bold text-gray-900">Scaling Up Sustainable Solutions</h3>
                <p class="mt-3 text-gray-600">
                    Today, over **1,500 farmers** rely on GreenAgro for everything from drone mapping to financial compliance. We've established ourselves as a leader in sustainable farming, delivering an average yield increase of 25% to our users.
                </p>
            </div>
        </div>

      </div>

      <div class="mt-20 pt-10 border-t border-gray-200 max-w-xl mx-auto">
        <h3 class="text-3xl font-bold text-gray-900 mb-4">Ready to Grow with Us?</h3>
        <p class="text-lg text-gray-600 mb-8">
            Whether you want to optimize your harvest or join our mission, the next chapter starts now.
        </p>
        <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
            <a href="<?php echo $base_url; ?>includes/contact.php" class="px-8 py-3 border border-transparent text-lg font-bold rounded-full shadow-xl text-white bg-green-600 hover:bg-green-700 transition duration-300 transform hover:scale-105">
              Request a Demo &rarr;
            </a>
            <a href="<?php echo $base_url; ?>components/login.php" class="px-8 py-3 border border-green-300 text-lg font-medium rounded-full shadow-md text-green-700 bg-white hover:bg-green-50 transition duration-300">
              Explore Careers
            </a>
        </div>
      </div>
      
    </div>
  </section>

  <?php include 'components/footer.php'; ?>
</body>
</html>