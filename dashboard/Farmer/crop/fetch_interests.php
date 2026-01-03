<?php
// 1. Database Connection
$conn = mysqli_connect("localhost", "root", "", "farm");

if (!$conn) {
    die(json_encode(["error" => "Connection failed"]));
}

// 2. Get the Product ID from the click
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

// 3. Query to get Distributor names who showed interest
$query = "SELECT d.distributor_id, d.first_name, d.last_name, d.company_name, d.city 
          FROM product_interests pi
          JOIN distributors d ON pi.distributor_id = d.distributor_id
          WHERE pi.product_id = ?";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// 4. Send the data back to the inventory page as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>