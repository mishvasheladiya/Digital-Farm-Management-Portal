<?php
session_start();
$baseUrl = "/farm/";

/* ---------- DB CONNECTION ---------- */
$conn = mysqli_connect("localhost", "root", "", "farm");

/* ---------- UPDATED AUTH CHECK ---------- */
// Check if user is logged in AND is a Farmer
if (!isset($_SESSION['email']) || $_SESSION['user_type'] !== 'Farmer') {
    // If not a farmer, kick them back to login
    header("Location: components/login.php"); 
    exit;
}

$email = $_SESSION['email'];

/* ---------- FETCH FARMER DATA ---------- */
$sql = "SELECT farmer_id, first_name, last_name, mobile, email FROM farmers WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$farmer = mysqli_fetch_assoc($result);

if (!$farmer) {
    die("Farmer record not found.");
}

// Set this for the post_harvest_action.php script
$_SESSION['farmer_id'] = $farmer['farmer_id']; 
$user_id = $farmer['farmer_id']; // Required for header.php notifications

$farmer_name   = $farmer['first_name'] . ' ' . $farmer['last_name'];
$farmer_mobile = $farmer['mobile'];
$farmer_email  = $farmer['email'];
$user_role     = $_SESSION['user_type'];

/* ---------- NOTIFICATION LOGIC FOR HEADER ---------- */
// Fetch unread count for the bell badge
$count_query = "SELECT COUNT(*) as unread FROM notifications WHERE farmer_id = ? AND is_read = 0";
$stmt_c = mysqli_prepare($conn, $count_query);
mysqli_stmt_bind_param($stmt_c, "i", $user_id);
mysqli_stmt_execute($stmt_c);
$res_c = mysqli_stmt_get_result($stmt_c);
$unread_count = mysqli_fetch_assoc($res_c)['unread'] ?? 0;

