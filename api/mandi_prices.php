<?php
// /farm/api/mandi_prices.php
header('Content-Type: application/json');

$commodity = isset($_GET['commodity']) ? urlencode($_GET['commodity']) : '';
$apiKey = "579b464db66ec23bdd000001a7fff1fa11d34c5062916ff6ea85f9f0";
$resourceId = "9ef84268-d588-465a-a308-a864a43d0070";

if ($commodity) {
    $apiUrl = "https://api.data.gov.in/resource/$resourceId?api-key=$apiKey&format=json&filters[commodity]=$commodity&limit=1";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    $response = curl_exec($ch);
    curl_close($ch);
    
    echo $response;
} else {
    echo json_encode(["records" => []]);
}
?>