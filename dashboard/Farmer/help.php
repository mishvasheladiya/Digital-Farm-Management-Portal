<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help & Support</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }
        .help-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: 0.2s;
        }
        .help-card:hover {
            transform: translateY(-5px);
        }
        .help-icon {
            font-size: 40px;
            color: #4CAF50;
        }
        .faq-item {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        .section-title {
            font-size: 32px !important;
            font-weight: 700 !important;
            color: #2f6e3f; /* professional green */
        }

        .sub-title {
            font-size: 26px !important;
            font-weight: 600;
            color: #2f6e3f;
        }

    </style>
</head>

<body>
<?php include 'header.php'; ?>
<div class="container py-5">

    <h2 class="section-title mb-4 text-green-700 font-semibold">Help & Support</h2>

    <!-- Help Categories -->
    <div class="row g-4 mb-5">

        <div class="col-md-4">
            <div class="help-card text-center">
                <i class="bi bi-question-circle help-icon"></i>
                <h5 class="mt-3">General Questions</h5>
                <p class="text-muted">Common questions and their solutions.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="help-card text-center">
                <i class="bi bi-person-gear help-icon"></i>
                <h5 class="mt-3">Account Issues</h5>
                <p class="text-muted">Problems related to login, password, etc.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="help-card text-center">
                <i class="bi bi-cart help-icon"></i>
                <h5 class="mt-3">Marketplace Help</h5>
                <p class="text-muted">Buying & selling related queries.</p>
            </div>
        </div>

    </div>

    <!-- FAQ Section -->
    <h4 class="sub-title mb-3">Frequently Asked Questions</h4>

    <div class="faq-item">
        <h6><i class="bi bi-caret-right-fill"></i> How can I reset my password?</h6>
        <p class="text-muted">Go to Settings → Change Password and update your new password.</p>
    </div>

    <div class="faq-item">
        <h6><i class="bi bi-caret-right-fill"></i> How do I contact customer support?</h6>
        <p class="text-muted">Use the Contact Support section below or email us anytime.</p>
    </div>

    <div class="faq-item">
        <h6><i class="bi bi-caret-right-fill"></i> Can I sell my products on the platform?</h6>
        <p class="text-muted">Yes! Register as a seller and upload your items easily.</p>
    </div>

    <div class="faq-item">
        <h6><i class="bi bi-caret-right-fill"></i> How can I view my order history?</h6>
        <p class="text-muted">Go to Profile → Orders to check your order history.</p>
    </div>

    <!-- Contact Support -->
    <h4 class="sub-title mt-5 mb-3">Contact Support</h4>

    <div class="help-card">
        <h6><i class="bi bi-envelope"></i> Email Support</h6>
        <p class="text-muted mb-2">hello@greenagro.com</p>

        <h6><i class="bi bi-telephone"></i> Phone Support</h6>
        <p class="text-muted mb-2">+91 7410852963</p>

    </div>

</div>

</body>
</html>
