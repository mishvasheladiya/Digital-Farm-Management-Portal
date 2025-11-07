<?php
if (!isset($base_url)) {
    $base_url = '/GreenAgro/';
}
$about_video_link = 'https://www.youtube.com/watch?v=YOUR_GREENAGRO_STORY'; // Use a dedicated video link
$about_image_path = $base_url . '../assets/images/GreenAgro_team.jpg'; // Compelling image for the video poster
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenAgro - Digital Farm Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/header.css">
</head>

<body>
    <!-- Top Info Bar -->
    <div class="top-info">
        <div class="top-info-content">
            <div class="top-info-left">
                <a href="tel:+918511916407" id="call-link" aria-label="Call us" title="+91 8511916407">
                    <i class="fas fa-phone-alt"></i>
                    <span>+91 8511916407</span>
                </a>

                <a href="mailto:hello@greenagro.com" aria-label="Email us" title="hello@greenagro.com">
                    <i class="fas fa-envelope"></i>
                    <span>hello@greenagro.com</span>
                </a>

                <a href="#product-finder" aria-label="Find GreenAgroing products" onclick="openProductFinder(event)">
                    <i class="fas fa-search-plus"></i>
                    <span>Find Products</span>
                </a>
            </div>

            <div class="top-info-right">
                <a href="#track-order" aria-label="Track your order" onclick="openTrackOrderModal(event)">
                    <i class="fas fa-shipping-fast"></i>
                    <span>Track Order</span>
                </a>
                <a href="#support" aria-label="Customer support" onclick="openSupportModal(event)">
                    <i class="fas fa-headset"></i>
                    <span>24/7 Support</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Track Order Modal -->
    <div class="track-order-modal" id="trackOrderModal">
        <div class="modal-overlay" onclick="closeTrackOrderModal()"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-shipping-fast"></i> Track Your Order</h2>
                <button class="close-modal" onclick="closeTrackOrderModal()" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="track-order-form">
                    <div class="form-group">
                        <label for="orderId">Enter Your Order ID</label>
                        <input
                            type="text"
                            id="orderId"
                            class="form-control"
                            placeholder="e.g., GRN123456789"
                            autocomplete="off">
                    </div>
                    <button class="track-btn" onclick="trackOrder()">
                        <i class="fas fa-search"></i> Track Order
                    </button>
                </div>

                <div class="order-info" id="orderInfo">
                    <div class="order-header">
                        <h3><i class="fas fa-box"></i> Order Details</h3>
                    </div>
                    <div class="order-details">
                        <div class="order-status">
                            <div class="status-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div class="status-text" id="orderStatus">Order Shipped</div>
                        </div>

                        <div class="order-timeline" id="orderTimeline">
                            <!-- Timeline will be dynamically generated -->
                        </div>

                        <div class="order-items">
                            <h4>Order Items</h4>
                            <div id="orderItems">
                                <!-- Order items will be dynamically generated -->
                            </div>
                        </div>

                        <div class="order-summary">
                            <div class="summary-row">
                                <span>Subtotal:</span>
                                <span id="subtotal">₹0</span>
                            </div>
                            <div class="summary-row">
                                <span>Shipping:</span>
                                <span id="shipping">₹0</span>
                            </div>
                            <div class="summary-row">
                                <span>Tax:</span>
                                <span id="tax">₹0</span>
                            </div>
                            <div class="summary-row total">
                                <span>Total:</span>
                                <span id="total">₹0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="support-modal" id="supportModal">
        <div class="modal-overlay" onclick="closeSupportModal()"></div>
        <div class="support-content">
            <div class="support-header">
                <h3><i class="fas fa-headset"></i> 24/7 Customer Support</h3>
                <p>We're here to help you anytime</p>
            </div>
            <div class="support-options">
                <div class="support-option" onclick="contactSupport('phone')">
                    <div class="support-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="support-info">
                        <h4>Call Us</h4>
                        <p>+91 8511916407 (24/7 Available)</p>
                    </div>
                </div>
                <div class="support-option" onclick="contactSupport('whatsapp')">
                    <div class="support-icon">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div class="support-info">
                        <h4>WhatsApp</h4>
                        <p>Quick chat support</p>
                    </div>
                </div>
                <div class="support-option" onclick="contactSupport('email')">
                    <div class="support-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="support-info">
                        <h4>Email</h4>
                        <p>hello@greenagro.com</p>
                    </div>
                </div>
                <div class="support-option" onclick="contactSupport('chat')">
                    <div class="support-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="support-info">
                        <h4>Live Chat</h4>
                        <p>Instant messaging support</p>
                    </div>
                </div>
            </div>
            <button class="close-modal" onclick="closeSupportModal()" style="position: absolute; top: 15px; right: 15px; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #666;">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <div id="notification" class="notification">
        <i class="fas fa-check-circle"></i>
        <span id="notificationText"></span>
    </div>

    <!-- Announcement Bar -->
    <div class="announcement-bar" id="announcement">
        <div class="announcement-content">
            <div class="announcement-text">
                <div class="announcement-item">
                    <i class="fas fa-truck"></i>
                    <span>FREE Delivery on ₹2000+</span>
                </div>
                <div class="announcement-item">
                    <i class="fas fa-leaf"></i>
                    <span>100% Organic Certified</span>
                </div>
                <div class="announcement-item">
                    <i class="fas fa-clock"></i>
                    <span>Same Day Fresh Delivery</span>
                </div>
                <div class="announcement-item">
                    <i class="fas fa-award"></i>
                    <span>Premium Quality Guaranteed</span>
                </div>
                <div class="announcement-item">
                    <i class="fas fa-shield-alt"></i>
                    <span>GreenAgro to Table Freshness</span>
                </div>
            </div>
            <button class="close-announcement" onclick="closeAnnouncement()" aria-label="Close announcement">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <!-- JavaScript for interactivity -->
    <script src="<?php echo $base_url; ?>assets/js/header.js"></script>
</body>

</html>