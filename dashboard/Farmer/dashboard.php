<?php
$base_url = "/farm/";
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$farmer_id = $_SESSION['user_id'];
$sql = "SELECT first_name, last_name FROM farmers WHERE farmer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $farmer_id);
$stmt->execute();
$result = $stmt->get_result();

$farmer_name = ($result && $result->num_rows === 1) ? 
    htmlspecialchars(($f = $result->fetch_assoc())['first_name'] . ' ' . $f['last_name']) : "Farmer";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Farmer Dashboard - GreenAgro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap');
        body { background-color: #f0f6ef; font-family: 'Inter', sans-serif; }
        .input-focus:focus { border-color: #10b981; box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.5); }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<main class="max-w-7xl mx-auto px-6 py-10">
    <section class="mb-10 text-center sm:text-left">
        <h2 class="text-3xl sm:text-4xl font-bold text-green-700">Welcome, <?php echo $farmer_name; ?></h2>
        <p class="text-gray-600 mt-2 text-base sm:text-lg">Here’s an overview of your farm activity.</p>
    </section>

    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-600 hover:shadow-xl transition">
            <div class="flex justify-between items-center">
                <h3 class="font-semibold text-gray-500 text-sm">Total Crops</h3>
                <div class="p-2 rounded-full bg-green-100"><i class="fa-solid fa-seedling text-2xl text-green-700"></i></div>
            </div>
            <p class="text-4xl font-bold text-green-700 mt-4">18</p>
            <p class="text-xs text-gray-400 mt-1">Active plots this season</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-yellow-500 hover:shadow-xl transition">
            <div class="flex justify-between items-center">
                <h3 class="font-semibold text-gray-500 text-sm">Orders</h3>
                <div class="p-2 rounded-full bg-yellow-100"><i class="fa-solid fa-truck-fast text-2xl text-yellow-600"></i></div>
            </div>
            <p class="text-4xl font-bold text-yellow-600 mt-4">12</p>
            <p class="text-xs text-gray-400 mt-1">Pending deliveries</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-600 hover:shadow-xl transition">
            <div class="flex justify-between items-center">
                <h3 class="font-semibold text-gray-500 text-sm">Earnings</h3>
                <div class="p-2 rounded-full bg-blue-100"><i class="fa-solid fa-indian-rupee-sign text-2xl text-blue-600"></i></div>
            </div>
            <p class="text-4xl font-bold text-blue-600 mt-4">₹12,450</p>
            <p class="text-xs text-gray-400 mt-1">Revenue this month</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-cyan-500 hover:shadow-xl transition">
            <div class="flex justify-between items-center">
                <h3 class="font-semibold text-gray-500 text-sm">Weather</h3>
                <img id="weatherIcon" class="h-10 w-10">
            </div>
            <p id="temperature" class="text-4xl font-bold text-cyan-600 mt-3">--°C</p>
            <p id="weatherDesc" class="text-sm text-gray-500 mt-1">Fetching...</p>
            <p id="weatherLocation" class="text-sm text-gray-600 mt-1"></p>
        </div>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-10">
        <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-200">
            <h3 class="text-xl font-semibold text-green-700 mb-4 flex items-center">
                <i class="fa-solid fa-magnifying-glass-chart mr-2"></i> Smart Crop Selector
            </h3>
            <form id="cropSearchForm" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Soil Type</label>
                        <select id="landType" required class="w-full p-2 border border-gray-300 rounded-lg text-sm">
                            <option value="alluvial">Alluvial</option>
                            <option value="black">Black Soil</option>
                            <option value="red">Red Soil</option>
                            <option value="loamy">Loamy Soil</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Season</label>
                        <select id="seasonType" required class="w-full p-2 border border-gray-300 rounded-lg text-sm">
                            <option value="kharif">Kharif</option>
                            <option value="rabi">Rabi</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 transition">Get Recommendation</button>
            </form>
            <div id="recommendationOutput" class="mt-6 p-5 rounded-xl hidden border-2"></div>
        </div>

        <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-200">
            <h3 class="text-xl font-semibold text-green-700 mb-4 flex items-center">
                <i class="fa-solid fa-sack-dollar mr-2"></i> Live Market Prices
            </h3>
            <form id="priceLookupForm" class="flex space-x-3 mb-4">
                <input type="text" id="cropSearchInput" placeholder="Try 'Wheat' or 'Onion'" required
                       class="flex-grow p-3 border border-gray-300 rounded-lg text-sm">
                <button type="submit" class="bg-green-600 text-white px-5 py-3 rounded-lg font-semibold hover:bg-green-700 text-sm">Search</button>
            </form>
            <div id="priceResultOutput" class="p-4 bg-gray-50 border border-gray-200 rounded-lg min-h-[180px] flex items-center justify-center text-gray-500 text-sm text-center">
                Results from Agmarknet will appear here.
            </div>
        </div>
    </section>
</main>

<script>
// --- RECOMMENDATION LOGIC ---
const cropDatabase = {
    alluvial: { kharif: "Rice (Paddy)", rabi: "Wheat" },
    black: { kharif: "Cotton/Soybean", rabi: "Wheat/Gram" },
    red: { kharif: "Groundnut", rabi: "Mustard" },
    loamy: { kharif: "Maize", rabi: "Wheat" }
};

document.getElementById('cropSearchForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const soil = document.getElementById('landType').value;
    const season = document.getElementById('seasonType').value;
    const output = document.getElementById('recommendationOutput');
    const crop = cropDatabase[soil][season];

    output.innerHTML = `<h4 class="text-2xl font-black text-green-800">${crop}</h4><p class="text-sm">Optimal for ${soil} soil.</p>`;
    output.className = "mt-6 p-5 rounded-xl block border-2 bg-green-50 border-green-200";
});

// --- MARKET PRICE LOGIC ---
document.getElementById('priceLookupForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const rawInput = document.getElementById('cropSearchInput').value.trim();
    const cropName = rawInput.charAt(0).toUpperCase() + rawInput.slice(1).toLowerCase();
    const resultDiv = document.getElementById('priceResultOutput');

    resultDiv.innerHTML = `<i class="fa-solid fa-circle-notch fa-spin text-2xl text-green-600"></i>`;

    fetch(`/farm/api/mandi_prices.php?commodity=${encodeURIComponent(cropName)}`)
        .then(res => res.json())
        .then(data => {
            if (data.records && data.records.length > 0) {
                const r = data.records[0];
                resultDiv.innerHTML = `
                    <div class="text-center w-full">
                        <h4 class="text-2xl font-bold text-gray-800">${r.commodity}</h4>
                        <p class="text-5xl font-black text-green-600 my-2">₹${r.modal_price}</p>
                        <p class="text-sm font-semibold">${r.market}, ${r.state}</p>
                        <p class="text-xs text-gray-400 mt-2 italic">Updated: ${r.arrival_date}</p>
                    </div>`;
                resultDiv.className = "p-4 bg-green-50 border border-green-200 rounded-lg min-h-[180px] flex items-center justify-center";
            } else {
                resultDiv.innerHTML = `No data found for "${cropName}".`;
            }
        })
        .catch(() => { resultDiv.innerHTML = "Server connection failed."; });
});

// --- WEATHER LOGIC ---
const weatherApiKey = "1b8d37a127ca53bf0980d5bc248d551d";
function fetchWeather(lat, lon) {
    fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${weatherApiKey}&units=metric`)
        .then(res => res.json())
        .then(data => {
            document.getElementById("temperature").textContent = `${data.main.temp.toFixed(1)}°C`;
            document.getElementById("weatherDesc").textContent = data.weather[0].description;
            document.getElementById("weatherIcon").src = `https://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png`; 
            document.getElementById("weatherLocation").textContent = data.name;
        });
}
navigator.geolocation.getCurrentPosition(pos => fetchWeather(pos.coords.latitude, pos.coords.longitude), () => fetchWeather(22.3039, 70.8022));
</script>
</body>
</html>