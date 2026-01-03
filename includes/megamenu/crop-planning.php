<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenAgro</title>
</head>
<body>
    <?php
// crop-planning.php
$base_url = '/farm/';
?>
  <?php include 'D:\Xampp\htdocs\farm\components\header.php'; ?>
      <?php include 'D:\Xampp\htdocs\farm\components\navbar.php'; ?>

<!-- 🌱 MAIN CONTENT -->
<section style="font-family: 'Poppins', sans-serif; padding: 70px 8%; background-color: #f9fafb;">
    <div style="text-align: center; margin-bottom: 50px;">
        <h2 style="color: #1A4D2E; font-size: 2rem; font-weight: 700;">Smart Planning for Better Yield</h2>
        <p style="color: #555; font-size: 1rem; max-width: 700px; margin: 15px auto;">
            Use data-driven planning to decide which crops to grow, when to sow, and how to allocate your resources effectively.
        </p>
    </div>

    <!-- Feature Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px;">
        
        <!-- CARD 1 -->
        <div style="background: #fff; border-radius: 14px; box-shadow: 0 3px 10px rgba(0,0,0,0.08); overflow: hidden; transition: transform 0.3s;">
            <img src="<?php echo $base_url; ?>assets/image/header/Seasonal.jpg" alt="Seasonal Planning" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 25px;">
                <h3 style="color: #1A4D2E; font-size: 1.3rem; margin-bottom: 10px;">Seasonal Planning</h3>
                <p style="color: #555;">Align your planting and harvesting schedules with local climate and rainfall patterns for maximum productivity.</p>
            </div>
        </div>

        <!-- CARD 2 -->
        <div style="background: #fff; border-radius: 14px; box-shadow: 0 3px 10px rgba(0,0,0,0.08); overflow: hidden; transition: transform 0.3s;">
            <img src="<?php echo $base_url; ?>assets/image/header/Seed.jpg" alt="Seed Selection" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 25px;">
                <h3 style="color: #1A4D2E; font-size: 1.3rem; margin-bottom: 10px;">Seed Selection</h3>
                <p style="color: #555;">Choose high-yield and disease-resistant varieties based on your region’s soil and weather data.</p>
            </div>
        </div>

        <!-- CARD 3 -->
        <div style="background: #fff; border-radius: 14px; box-shadow: 0 3px 10px rgba(0,0,0,0.08); overflow: hidden; transition: transform 0.3s;">
            <img src="<?php echo $base_url; ?>assets/image/header/Resource.jpg" alt="Resource Allocation" style="width: 100%; height: 200px; object-fit: cover;">
            <div style="padding: 25px;">
                <h3 style="color: #1A4D2E; font-size: 1.3rem; margin-bottom: 10px;">Resource Allocation</h3>
                <p style="color: #555;">Plan water, fertilizer, and labor efficiently to ensure cost-effective operations and better yield results.</p>
            </div>
        </div>

    </div>
</section>

<!-- ✅ TIPS SECTION -->
<section style="background-color: #1A4D2E; color: white; padding: 60px 8%; text-align: center;">
    <h2 style="font-size: 1.8rem; font-weight: 600; margin-bottom: 15px;">Pro Tips for Successful Crop Planning</h2>
    <p style="max-width: 750px; margin: 0 auto 40px; line-height: 1.6;">
        Keep records of soil tests, rainfall data, and past crop yields to refine your planning decisions every season.
    </p>
    <a href="#" style="background: #fff; color: #1A4D2E; padding: 12px 25px; border-radius: 8px; font-weight: 600; text-decoration: none;">
        Learn More
    </a>
</section>

  <?php include 'D:\Xampp\htdocs\farm\components\footer.php'; ?>

</body>
</html>