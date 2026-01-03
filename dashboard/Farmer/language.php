<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Language Settings</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
    body {
        background: #f1f7f0;
        font-family: 'Poppins', sans-serif;
    }

    .page-title {
        font-size: 32px;
        font-weight: 700;
        color: #2d6a4f;
    }

    .lang-card {
        background: white;
        padding: 20px;
        border-radius: 18px;
        border: 1px solid #d8e9d4;
        transition: 0.3s;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        cursor: pointer;
    }

    .lang-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .lang-selected {
        border: 2px solid #2d6a4f !important;
    }

    .lang-icon {
        width: 50px;
        height: 50px;
        background: #e8f8ea;
        border-radius: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 22px;
        color: #2d6a4f;
        margin-right: 15px;
    }

    .save-btn {
        background: #2d6a4f;
        color: white;
        padding: 12px 25px;
        border-radius: 12px;
        font-size: 18px;
        border: none;
    }

    .save-btn:hover {
        background: #245c42;
    }
</style>

<script>
function selectLanguage(card, lang) {
    // Remove 'selected' from all cards
    document.querySelectorAll('.lang-card').forEach(c => c.classList.remove('lang-selected'));

    // Add selected class
    card.classList.add('lang-selected');

    // Save selected language to hidden input
    document.getElementById("selectedLang").value = lang;
}
</script>
</head>

<body>
<?php include 'header.php'; ?>
<div class="container py-5">
    
    <h2 class="page-title mb-3"><i class="fa-solid fa-language"></i> Language Settings</h2>
    <p class="text-muted mb-4">Choose your preferred language for using the dashboard.</p>

    <form action="#" method="POST">
        <input type="hidden" id="selectedLang" name="selected_language">

        <div class="row g-4">

            <!-- Hindi -->
            <div class="col-md-4">
                <div class="lang-card" onclick="selectLanguage(this, 'Hindi')">
                    <div class="d-flex align-items-center">
                        <div class="lang-icon"><i class="fa-solid fa-font"></i></div>
                        <div>
                            <h5 class="mb-0">Hindi</h5>
                            <small class="text-muted">हिन्दी</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- English -->
            <div class="col-md-4">
                <div class="lang-card" onclick="selectLanguage(this, 'English')">
                    <div class="d-flex align-items-center">
                        <div class="lang-icon"><i class="fa-solid fa-font"></i></div>
                        <div>
                            <h5 class="mb-0">English</h5>
                            <small class="text-muted">English</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gujarati -->
            <div class="col-md-4">
                <div class="lang-card" onclick="selectLanguage(this, 'Gujarati')">
                    <div class="d-flex align-items-center">
                        <div class="lang-icon"><i class="fa-solid fa-font"></i></div>
                        <div>
                            <h5 class="mb-0">Gujarati</h5>
                            <small class="text-muted">ગુજરાતી</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Marathi -->
            <div class="col-md-4">
                <div class="lang-card" onclick="selectLanguage(this, 'Marathi')">
                    <div class="d-flex align-items-center">
                        <div class="lang-icon"><i class="fa-solid fa-font"></i></div>
                        <div>
                            <h5 class="mb-0">Marathi</h5>
                            <small class="text-muted">मराठी</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Punjabi -->
            <div class="col-md-4">
                <div class="lang-card" onclick="selectLanguage(this, 'Punjabi')">
                    <div class="d-flex align-items-center">
                        <div class="lang-icon"><i class="fa-solid fa-font"></i></div>
                        <div>
                            <h5 class="mb-0">Punjabi</h5>
                            <small class="text-muted">ਪੰਜਾਬੀ</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bengali -->
            <div class="col-md-4">
                <div class="lang-card" onclick="selectLanguage(this, 'Bengali')">
                    <div class="d-flex align-items-center">
                        <div class="lang-icon"><i class="fa-solid fa-font"></i></div>
                        <div>
                            <h5 class="mb-0">Bengali</h5>
                            <small class="text-muted">বাংলা</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tamil -->
            <div class="col-md-4">
                <div class="lang-card" onclick="selectLanguage(this, 'Tamil')">
                    <div class="d-flex align-items-center">
                        <div class="lang-icon"><i class="fa-solid fa-font"></i></div>
                        <div>
                            <h5 class="mb-0">Tamil</h5>
                            <small class="text-muted">தமிழ்</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Telugu -->
            <div class="col-md-4">
                <div class="lang-card" onclick="selectLanguage(this, 'Telugu')">
                    <div class="d-flex align-items-center">
                        <div class="lang-icon"><i class="fa-solid fa-font"></i></div>
                        <div>
                            <h5 class="mb-0">Telugu</h5>
                            <small class="text-muted">తెలుగు</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kannada -->
            <div class="col-md-4">
                <div class="lang-card" onclick="selectLanguage(this, 'Kannada')">
                    <div class="d-flex align-items-center">
                        <div class="lang-icon"><i class="fa-solid fa-font"></i></div>
                        <div>
                            <h5 class="mb-0">Kannada</h5>
                            <small class="text-muted">ಕನ್ನಡ</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Malayalam -->
            <div class="col-md-4">
                <div class="lang-card" onclick="selectLanguage(this, 'Malayalam')">
                    <div class="d-flex align-items-center">
                        <div class="lang-icon"><i class="fa-solid fa-font"></i></div>
                        <div>
                            <h5 class="mb-0">Malayalam</h5>
                            <small class="text-muted">മലയാളം</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Urdu -->
            <div class="col-md-4">
                <div class="lang-card" onclick="selectLanguage(this, 'Urdu')">
                    <div class="d-flex align-items-center">
                        <div class="lang-icon"><i class="fa-solid fa-font"></i></div>
                        <div>
                            <h5 class="mb-0">Urdu</h5>
                            <small class="text-muted">اردو</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Odia -->
            <div class="col-md-4">
                <div class="lang-card" onclick="selectLanguage(this, 'Odia')">
                    <div class="d-flex align-items-center">
                        <div class="lang-icon"><i class="fa-solid fa-font"></i></div>
                        <div>
                            <h5 class="mb-0">Odia</h5>
                            <small class="text-muted">ଓଡ଼ିଆ</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Assamese -->
            <div class="col-md-4">
                <div class="lang-card" onclick="selectLanguage(this, 'Assamese')">
                    <div class="d-flex align-items-center">
                        <div class="lang-icon"><i class="fa-solid fa-font"></i></div>
                        <div>
                            <h5 class="mb-0">Assamese</h5>
                            <small class="text-muted">অসমীয়া</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="text-center mt-5">
            <button class="save-btn"><i class="fa-solid fa-save"></i> Save Language</button>
        </div>
    </form>

</div>

</body>
</html>
