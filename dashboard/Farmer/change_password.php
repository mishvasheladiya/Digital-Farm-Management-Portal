<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Change Password</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background: #eef2ef;
        font-family: 'Segoe UI', sans-serif;
    }

    .password-card {
        background: #fff;
        padding: 40px;
        border-radius: 20px;
        max-width: 550px;
        margin: 70px auto;
        box-shadow: 0 6px 30px rgba(0,0,0,0.1);
        transition: 0.3s;
        border: 1px solid #e8e8e8;
    }

    .password-card:hover {
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #1b5e20;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 5px;
        color: #333;
    }

    .password-box {
        position: relative;
    }

    .password-box i {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
        cursor: pointer;
        color: #777;
        transition: 0.2s;
    }

    .password-box i:hover {
        color: #1b5e20;
    }

    .form-control {
        height: 48px;
        border-radius: 12px;
        border: 1.6px solid #d9e2d9;
        transition: 0.25s;
    }

    .form-control:focus {
        border-color: #1b5e20;
        box-shadow: 0 0 0 0.15rem rgba(27,94,32,0.25);
    }

    .strength-meter {
        height: 7px;
        border-radius: 5px;
        background: #e0e0e0;
        margin-top: 7px;
        overflow: hidden;
    }

    .strength-level {
        height: 100%;
        width: 0%;
        transition: width .35s ease;
        border-radius: 5px;
    }

    .btn-save {
        background: #1b5e20;
        color: white;
        font-weight: 600;
        padding: 12px;
        border-radius: 12px;
        width: 100%;
        transition: .3s;
        font-size: 16px;
        letter-spacing: 0.5px;
    }

    .btn-save:hover {
        background: #124016;
        transform: translateY(-1px);
        box-shadow: 0 3px 12px rgba(0,0,0,0.15);
    }
</style>
</head>

<body>

<?php include_once 'header.php'; ?>

<div class="password-card">

    <h2 class="page-title mb-3">
        <i class="bi bi-shield-lock me-2"></i>
        Change Password
    </h2>
    <p class="text-muted mb-4">
        Update your password regularly to keep your account safe.
    </p>

    <form>

        <!-- Current Password -->
        <div class="mb-4 password-box">
            <label class="form-label">Current Password</label>
            <input type="password" class="form-control" id="currentPass" placeholder="Enter current password">
        </div>

        <!-- New Password -->
        <div class="mb-4 password-box">
            <label class="form-label">New Password</label>
            <input type="password" class="form-control" id="newPass" placeholder="Create new password" oninput="checkStrength()">

            <div class="strength-meter mt-2">
                <div id="strengthBar" class="strength-level"></div>
            </div>
            <small id="strengthText" class="text-muted"></small>
        </div>

        <!-- Confirm Password -->
        <div class="mb-4 password-box">
            <label class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" id="confirmPass" placeholder="Re-enter new password">
        </div>

        <button class="btn btn-save mt-2">Save Password</button>

    </form>

</div>



<script>
function togglePass(id, icon) {
    const input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
        icon.classList.replace("bi-eye-slash", "bi-eye");
    } else {
        input.type = "password";
        icon.classList.replace("bi-eye", "bi-eye-slash");
    }
}

function checkStrength() {
    const pass = document.getElementById("newPass").value;
    const bar = document.getElementById("strengthBar");
    const text = document.getElementById("strengthText");

    let strength = 0;

    if (pass.length > 6) strength++;
    if (pass.length > 10) strength++;
    if (/[0-9]/.test(pass)) strength++;
    if (/[A-Z]/.test(pass)) strength++;
    if (/[@$!%*#?&]/.test(pass)) strength++;

    if (strength <= 1) {
        bar.style.width = "20%";
        bar.style.background = "#e53935";
        text.innerHTML = "Weak Password";
        text.style.color = "#e53935";
    } else if (strength <= 3) {
        bar.style.width = "60%";
        bar.style.background = "#f9a825";
        text.innerHTML = "Moderate Password";
        text.style.color = "#f9a825";
    } else {
        bar.style.width = "100%";
        bar.style.background = "#43a047";
        text.innerHTML = "Strong Password";
        text.style.color = "#43a047";
    }
}
</script>

</body>
</html>
