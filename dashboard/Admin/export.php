<?php
require 'config.php';

// 1. Set the filename with the current date
$filename = "GreenAgro_Full_Report_" . date('Y-m-d') . ".csv";

// 2. Set headers to force download the CSV file
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $filename);

// 3. Open the output stream
$output = fopen('php://output', 'w');

// 4. Set the Global Column Headers
fputcsv($output, ['Type', 'Name / Company', 'Email / Contact', 'Status / Detail', 'Date']);

/* ==========================================
   SECTION 1: FARMERS
   ========================================== */
fputcsv($output, ['--- FARMERS SECTION ---']);
$farmers = $conn->query("SELECT first_name, last_name, email, status, created_at FROM farmers ORDER BY created_at DESC");

while ($row = $farmers->fetch_assoc()) {
    fputcsv($output, [
        'Farmer',
        $row['first_name'] . ' ' . $row['last_name'],
        $row['email'],
        ucfirst($row['status']),
        date('d M Y H:i', strtotime($row['created_at'])) // Formats: 26 Dec 2025 09:50
    ]);
}

/* ==========================================
   SECTION 2: DISTRIBUTORS
   ========================================== */
fputcsv($output, []); // Empty row for spacing
fputcsv($output, ['--- DISTRIBUTORS SECTION ---']);
$distributors = $conn->query("SELECT company_name, email, status, created_at FROM distributors ORDER BY created_at DESC");

while ($row = $distributors->fetch_assoc()) {
    fputcsv($output, [
        'Distributor',
        $row['company_name'],
        $row['email'],
        ucfirst($row['status']),
        date('d M Y H:i', strtotime($row['created_at']))
    ]);
}

/* ==========================================
   SECTION 3: PRODUCTS
   ========================================== */
fputcsv($output, []); // Empty row for spacing
fputcsv($output, ['--- PRODUCTS SECTION ---']);
$products = $conn->query("SELECT product_name, price, stock_quantity, created_at FROM products ORDER BY created_at DESC");

while ($row = $products->fetch_assoc()) {
    fputcsv($output, [
        'Product',
        $row['product_name'],
        'Price: ₹' . $row['price'],
        'Stock: ' . $row['stock_quantity'],
        date('d M Y H:i', strtotime($row['created_at']))
    ]);
}

// Close the stream
fclose($output);
exit;
?>