// Fetch last 5 notifications for the dropdown
$notif_query = "SELECT * FROM notifications WHERE farmer_id = ? ORDER BY created_at DESC LIMIT 5";
$stmt_n = mysqli_prepare($conn, $notif_query);
mysqli_stmt_bind_param($stmt_n, "i", $user_id);
mysqli_stmt_execute($stmt_n);
$notifications = mysqli_stmt_get_result($stmt_n);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>GreenAgro | Post Harvest Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        :root { --primary: #059669; --primary-light: #ecfdf5; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: radial-gradient(circle at top right, #f0fdf4, #ffffff); }
        .progress-ring { transition: stroke-dashoffset 0.35s; transform: rotate(-90deg); transform-origin: 50% 50%; }
        .step-content { display: none; opacity: 0; transform: scale(0.98); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .step-content.active { display: block; opacity: 1; transform: scale(1); }
        .input-glow:focus { box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1); border-color: var(--primary); }
        .cat-btn:checked + .cat-label { background-color: var(--primary); color: white; border-color: var(--primary); box-shadow: 0 10px 15px -3px rgba(5, 150, 105, 0.3); }
        .error-shake { animation: shake 0.5s ease-in-out; border-color: #ef4444 !important; }
        @keyframes shake { 0%, 100% { transform: translateX(0); } 25% { transform: translateX(-5px); } 75% { transform: translateX(5px); } }
    </style>
</head>
<?php include 'header.php'; ?>
<body class="min-h-screen py-12 px-4">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-8 bg-white/60 backdrop-blur-md p-6 rounded-3xl border border-white shadow-sm">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">Post Harvest</h1>
                <p class="text-slate-500 text-sm font-medium" id="step-indicator">Step 1 of 3: Product Info</p>
            </div>
            <div class="relative flex items-center justify-center">
                <svg class="w-16 h-16">
                    <circle class="text-slate-200" stroke-width="4" stroke="currentColor" fill="transparent" r="28" cx="32" cy="32"/>
                    <circle id="progress-circle" class="text-emerald-600 progress-ring" stroke-width="4" stroke-dasharray="175.9" stroke-dashoffset="117.2" stroke-linecap="round" stroke="currentColor" fill="transparent" r="28" cx="32" cy="32"/>
                </svg>
                <span class="absolute text-xs font-bold text-slate-700" id="step-pct">33%</span>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] border border-slate-100 overflow-hidden">
            <form id="agriForm" method="POST" action="post_harvest_action.php" enctype="multipart/form-data" class="p-8 md:p-10">
                
                <section id="step-1" class="step-content active space-y-6">
                    <div class="space-y-1">
                        <h2 class="text-xl font-bold text-slate-800">What are you selling?</h2>
                        <p class="text-sm text-slate-500">Choose a category and upload a photo.</p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <?php 
                        $cats = [
                            ['v'=>'Vegetable', 'i'=>'carrot'], ['v'=>'Fruit', 'i'=>'apple'], 
                            ['v'=>'Grain', 'i'=>'wheat'], ['v'=>'Pulses', 'i'=>'container'],
                            ['v'=>'Spice', 'i'=>'leaf'], ['v'=>'Flower', 'i'=>'flower-2'], ['v'=>'Other', 'i'=>'more-horizontal']
                        ];
                        foreach($cats as $c): ?>
                        <label class="relative">
                            <input type="radio" name="category" value="<?= $c['v'] ?>" class="sr-only cat-btn" <?= $c['v']=='Vegetable'?'checked':'' ?>>
                            <div class="cat-label px-5 py-2.5 rounded-full border border-slate-200 text-sm font-bold text-slate-600 cursor-pointer transition-all flex items-center gap-2 hover:bg-slate-50">
                                <i data-lucide="<?= $c['i'] ?>" class="w-4 h-4"></i> <?= $c['v'] ?>
                            </div>
                        </label>
                        <?php endforeach; ?>
                    </div>

                    <div id="drop-zone" class="relative group h-48 rounded-3xl border-2 border-dashed border-slate-200 bg-slate-50/50 flex flex-col items-center justify-center transition-all hover:border-emerald-400 hover:bg-emerald-50/30 cursor-pointer">
                        <input type="file" id="image-input" name="crop_image" class="sr-only" accept="image/*">
                        <div id="upload-prompt" class="text-center">
                            <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center mx-auto mb-3">
                                <i data-lucide="camera" class="text-emerald-600 w-6 h-6"></i>
                            </div>
                            <p class="text-sm font-bold text-slate-700">Click to upload harvest photo</p>
                        </div>
                        <img id="preview-img" class="hidden absolute inset-0 w-full h-full object-cover rounded-[1.4rem]">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-500 ml-1">Crop Name</label>
                            <input type="text" id="v-name" name="variety_name" placeholder="e.g. Saffron Onion" class="req w-full px-5 py-3.5 bg-slate-50 rounded-2xl border-transparent focus:bg-white border-2 outline-none transition-all input-glow font-semibold text-slate-700">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-500 ml-1">Price per Kg</label>
                            <div class="relative">
                                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 font-bold">₹</span>
                                <input type="number" id="v-price" name="price" placeholder="0.00" class="req w-full pl-10 pr-5 py-3.5 bg-slate-50 rounded-2xl border-transparent focus:bg-white border-2 outline-none transition-all input-glow font-semibold text-slate-700">
                            </div>
                        </div>
                    </div>
                </section>

                <section id="step-2" class="step-content space-y-6">
                    <div class="space-y-1">
                        <h2 class="text-xl font-bold text-slate-800">Logistics & Contact</h2>
                        <p class="text-sm text-slate-500">Auto-filled from your profile.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="farmer_name" value="<?= htmlspecialchars($farmer_name) ?>" readonly class="w-full px-5 py-3.5 bg-slate-100 rounded-2xl border-2 border-slate-200 font-semibold cursor-not-allowed">
                        <input type="tel" name="phone" value="<?= htmlspecialchars($farmer_mobile) ?>" readonly class="w-full px-5 py-3.5 bg-slate-100 rounded-2xl border-2 border-slate-200 font-semibold cursor-not-allowed">
                        <input type="email" name="email" value="<?= htmlspecialchars($farmer_email) ?>" readonly class="w-full px-5 py-3.5 bg-slate-100 rounded-2xl border-2 border-slate-200 font-semibold cursor-not-allowed md:col-span-2">
                        
                        <div class="space-y-1.5 md:col-span-2">
                            <label class="text-xs font-bold text-slate-500 ml-1">Farm Location</label>
                            <input type="text" id="f-loc" name="address" placeholder="Full address" class="req w-full px-5 py-3.5 bg-slate-50 rounded-2xl border-transparent focus:bg-white border-2 outline-none transition-all input-glow font-semibold">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-500 ml-1">Available Stock (Kg)</label>
                            <input type="number" id="f-stock" name="stock" class="req w-full px-5 py-3.5 bg-slate-50 rounded-2xl border-transparent focus:bg-white border-2 outline-none transition-all input-glow font-semibold">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-500 ml-1">Harvest Date</label>
                            <input type="date" id="f-date" name="harvest_date" class="req w-full px-5 py-3.5 bg-slate-50 rounded-2xl border-transparent focus:bg-white border-2 outline-none transition-all input-glow font-semibold text-slate-500">
                        </div>
                    </div>
                </section>

                <section id="step-3" class="step-content space-y-6">
                    <div class="bg-emerald-900 rounded-[2rem] p-8 text-white relative overflow-hidden">
                        <div class="relative z-10 flex flex-col md:flex-row gap-6 items-center">
                            <img id="review-img-final" class="w-32 h-32 rounded-2xl object-cover border-4 border-emerald-800 shadow-2xl">
                            <div class="text-center md:text-left">
                                <span id="review-cat" class="text-[10px] font-black tracking-widest uppercase bg-white/20 px-3 py-1 rounded-full"></span>
                                <h3 id="review-name" class="text-2xl font-black mt-2 leading-tight"></h3>
                                <p id="review-price" class="text-emerald-400 font-bold text-lg"></p>
                            </div>
                        </div>
                        <i data-lucide="sprout" class="absolute -bottom-6 -right-6 w-32 h-32 text-white/5 rotate-12"></i>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-slate-50 p-4 rounded-2xl">
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Availability</p>
                            <p id="review-stock" class="font-bold text-slate-700"></p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-2xl">
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Location</p>
                            <p id="review-loc" class="font-bold text-slate-700 truncate"></p>
                        </div>
                    </div>
                </section>

                <div class="flex items-center gap-4 mt-10">
                    <button type="button" id="prev-btn" class="flex-1 py-4 font-bold text-slate-400 hover:text-slate-600 transition-all hidden">Back</button>
                    <button type="button" id="next-btn" class="flex-[2] bg-emerald-600 hover:bg-emerald-700 text-white py-4 rounded-2xl font-bold transition-all flex items-center justify-center gap-2">
                        <span id="next-text">Continue</span>
                        <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        lucide.createIcons();
        let step = 1;
        const totalSteps = 3;
        const circle = document.getElementById('progress-circle');
        const radius = circle.r.baseVal.value;
        const circumference = radius * 2 * Math.PI;

        function setProgress(percent) {
            const offset = circumference - (percent / 100 * circumference);
            circle.style.strokeDashoffset = offset;
            document.getElementById('step-pct').innerText = `${Math.round(percent)}%`;
        }

        function updateUI() {
            const titles = ["Product Info", "Logistics", "Review Listing"];
            document.getElementById('step-indicator').innerText = `Step ${step} of 3: ${titles[step-1]}`;
            setProgress((step / totalSteps) * 100);
            document.querySelectorAll('.step-content').forEach(el => el.classList.remove('active'));
            document.getElementById(`step-${step}`).classList.add('active');
            document.getElementById('prev-btn').classList.toggle('hidden', step === 1);
            document.getElementById('next-text').innerText = step === 3 ? 'Confirm & Publish' : 'Continue';
            if(step === 3) prepareReview();
        }

        function validate() {
            const current = document.getElementById(`step-${step}`);
            const fields = current.querySelectorAll('.req');
            let valid = true;
            fields.forEach(f => {
                if(!f.value.trim()) {
                    f.classList.add('error-shake');
                    setTimeout(() => f.classList.remove('error-shake'), 500);
                    valid = false;
                }
            });
            if(step === 1 && !document.getElementById('image-input').files[0]) {
                document.getElementById('drop-zone').classList.add('error-shake');
                setTimeout(() => document.getElementById('drop-zone').classList.remove('error-shake'), 500);
                valid = false;
            }
            return valid;
        }

        function prepareReview() {
            document.getElementById('review-name').innerText = document.getElementById('v-name').value;
            document.getElementById('review-price').innerText = `₹${document.getElementById('v-price').value}/Kg`;
            document.getElementById('review-stock').innerText = `${document.getElementById('f-stock').value} Kg`;
            document.getElementById('review-loc').innerText = document.getElementById('f-loc').value;
            document.getElementById('review-cat').innerText = document.querySelector('input[name="category"]:checked').value;
            document.getElementById('review-img-final').src = document.getElementById('preview-img').src;
        }

        document.getElementById('next-btn').addEventListener('click', () => {
            if(validate()) {
                if(step < 3) { step++; updateUI(); }
                else { document.getElementById('agriForm').submit(); }
            }
        });

        document.getElementById('prev-btn').addEventListener('click', () => {
            if(step > 1) { step--; updateUI(); }
        });

        const imgInput = document.getElementById('image-input');
        document.getElementById('drop-zone').addEventListener('click', () => imgInput.click());
        imgInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if(file) {
                const reader = new FileReader();
                reader.onload = (ev) => {
                    const preview = document.getElementById('preview-img');
                    preview.src = ev.target.result;
                    preview.classList.remove('hidden');
                    document.getElementById('upload-prompt').classList.add('opacity-0');
                };
                reader.readAsDataURL(file);
            }
        });
        setProgress(33);
    </script>
</body>
</html>