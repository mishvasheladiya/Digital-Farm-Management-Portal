<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "farm");

// 1. Fetch Current Data to populate the form
$admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : 1;
$query = "SELECT * FROM admin WHERE admin_id = '$admin_id'";
$result = mysqli_query($conn, $query);
$admin = mysqli_fetch_assoc($result);

$message = "";

// 2. Handle the Form Submission
if (isset($_POST['update_profile'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Checkboxes/Toggles logic
    $two_fa = isset($_POST['two_fa']) ? 1 : 0;
    $n_email = isset($_POST['notify_email']) ? 1 : 0;
    $n_order = isset($_POST['notify_order']) ? 1 : 0;
    $n_system = isset($_POST['notify_system']) ? 1 : 0;

    // Handle Image Upload
    $avatar_sql = "";
    if (!empty($_FILES['avatar']['name'])) {
        $target_dir = "assets/image/";
        $file_name = time() . "_" . $_FILES['avatar']['name'];
        $target_file = $target_dir . $file_name;
        
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file)) {
            $db_path = "assets/image/" . $file_name;
            $avatar_sql = ", avatar = '$db_path'";
        }
    }

    // Handle Password (only if field is not empty)
    $password_sql = "";
    if (!empty($_POST['password'])) {
        $new_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $password_sql = ", password = '$new_pass'";
    }

    // UPDATE QUERY
    $update_query = "UPDATE admin SET 
        name = '$name', 
        email = '$email',
        two_fa = '$two_fa',
        notify_email = '$n_email',
        notify_order = '$n_order',
        notify_system = '$n_system'
        $avatar_sql
        $password_sql
        WHERE admin_id = '$admin_id'";

    if (mysqli_query($conn, $update_query)) {
        header("Location: profile.php?success=1");
        exit;
    } else {
        $message = "Error updating record: " . mysqli_error($conn);
    }
}

include 'header.php';
?>

<main class="max-w-4xl mx-auto px-4 py-10">
    <form action="" method="POST" enctype="multipart/form-data">
        
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Edit Admin Profile</h1>
                <p class="text-sm text-gray-500">Update your credentials and notification preferences</p>
            </div>
            <div class="flex space-x-3">
                <a href="profile.php" class="px-6 py-2.5 text-sm font-bold text-gray-500 hover:text-gray-700 transition-colors">Cancel</a>
                <button type="submit" name="update_profile" class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl shadow-md transition-all active:scale-95">
                    Save Changes
                </button>
            </div>
        </div>

        <?php if($message): ?>
            <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm font-medium border border-red-100"><?php echo $message; ?></div>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="md:col-span-1">
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm text-center">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-4 tracking-widest text-left">Profile Photo</label>
                    <div class="relative inline-block group cursor-pointer">
                        <img id="preview" src="<?php echo $base_url . $admin['avatar']; ?>" class="h-32 w-32 rounded-3xl object-cover ring-4 ring-green-50 group-hover:opacity-75 transition-opacity">
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <input type="file" name="avatar" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="previewImage(this)">
                    </div>
                    <p class="mt-4 text-[11px] text-gray-400 leading-relaxed">Allowed: JPG, PNG. Max 2MB</p>
                </div>
            </div>

            <div class="md:col-span-2 space-y-6">
                
                <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-5">
                    <h3 class="text-sm font-black text-gray-700 uppercase tracking-widest border-b border-gray-50 pb-3">Basic Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-gray-500">Full Name</label>
                            <input type="text" name="name" value="<?php echo $admin['name']; ?>" required class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-green-100 focus:border-green-400 outline-none transition-all">
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-gray-500">Email Address</label>
                            <input type="email" name="email" value="<?php echo $admin['email']; ?>" required class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-green-100 focus:border-green-400 outline-none transition-all">
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500">New Password (Leave blank to keep current)</label>
                        <input type="password" name="password" placeholder="••••••••" class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-green-100 focus:border-green-400 outline-none transition-all">
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                    <h3 class="text-sm font-black text-gray-700 uppercase tracking-widest border-b border-gray-50 pb-3 mb-5">System Preferences</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-semibold text-gray-600">2-Step Verification</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="two_fa" value="1" <?php echo $admin['two_fa'] ? 'checked' : ''; ?> class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                            </label>
                        </div>

                        <div class="space-y-3">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" name="notify_email" value="1" <?php echo $admin['notify_email'] ? 'checked' : ''; ?> class="rounded text-green-600 focus:ring-green-500">
                                <span class="text-sm text-gray-600">Email Notifications</span>
                            </label>
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" name="notify_order" value="1" <?php echo $admin['notify_order'] ? 'checked' : ''; ?> class="rounded text-green-600 focus:ring-green-500">
                                <span class="text-sm text-gray-600">Order Alerts</span>
                            </label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</main>

<script>
// Live Image Preview function
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>