<?php
// --- DB Configuration (Make sure this matches your setup) ---
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', ''); // <-- **UPDATE THIS**
define('DB_NAME', 'farm'); // <-- **UPDATE THIS**

$message = ''; 
$is_success = false;

// --- Handle Form Submission ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Establish Database Connection
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error) {
        $message = "Database connection failed: " . $conn->connect_error;
    } else {

        // Collect and sanitize input data
        $name = $conn->real_escape_string($_POST['name']);
        $variety = $conn->real_escape_string($_POST['variety']);
        $area = (float)$_POST['area']; 
        $planting_date = $conn->real_escape_string($_POST['planting_date']);
        $expected_harvest_date = $conn->real_escape_string($_POST['expected_harvest_date']);
        $notes = $conn->real_escape_string($_POST['notes']);
        $status = 'Seeding'; 

        // --- Image Upload Handling (Same logic as before) ---
        $image_path = NULL;
        if (isset($_FILES['crop_image']) && $_FILES['crop_image']['error'] == 0) {
            $target_dir = "assets/uploads/"; 
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $image_name = basename($_FILES["crop_image"]["name"]);
            $target_file = $target_dir . time() . "_" . $image_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if ($_FILES["crop_image"]["size"] > 5000000) { 
                $message = "Sorry, your file is too large.";
            } elseif (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'webp'])) {
                $message = "Sorry, only JPG, JPEG, PNG & WEBP files are allowed.";
            } else {
                if (move_uploaded_file($_FILES["crop_image"]["tmp_name"], $target_file)) {
                    $image_path = $target_file;
                } else {
                    $message = "Error uploading image to server.";
                }
            }
        }

        // --- Prepare and Execute SQL Statement ---
        if (empty($message)) { 
            $sql = "INSERT INTO vegetable_crops (name, variety, area, planting_date, expected_harvest_date, status, notes, image_path) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdissis", $name, $variety, $area, $planting_date, $expected_harvest_date, $status, $notes, $image_path);

            if ($stmt->execute()) {
                header("Location: vegetables.php?status=success&crop=" . urlencode($name));
                exit();
            } else {
                $message = "Error inserting data: " . $stmt->error;
            }
            $stmt->close();
        }
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Crop Entry - GreenAgro</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Custom focus state */
    input:focus, textarea:focus {
        border-color: #10b981 !important; /* emerald-500 */
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.5) !important;
    }
    .main-panel {
        @apply bg-white p-8 rounded-xl shadow-lg border border-gray-100;
    }
    .sidebar-panel {
        @apply bg-white p-6 rounded-xl shadow-xl border border-green-200 sticky top-4; /* Sticky for floating effect */
    }
  </style>
</head>

<body class="bg-gray-50 font-sans">

  <div class="max-w-7xl mx-auto py-16 px-4">
    <div class="mb-8">
      <a href="vegetables.php" class="flex items-center text-green-600 hover:text-green-700 transition mb-4">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
          <span class="text-sm">Back to Vegetable List</span>
      </a>

      <h1 class="text-4xl font-extrabold text-green-700">
          Create New Crop Record
      </h1>
      <p class="text-gray-500 mt-1">
          Organize crop identity, scheduling, and documentation in the sections below.
      </p>
    </div>

    <?php if ($message && !$is_success): ?>
        <div class="p-4 rounded-lg mb-6 bg-red-100 text-red-800 border border-red-400">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form action="add_crop.php" method="POST" enctype="multipart/form-data">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1">
                <div class="sidebar-panel space-y-6">
                    <h2 class="text-xl font-bold text-green-600 border-b pb-2 mb-2">
                        Planting Metadata
                    </h2>
                    <p class="text-sm text-gray-500">Essential details for tracking progress.</p>

                    <div>
                        <label for="area" class="block text-sm font-medium text-gray-700">Area Planted (Acres) <span class="text-red-500">*</span></label>
                        <input type="number" name="area" id="area" step="0.01" min="0.01" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3 border"
                               placeholder="e.g., 0.75"
                               value="<?php echo htmlspecialchars($_POST['area'] ?? ''); ?>">
                    </div>
                    
                    <div>
                        <label for="planting_date" class="block text-sm font-medium text-gray-700">Planting Date <span class="text-red-500">*</span></label>
                        <input type="date" name="planting_date" id="planting_date" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3 border"
                               value="<?php echo htmlspecialchars($_POST['planting_date'] ?? date('Y-m-d')); ?>">
                    </div>

                    <div>
                        <label for="expected_harvest_date" class="block text-sm font-medium text-gray-700">Expected Harvest Date</label>
                        <input type="date" name="expected_harvest_date" id="expected_harvest_date"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3 border"
                               value="<?php echo htmlspecialchars($_POST['expected_harvest_date'] ?? ''); ?>">
                    </div>

                    <div class="pt-2 border-t border-dashed border-gray-200">
                         <h3 class="text-sm font-semibold text-gray-600">Initial Status:</h3>
                         <span class="inline-block mt-1 px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-300">
                            Seeding
                         </span>
                         <p class="text-xs text-gray-500 mt-1">Automatically set to 'Seeding'.</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                
                <div class="main-panel">
                    <h2 class="text-2xl font-bold text-gray-700 border-b pb-3 mb-4">Crop Identity</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Crop Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3 border" 
                                placeholder="e.g., Cucumber"
                                value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                        </div>

                        <div>
                            <label for="variety" class="block text-sm font-medium text-gray-700">Variety / Cultivar</label>
                            <input type="text" name="variety" id="variety"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3 border"
                                placeholder="e.g., Pusa Sanyog"
                                value="<?php echo htmlspecialchars($_POST['variety'] ?? ''); ?>">
                        </div>
                    </div>
                </div>

                <div class="main-panel">
                    <h2 class="text-2xl font-bold text-gray-700 border-b pb-3 mb-4">Field Notes</h2>
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700">Detailed Notes & Observations</label>
                        <textarea name="notes" id="notes" rows="6"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3 border"
                                placeholder="Record soil amendments, initial pest control, or specific bed numbers..."><?php echo htmlspecialchars($_POST['notes'] ?? ''); ?></textarea>
                    </div>
                </div>

                <div class="main-panel">
                    <h2 class="text-2xl font-bold text-gray-700 border-b pb-3 mb-4">Image Documentation</h2>
                    <div>
                        <label for="crop_image" class="block text-sm font-medium text-gray-700">Upload Initial Field Photo (Optional)</label>
                        <input type="file" name="crop_image" id="crop_image" accept="image/png, image/jpeg, image/webp"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer">
                        <p class="mt-1 text-xs text-gray-500">Max 5MB file size.</p>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-200 flex justify-end bg-gray-50 p-4 rounded-xl shadow-inner">
                    <a href="vegetables.php" class="mr-4 inline-flex justify-center py-3 px-6 border border-gray-300 shadow-sm text-sm font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex justify-center py-3 px-8 border border-transparent shadow-md text-base font-medium rounded-full text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Create Crop Record
                    </button>
                </div>
            </div>
            
        </div>
    </form>
  </div>
</body>
</html>