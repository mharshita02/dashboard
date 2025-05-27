<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "dashboard";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read JSON input (Excel data from frontend)
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["status" => "error", "message" => "No data received"]);
    exit;
}

// Prepare and insert each row
foreach ($data as $row) {
    $date = $conn->real_escape_string($row['Date'] ?? '');
    $saleOrder = $conn->real_escape_string($row['Sale Order Number'] ?? '');
    $invoice = $conn->real_escape_string($row['Invoice number'] ?? '');
    $channel = $conn->real_escape_string($row['Channel entry'] ?? '');
    $productName = $conn->real_escape_string($row['Product Name'] ?? '');
    $sku = $conn->real_escape_string($row['Product SKU Code'] ?? '');
    $qty = (int) ($row['Qty'] ?? 0);
    $unitPrice = (float) ($row['Unit Price'] ?? 0);
    $currency = $conn->real_escape_string($row['Currency'] ?? '');
    $total = (float) ($row['Total'] ?? 0);

    $sql = "INSERT INTO po_invoice 
        (date, sale_order_number, invoice_number, channel_entry, product_name, product_sku_code, qty, unit_price, currency, total)
        VALUES 
        ('$date', '$saleOrder', '$invoice', '$channel', '$productName', '$sku', $qty, $unitPrice, '$currency', $total)";

    $conn->query($sql);
}

echo json_encode(["status" => "success", "message" => "Data inserted successfully"]);
$conn->close();
?>
