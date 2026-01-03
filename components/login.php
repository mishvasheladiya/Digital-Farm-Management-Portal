<?php
$base_url = "/farm/";
require_once "db.php"; 
session_start();

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email    = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = trim($_POST['password']);

    /* ---------- 1. CHECK FARMER ---------- */
    $sql = "SELECT farmer_id, first_name, last_name, email, password FROM farmers WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Note: In production, use password_verify($password, $user['password'])
        if ($password === $user['password']) {
            $_SESSION['user_id']    = $user['farmer_id'];
            $_SESSION['farmer_id']  = $user['farmer_id']; // For products table
            $_SESSION['user_type']  = "Farmer";
            $_SESSION['email']      = $user['email'];    // For profile fetching
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name']  = $user['last_name'];

            echo "<script>alert('Login successful'); window.location.href = '../dashboard/Farmer/dashboard.php';</script>";
            exit;
        }
    }

    /* ---------- 2. CHECK DISTRIBUTOR ---------- */
    $sql = "SELECT distributor_id, first_name, last_name, email, password FROM distributors WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {
            $_SESSION['user_id']    = $user['distributor_id'];
            $_SESSION['user_type']  = "Distributor";
            $_SESSION['email']      = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name']  = $user['last_name'];

            echo "<script>alert('Login successful'); window.location.href = '../dashboard/seller/dashboard.php';</script>";
            exit;
        }
    }

    /* ---------- 3. CHECK ADMIN ---------- */
    $sql = "SELECT Admin_id, email, password FROM admin WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        if ($password === $admin['password']) {
            $_SESSION['user_id']   = $admin['Admin_id'];
            $_SESSION['user_type'] = "Admin";
            $_SESSION['email']     = $admin['email'];

            echo "<script>alert('Admin login successful'); window.location.href = '../dashboard/admin/dashboard.php';</script>";
            exit;
        }
    }

    $error_message = "Invalid email or password";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenAgro | Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #f7fafc; }
        .main-container { max-width: 1200px; }
        .input-field { padding: 12px; border-radius: 8px; border: 1px solid #d1d5db; transition: all 0.2s; }
        .input-field:focus { outline: none; border-color: #10b981; box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.4); }
        .image-column { 
            background-image: url('<?php echo $base_url; ?>assets/image/login.jpg'); 
            background-size: cover; 
            background-position: center; 
        }
        .logo { height: 150px; width: 150px; margin: 0 auto; }
    </style>
</head>
<body class="min-h-screen flex justify-center items-center p-4 sm:p-8">

    <div class="main-container w-full grid grid-cols-1 lg:grid-cols-2 bg-white rounded-3xl shadow-2xl overflow-hidden">

        <div class="image-column hidden lg:block p-8 relative">
            <div class="absolute inset-0 bg-green-700 opacity-60"></div>
            <div class="relative h-full flex flex-col justify-end text-white">
                <h2 class="text-4xl font-bold mb-3 leading-tight">Data-Driven Decisions. Better Harvests.</h2>
                <p class="text-lg font-light">Manage your crops, finances, and tasks all in one seamless portal.</p>
            </div>
        </div>

        <div class="pt-0 px-8 sm:px-12 lg:px-16 pb-8">
            <div class="max-w-md mx-auto">
                <div class="text-center mb-8">
                    <div class="logo">
                        <img src="<?php echo $base_url; ?>assets/image/logo.png" alt="GreenAgro">
                    </div>
                    <h1 class="text-3xl font-extrabold text-gray-900 mt-3">Welcome Back</h1>
                    <p class="mt-1 text-gray-500">Sign in to access your farm data</p>
                </div>

                <?php if ($error_message): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-center">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                        <input name="email" type="email" required placeholder="Enter Your Email" class="input-field w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input name="password" type="password" required placeholder="Enter Your Password" class="input-field w-full">
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-green-600 border-gray-300 rounded">
                            <label class="ml-2 text-gray-700">Remember me</label>
                        </div>
                        <a href="forgot-password.php" class="text-green-600 hover:text-green-500">Forgot password?</a>
                    </div>

                    <button type="submit" class="w-full py-3 rounded-lg text-white bg-green-600 hover:bg-green-700 shadow-md transition-colors font-bold">
                        Sign in
                    </button>
                </form>

                <div class="mt-6 text-center text-sm text-gray-500 border-t pt-4">
                    <p>Don't have an account? <a href="register.php" class="text-green-600 hover:text-green-500 font-semibold">Sign up here</a></p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>