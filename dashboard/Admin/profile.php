<?php
session_start();
// 1. Database Connection (Update with your actual credentials)
$conn = mysqli_connect("localhost", "root", "", "farm");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// 2. Identify the Admin (Usually from a login session)
// If you don't have sessions yet, change this to a hardcoded ID like 1 to test.
$admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : 1; 

// 3. Fetch Data from 'admin' table
$query = "SELECT * FROM admin WHERE admin_id = '$admin_id'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $admin_data = mysqli_fetch_assoc($result);
} else {
    echo "Admin not found.";
    exit;
}

include 'header.php'; 
?>

<main class="max-w-6xl mx-auto px-4 py-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Admin Profile</h1>
            <p class="text-sm text-gray-500">Manage your account information and preferences</p>
        </div>
        
        <a href="edit_profile.php" class="inline-flex items-center justify-center px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl transition-all shadow-md hover:shadow-lg active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
            Edit Profile
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 text-center">
                <div class="relative inline-block mb-4">
                    <img src="<?php echo $base_url . $admin_data['avatar']; ?>" alt="Admin Avatar" class="h-32 w-32 rounded-3xl object-cover ring-4 ring-green-50 shadow-inner">
                    <div class="absolute -bottom-2 -right-2 bg-green-500 border-4 border-white h-6 w-6 rounded-full shadow-sm"></div>
                </div>
                <h2 class="text-xl font-bold text-gray-800"><?php echo htmlspecialchars($admin_data['name']); ?></h2>
                <p class="text-sm text-green-600 font-medium mb-6 uppercase tracking-wider">System Administrator</p>
                
                <div class="pt-6 border-t border-gray-50 flex justify-between text-left">
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase">Member Since</p>
                        <p class="text-sm text-gray-700 font-semibold"><?php echo date('M d, Y', strtotime($admin_data['created_at'])); ?></p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] text-gray-400 font-bold uppercase">Admin ID</p>
                        <p class="text-sm text-gray-700 font-semibold">#ADM-<?php echo $admin_data['admin_id']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-8 py-5 bg-gray-50/50 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800">Account Credentials</h3>
                </div>
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Full Name</label>
                        <p class="text-gray-800 font-medium border-b border-gray-50 pb-2"><?php echo htmlspecialchars($admin_data['name']); ?></p>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Email Address</label>
                        <p class="text-gray-800 font-medium border-b border-gray-50 pb-2"><?php echo htmlspecialchars($admin_data['email']); ?></p>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Password</label>
                        <p class="text-gray-800 font-medium border-b border-gray-50 pb-2 tracking-widest">••••••••••••</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>